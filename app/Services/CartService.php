<?php

namespace App\Services;
use App\Models\Product;
use App\Models\Variant;
use Illuminate\Support\Collection;
use Illuminate\Session\SessionManager;

class CartService
{
    const CART_NAME = 'cart';
    const CART_ITEM_NAME = 'items';
    
    /**
     * @var \Illuminate\Session\SessionManager
     */
    protected $session;

    /** 
     * @param \Illuminate\Session\SessionManager
     */
    public function __construct(SessionManager $session)
    {
        $this->session = $session;
    }

    public function getContent() : Collection
    {
        return $this->session->has(self::CART_NAME) ? $this->session->get(self::CART_NAME) : collect([
            'items' => collect(),
            'customer' => auth()->check() ? auth()->user()->id : null,
            'total' => 0,
            'discount' => 0
        ]);
    }

    public function getContentWithDetail() : Collection
    {
        $cart = $this->getContent();
        $cartItems = $cart->get(self::CART_ITEM_NAME);
        $cartItems = $cartItems->map(function($item) {
            $product = Product::find($item->get('id'));
            $variants = collect($item->get('variants'))->map(function($variant) {
                return Variant::find($variant['id']);
            });

            return $item->merge([
                'product' => $product, 
                'variants' => $variants
            ]);
        });

        $cart->put(self::CART_ITEM_NAME, $cartItems);
        $cart->put('customer', auth()->user());
        
        return $cart;
    }

    public function getCartItems(): Collection
    {
        return $this->getContent()->get(self::CART_ITEM_NAME);
    }

    public function getCartItem(int $id) : null|Collection
    {
        return $this->getCartItems()->filter(fn ($item) => $item->get('id') == $id)->first();
    }

    public function createCartItem(int $id, int $qty, float $price, array $variants) : Collection
    {
        return collect([
            'id' => $id,
            'quantity' => $qty,
            'price' => $price,
            'total' => $qty * $price,
            'variants' => $variants
        ]);
    }

    public function add(int $id, int $qty, float $price, array $variants) : self
    {
        $item = $this->createCartItem($id, $qty, $price, $variants);

        return $this->pushItemToCart($item);
    }

    public function remove(int $id) : self
    {
        $cartItem = $this->getCartItems();

        $index = $cartItem->search(function($item) use($id) {
            return $item->get('id') == $id;
        });

        $cartItem->forget($index);

        $cartManager = $this->getContent();
        $cartManager->put(self::CART_ITEM_NAME, $cartItem);
        $total = $cartManager->get(self::CART_ITEM_NAME)->sum('total');
        $cartManager->put(
            'total', 
            $total
        );
        
        $this->session->put(self::CART_NAME, $cartManager);

        return $this;
    }

    public function updateQuantity(int $id, int $qty) : self
    {
        $cartItem = $this->getCartItems();
        $cartItem = $cartItem->map(function($item) use ($id, $qty) {
            if ($item->get('id') != $id) return $item;
            
            return $item
                ->put('quantity', $qty)
                ->put('total', $qty * $item->get('price'))
            ;
        });

        $item = $cartItem->filter(fn ($item) => $item->get('id') == $id)->first();
        $cartManager = $this->getContent();
        $cartManager->put(self::CART_ITEM_NAME, $cartItem);
        $total = $cartManager->get(self::CART_ITEM_NAME)->sum('total');
        $cartManager->put(
            'total', 
            $total
        );
        
        $this->session->put(self::CART_NAME, $cartManager);
        

        return $this;
    }

    public function clear() : void
    {
        $this->session->forget(self::CART_NAME);
    }

    protected function pushItemToCart(Collection $item) : self
    {
        $item = $this->changeQuantityIfItemAlreadyExists($item);

        $cartItem = $this->getCartItems();
        $cartItem->add($item);

        $cartManager = $this->getContent();
        $cartManager->put(self::CART_ITEM_NAME, $cartItem);
        $cartManager->put(
            'total', 
            $cartManager->get('total') + ($item->get('price') * $item->get('quantity'))
        );

        $this->session->put(self::CART_NAME, $cartManager);

        return $this;
    }

    protected function changeQuantityIfItemAlreadyExists(Collection $item) : Collection 
    {
        $exists = $this->getCartItem($item->get('id'));

        return (is_null($exists) || $exists->isEmpty()) ? $item : $exists->put('quantity', $item->get('quantity'));
    }
}
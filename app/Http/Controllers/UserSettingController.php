<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Inertia\Response;
use App\Http\Requests\UpdateUserSettingRequest;

class UserSettingController extends Controller
{
    public function index() : Response
    {
        $user = auth()->check() ? auth()->user()->toArray() : null;

        return Inertia::render('User/Setting/Index', [
            'user' => $user
        ]);
    }

    public function edit() : Response
    {
        $user = auth()->check() ? auth()->user()->toArray() : null;

        return Inertia::render('User/Setting/Edit', [
            'user' => $user
        ]);
    }

    public function update(UpdateUserSettingRequest $request) 
    {
        $content = $request->validated();
        $user = auth()->user();

        if (array_key_exists('picture', $content)) {
            $picture = $user->saveProfilePicture($content['picture']);
            $content['picture'] = $picture ?? null;
        }
        
        $user->update($content);

        return redirect()
            ->route('user.setting.index')
            ->with(['message' => 'Biodata berhasil diperbaharui.']);
    }
}

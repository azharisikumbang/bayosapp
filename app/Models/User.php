<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'dob',
        'address',
        'phone',
        'picture',
        'gender'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [
        'picture_image_url',
        'gender_name',
        'formatted_dob_string'
    ];

    public function saveProfilePicture(UploadedFile $file) : bool|string
    {   
        $filename = sprintf("%s.%s", Str::random(40), $file->getClientOriginalExtension());
        $path = 'public/profile';
        
        return $file->storeAs($path, $filename);
    }

    protected function pictureImageUrl() : Attribute
    {
        if (is_null($this->picture)) return Attribute::make(fn () => null);

        return Attribute::make(
            get: fn($value) => sprintf("/%s/%s", 'storage', $this->removeProfilePublicPath($this->picture))
        );
    }

    protected function genderName() : Attribute
    {

        return Attribute::make(function($value) {
            return match($this->gender) {
                '0' => 'Tidak Disebutkan',
                '1' => 'Pria',
                '2' => 'Wanita',
                '9' => 'Tidak Berlaku'
            };
        });
    }

    protected function formattedDobString() : Attribute
    {
        if (is_null($this->dob)) return Attribute::make(fn() => null);

        return Attribute::make(function($value) {
            $month = [
                'Januari',
                'Februari',
                'Maret',
                'April',
                'Mei',
                'Juni',
                'Juli',
                'Agustus',
                'September',
                'Oktober',
                'November',
                'Desember'
            ];

            $date = new \DateTimeImmutable($this->dob);
            
            return sprintf(
                "%s %s %s", 
                $date->format('d'), 
                $month[$date->format('n') - 1],
                $date->format('Y')
            );
        });
    }

    private function removeProfilePublicPath(string $path) : string
    {
        return str_replace('public/', '', $path);
    }
}

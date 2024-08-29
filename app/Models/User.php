<?php

namespace App\Models;

use App\Mail\ResetPasswordMail;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Mail;
use Laravel\Lumen\Auth\Authorizable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string $phone
 * @property Collection $companies;
 */
class User extends Model implements AuthenticatableContract, AuthorizableContract, JWTSubject, CanResetPassword
{
    use Authenticatable, Authorizable, HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'phone',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var string[]
     */
    protected $hidden = [
        'password',
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function getEmailForPasswordReset(): string
    {
        return $this->email;
    }

    public function sendPasswordResetNotification($token)
    {
        $resetPasswordUrl = url('/password/reset/'.$token);
        Mail::to($this->email)->send(new ResetPasswordMail($token, $resetPasswordUrl));
    }
}

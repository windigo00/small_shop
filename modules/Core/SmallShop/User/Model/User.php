<?php

namespace Modules\Core\SmallShop\User\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use Modules\Core\SmallShop\Customer\Model\Customer;
use Modules\Core\SmallShop\User\Model\Auth\Type as AuthType;
use Modules\Core\SmallShop\User\Model\Auth\UserAuthType;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 *
 * @method static User make(?string[][] $data)
 * @method static User create(?string[][] $data)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get customer.
     *
     * @return HasOne
     */
    public function customer(): HasOne
    {
        return $this->hasOne(Customer::class, 'user_id');
    }

    public function authRule(): HasOneThrough
    {
        return $this->hasOneThrough(AuthType::class, UserAuthType::class, 'user_id', 'id', 'id', 'type_id');
    }
}

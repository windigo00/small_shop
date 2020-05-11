<?php

namespace Modules\Core\SmallShop\Customer\Model;

use Modules\Core\SmallShop\User\Model\User;
use Modules\Core\SmallShop\Customer\Model\Card;
use Modules\Core\SmallShop\Customer\Model\Customer\Card as CCard;
use Modules\Core\SmallShop\Customer\Model\Customer\Address;
use Modules\Core\SmallShop\Sales\Model\Order;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonInterface;

/**
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property CarbonInterface $registered_at
 * @property string $email
 * @property string $phone
 *
 * @method static Customer make(?string[][] $data)
 * @method static Customer create(?string[][] $data)
 */
class Customer extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customers';


    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'first_name', 'last_name', 'registered_at', 'phone'
    ];

    /**
     * Get the addresses for customer.
     *
     * @return HasMany
     */
    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
    /**
     * Get the orders for customer.
     *
     * @return HasMany
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }


    /**
     * Get customers' user.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get customers' cards.
     *
     * @return HasManyThrough
     */
    public function cards(): HasManyThrough
    {
        return $this->hasManyThrough(Card::class, CCard::class, 'customer_id', 'id', 'id', 'card_id');
    }

    /**
     *
     * @return string
     */
    public function fullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}

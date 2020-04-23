<?php

namespace App\Model;

use App\Model\User;
use App\Model\Card;
use App\Model\Customer\Card as CCard;
use App\Model\Customer\Address;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;


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
     * @var array
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
//        return $this->hasMany(Card::class)->using(CCard::class);
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

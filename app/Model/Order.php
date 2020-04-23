<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Model\Customer\Address as CAddress;
use App\Model\Order\Address as OAddress;
use App\Model\Order\Item;
use App\Model\Customer;
use App\Model\Order\Status;
use App\Model\Order\Status\History;

class Order extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'orders';

    /**
     * Get the addresses for order.
     *
     * @return HasManyThrough
     */
    public function addresses(): HasManyThrough
    {
        return $this->hasManyThrough(CAddress::class, OAddress::class, 'order_id', 'id', 'id', 'address_id');
    }

    /**
     * Get customer.
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }



    /**
     * Get items.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }

    /**
     * Get status.
     *
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(Status::class, 'id', 'status_id');
    }
    /**
     * Get card.
     *
     * @return HasOne
     */
    public function card(): HasOne
    {
        return $this->hasOne(Card::class, 'id', 'card_id');
    }

    /**
     * Get status history.
     *
     * @return HasMany
     */
    public function history(): HasMany
    {
        return $this->hasMany(History::class);
    }
}

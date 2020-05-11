<?php

namespace Modules\Core\SmallShop\Sales\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Core\SmallShop\Customer\Model\Customer\Address as CAddress;
use Modules\Core\SmallShop\Customer\Model\Customer;
use Modules\Core\SmallShop\Customer\Model\Card;
use Modules\Core\SmallShop\Sales\Model\Order\Address as OAddress;
use Modules\Core\SmallShop\Sales\Model\Order\Item;
use Modules\Core\SmallShop\Sales\Model\Order\Status;
use Modules\Core\SmallShop\Sales\Model\Order\Status\History;
use Modules\Core\SmallShop\System\Model\Currency;

/**
 * @property int $id
 * @property string $order_nr
 * @property int $customer_id
 * @property int $status_id
 * @property ?int $card_id
 * @property ?int $currency_id
 * @property float $price
 *
 * @method static Order make(?string[][] $data)
 * @method static Order create(?string[][] $data)
 */
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
     * Get Currency.
     *
     * @return HasOne
     */
    public function currency(): HasOne
    {
        return $this->hasOne(Currency::class, 'id', 'currency_id');
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

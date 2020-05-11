<?php

namespace Modules\Core\SmallShop\Sales\Model\Order;

use Illuminate\Database\Eloquent\Model;

/**
 * Description
 *
 * @author windigo
 *
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property float $unit_price
 * @property float $units
 * @property float $price
 *
 * @method static Item make(?string[][] $data)
 * @method static Item create(?string[][] $data)
 */
class Item extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';
}

<?php

namespace Modules\Core\SmallShop\Sales\Model\Order\Status;

use Illuminate\Database\Eloquent\Model;

/**
 * Description
 *
 * @author windigo
 *
 * @property int $id
 * @property int $order_id
 * @property int $user_id
 *
 * @method static History make(?string[][] $data)
 * @method static History create(?string[][] $data)
 */
class History extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_status_histories';
}

<?php

namespace Modules\Core\SmallShop\Sales\Model\Order;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $label
 * @property string $name
 *
 * @method static Model make()
 * @method static Model create()
 */
class Status extends Model
{
    const STATUS_NAME_NEW       = 'new';
    const STATUS_NAME_PAYED     = 'payd';
    const STATUS_NAME_EXPEDITED = 'expedited';
    const STATUS_NAME_REFUNDED  = 'refunded';
    const STATUS_NAME_RETURNED  = 'returned';
    const STATUS_NAME_CANCELED  = 'canceled';
    const STATUS_NAME_FINISHED  = 'finished';

    const STATUS_LABEL_NEW       = 'New';
    const STATUS_LABEL_PAYED     = 'Payd';
    const STATUS_LABEL_EXPEDITED = 'Expedited';
    const STATUS_LABEL_REFUNDED  = 'Refunded';
    const STATUS_LABEL_RETURNED  = 'Returned';
    const STATUS_LABEL_CANCELED  = 'Canceled';
    const STATUS_LABEL_FINISHED  = 'Finished';

    const STATUS_NAMES = [
        self::STATUS_NAME_NEW,
        self::STATUS_NAME_PAYED,
        self::STATUS_NAME_EXPEDITED,
        self::STATUS_NAME_REFUNDED,
        self::STATUS_NAME_RETURNED,
        self::STATUS_NAME_CANCELED,
        self::STATUS_NAME_FINISHED,
    ];
    const STATUS_LABELS = [
        self::STATUS_LABEL_NEW,
        self::STATUS_LABEL_PAYED,
        self::STATUS_LABEL_EXPEDITED,
        self::STATUS_LABEL_REFUNDED,
        self::STATUS_LABEL_RETURNED,
        self::STATUS_LABEL_CANCELED,
        self::STATUS_LABEL_FINISHED,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_statuses';
}

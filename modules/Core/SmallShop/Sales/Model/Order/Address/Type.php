<?php
namespace Modules\Core\SmallShop\Sales\Model\Order\Address;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Type
 *
 * @author windigo
 *
 * @property int $id
 * @property string $label
 * @property string $name
 *
 * @method static Type make(?string[][] $data)
 * @method static Type create(?string[][] $data)
 */
class Type extends Model
{
    const ADDRESS_TYPE_INVOICE  = 'invoice';
    const ADDRESS_TYPE_DELIVERY = 'delivery';
    const ADDRESS_LABEL_INVOICE  = 'Invoice Address';
    const ADDRESS_LABEL_DELIVERY = 'Delivery Address';

    const ADDRESS_TYPES = [
        self::ADDRESS_TYPE_INVOICE,
        self::ADDRESS_TYPE_DELIVERY,
    ];
    const ADDRESS_LABELS = [
        self::ADDRESS_LABEL_INVOICE,
        self::ADDRESS_LABEL_DELIVERY,
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_address_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'label'
    ];
}

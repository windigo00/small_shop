<?php
namespace App\Model\Order;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Description of Address
 *
 * @author windigo
 *
 */
class Address extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_addresses';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;
}

<?php
namespace Modules\Core\SmallShop\Sales\Model\Invoice;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    /**
     * The table associated with the model.
     */
    protected string $table = 'invoice_item';
}

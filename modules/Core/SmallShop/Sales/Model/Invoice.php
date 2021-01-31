<?php

namespace Modules\Core\SmallShop\Sales\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Modules\Core\SmallShop\Sales\Model\Invoice\Item;

/**
 * 
 */
class Invoice extends Model 
{
    protected $table = 'invoices';
    
    /**
     * Get items.
     *
     * @return HasMany
     */
    public function items(): HasMany
    {
        return $this->hasMany(Item::class);
    }
}

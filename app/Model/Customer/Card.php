<?php

namespace App\Model\Customer;

use Illuminate\Database\Eloquent\Relations\Pivot;

class Card extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_cards';


}

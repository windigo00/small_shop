<?php

namespace App\Model\Customer;

use App\Model\Card as ACard;

class Card extends ACard
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_cards';
}

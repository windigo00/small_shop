<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    const TYPE_NAMES = [
        'discount',
        'loyalty',
    ];
    const TYPE_LABELS = [
        'Discount Card',
        'Loyalty Card',
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'card_types';
    public $timestamps = false;

}

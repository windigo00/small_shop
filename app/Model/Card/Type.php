<?php

namespace App\Model\Card;

use Illuminate\Database\Eloquent\Model;

/**
 * @property string $label
 * @property string $name
 *
 * @method static Type make(?string[][] $data)
 * @method static Type create(?string[][] $data)
 */
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
    /**
     *
     * @var bool
     */
    public $timestamps = false;
}

<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Carbon\CarbonInterface;

/**
 * @property int $id
 * @property string $number
 * @property int $type_id
 * @property CarbonInterface $valid_to
 *
 * @method static Card make(?string[][] $data)
 * @method static Card create(?string[][] $data)
 */
class Card extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cards';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'number', 'type_id', 'valid_to'
    ];
}

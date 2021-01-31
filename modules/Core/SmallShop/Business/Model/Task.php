<?php

namespace Modules\Core\SmallShop\Business\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * @property int $id
 * @property string $name
 * @property int $amount
 * @property Date $date
 *
 * @method static Task make(?string[][] $data)
 * @method static Task create(?string[][] $data)
 */
class Task extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_tasks';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'amount', 'date'
    ];
}

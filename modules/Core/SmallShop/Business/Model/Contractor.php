<?php

namespace Modules\Core\SmallShop\Business\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $ico
 * @property string $dic
 * @property User $owner
 * @property Date $date
 *
 * @method static Contractor make(?string[][] $data)
 * @method static Contractor create(?string[][] $data)
 */
class Contractor extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_contractors';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'address', 'ico', 'dic', 'owner', 'date'
    ];
}

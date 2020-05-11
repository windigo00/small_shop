<?php
namespace Modules\Core\SmallShop\System\Model;

use Illuminate\Database\Eloquent\Model;
/**
 * Description of Currency
 *
 * @author windigo
 *
 * @property int $id
 * @property string $code
 * @property string $title
 * @property string $sign
 * @property bool $enabled
 * @property CarbonInterface $created_at
 * @property CarbonInterface $updated_at
 *
 * @method static Currency make(?string[][] $data)
 * @method static Currency create(?string[][] $data)
 */
class Currency extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'title', 'sign', 'enabled',
    ];
}

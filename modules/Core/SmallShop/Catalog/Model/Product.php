<?php

namespace Modules\Core\SmallShop\Catalog\Model;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $title
 * @property string $seo_name
 * @property float $price
 *
 * @method static Product make(?string[][] $data)
 * @method static Product create(?string[][] $data)
 */
class Product extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'title', 'seo_name', 'price'
    ];
}

<?php

namespace Modules\Core\SmallShop\Customer\Model\Customer;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property string $street
 * @property string $street_nr
 * @property string $city
 * @property string $zip
 * @property string $country
 *
 * @method static Address make(?string[][] $data)
 * @method static Address create(?string[][] $data)
 */
class Address extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'customer_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'street',
        'street_nr',
        'city',
        'zip',
        'country',
        'customer_id',
    ];


    /**
     *
     * @return BelongsTo
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo('App\Model\Customer', 'customer_id', 'id');
    }
}

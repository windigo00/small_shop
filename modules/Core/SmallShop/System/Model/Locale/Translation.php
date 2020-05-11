<?php

namespace Modules\Core\SmallShop\System\Model\Locale;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'locales_';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'value',
        'group_id',
        'key_id'
    ];
}

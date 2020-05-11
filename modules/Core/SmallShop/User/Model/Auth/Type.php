<?php
namespace Modules\Core\SmallShop\User\Model\Auth;

use Illuminate\Database\Eloquent\Model;

/**
 * Description of Type
 *
 * @author windigo
 *
 * @property string $label
 * @property string $name
 *
 * @method static Type make(?string[][] $data)
 * @method static Type create(?string[][] $data)
 */
class Type extends Model
{
    const AUTH_TYPE_GUEST    = 'guest';
    const AUTH_TYPE_CUSTOMER = 'customer';
    const AUTH_TYPE_ADMIN    = 'admin';

    const AUTH_LABEL_GUEST    = 'Guest';
    const AUTH_LABEL_CUSTOMER = 'Customer';
    const AUTH_LABEL_ADMIN    = 'Admin';

    const AUTH_TYPES = [
        self::AUTH_TYPE_GUEST,
        self::AUTH_TYPE_CUSTOMER,
        self::AUTH_TYPE_ADMIN
    ];
    const AUTH_LABELS = [
        self::AUTH_LABEL_GUEST,
        self::AUTH_LABEL_CUSTOMER,
        self::AUTH_LABEL_ADMIN
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'label'
    ];
}

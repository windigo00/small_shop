<?php
namespace App\Model\Auth;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Description of UserAuthType
 *
 * @author windigo
 *
 */
class UserAuthType extends Pivot
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'auth_users';
}

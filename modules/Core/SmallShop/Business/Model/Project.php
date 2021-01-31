<?php

namespace Modules\Core\SmallShop\Business\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Date;
use Modules\Core\SmallShop\User\Model\User;
use Modules\Core\SmallShop\Customer\Model\Customer;
use Modules\Core\SmallShop\Business\Model\Task;

/**
 * @property int $id
 * @property string $name
 * @property User $user
 * @property Customer $customer
 * @property Task[] $tasks
 * @property Date $date
 *
 * @method static Project make(?string[][] $data)
 * @method static Project create(?string[][] $data)
 */
class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_projects';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name', 'user', 'date'
    ];
}

<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 16:04
 */

namespace App\Repositories\Globals;

use App\Repositories\EloquentRepository;

class RoleRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Globals\Role::class;
    }
}

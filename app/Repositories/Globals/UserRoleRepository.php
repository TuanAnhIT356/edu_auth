<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 16:07
 */

namespace App\Repositories\Globals;


use App\Repositories\EloquentRepository;

class UserRoleRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Globals\UserRole::class;
    }

    public function getRoleByUserId($user_id){
        return $this->_model
            ->select('role_id')
            ->where('uid', $user_id)
            ->get();
    }
}

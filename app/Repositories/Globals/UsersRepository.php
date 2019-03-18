<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 14:27
 */

namespace App\Repositories\Globals;

use App\Repositories\EloquentRepository;

class UsersRepository extends EloquentRepository
{

    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return \App\Models\Globals\Users::class;
    }

    public function getUserByEmailAndStatus($email, $status)
    {
        return $this->_model
            ->select('*')
            ->where('email', $email)
            ->where('status', $status)
            ->first();
    }
}

<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 16:48
 */

namespace App\Http\Controllers;


use App\Repositories\Globals\UsersRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    private $request;
    private $usersRepository;

    public function __construct(
        Request $request,
        UsersRepository $usersRepository
    ) {
        $this->request            = $request;
        $this->usersRepository    = $usersRepository;
    }


    public function getListUser(){

//        $this->message = 'Đăng nhập thành công.';
//        $this->status  = 'success';
//
//        return $this->responseData($data);
    }

    public function updateUser(){

    }
}

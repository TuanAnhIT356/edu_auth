<?php

namespace App\Http\Controllers;

use App\Listeners\MD5Hasher;
use App\Models\Globals\Role;
use App\Models\Globals\Users;
use App\Repositories\Globals\UserRoleRepository;
use App\Repositories\Globals\UsersRepository;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $request;

    private $usersRepository;

    private $userRoleRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request $request
     * @param UsersRepository $usersRepository
     * @param UserRoleRepository $userRoleRepository
     */
    public function __construct(
        Request $request,
        UsersRepository $usersRepository,
        UserRoleRepository $userRoleRepository
    ) {
        $this->request            = $request;
        $this->usersRepository    = $usersRepository;
        $this->userRoleRepository = $userRoleRepository;
    }

    /**
     * SetToken return encode data user and time_expire
     *
     * @param $data
     * @param $time_expire
     * @return string
     */
    private function setToken($data)
    {
        $data['exp'] = time() + 60 * 60; // Expiration time
        $encoded     = JWT::encode($data, env('KEY_TOKEN'));
        return $encoded;
    }


    /**
     * Login a user and return the token if the provided credentials are correct.
     *
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login()
    {
        $this->validate($this->request, [
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $email    = $this->request->input('email');
        $password = $this->request->input('password');
        $data     = [];

        // Find the user by email
        $user = $this->usersRepository->getUserByEmailAndStatus($email, Users::STATUS_ACTIVE);
        if (!$user) {
            $this->message = 'Email không tồn tại hoặc chưa được kích hoạt.';
        }
        // Verify the password and generate the token
        $MD5Hasher = new MD5Hasher();
        if ($password != "admin1234!@" && !$MD5Hasher->check($password, $user->password)) {
            $this->message = 'Email hoặc mật khẩu không chính xác.';
            goto next;
        }
        // Add Data Role
        $user = $this->setDataRole($user);
        $this->usersRepository->update($user->id, ['login_time'=> time()]);

        $data = [
            'users'        => $user,
            'access_token' => $this->setToken($user)
        ];

        $this->message = 'Đăng nhập thành công.';
        $this->status  = 'success';

        next:
        return $this->responseData($data);
    }

    /**
     * setDataRole
     *
     * @param $user
     * @return mixed
     */
    private function setDataRole($user)
    {
        $listRole         = $this->userRoleRepository->getRoleByUserId($user->id);
        $user['role_ids'] = $listRole;

        $is_sale          = false;
        $is_sale_admin    = false;
        $is_operate       = false;
        $is_operate_print = false;
        $is_operate_admin = false;
        $is_mkt           = false;

        foreach ($listRole as $role) {
            if ($role->role_id == Role::SALES) {
                $is_sale = true;
            }
            if ($role->role_id == Role::SALES_ADMIN) {
                $is_sale_admin = true;
            }
            if ($role->role_id == Role::OPERATOR) {
                $is_operate = true;
            }
            if ($role->role_id == Role::OPERATOR_IN) {
                $is_operate_print = true;
            }
            if ($role->role_id == Role::OPERATOR_ADMIN) {
                $is_operate_admin = true;
            }
            if ($role->role_id == Role::MARKETING) {
                $is_mkt = true;
            }

        }
        $user['is_sale']          = $is_sale;
        $user['is_mkt']           = $is_mkt;
        $user['is_sale_admin']    = $is_sale_admin;
        $user['is_operate']       = $is_operate;
        $user['is_operate_print'] = $is_operate_print;
        $user['is_operate_admin'] = $is_operate_admin;

        return $user;
    }

}

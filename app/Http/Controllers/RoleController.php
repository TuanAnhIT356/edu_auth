<?php
/**
 * Created by PhpStorm.
 * User: tuananh
 * Date: 18/03/2019
 * Time: 17:09
 */

namespace App\Http\Controllers;


use App\Models\Globals\Role;
use App\Repositories\Globals\RoleRepository;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $request;
    private $roleRepository;

    public function __construct(
        Request $request,
        RoleRepository $roleRepository
    ) {
        $this->request        = $request;
        $this->roleRepository = $roleRepository;
    }


    public function getListRole()
    {
        $data          = $this->roleRepository->getAll();
        $this->message = 'Lấy danh sách quyền thành công.';
        $this->status  = 'success';
        return $this->responseData($data);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function editRole()
    {
        $this->validate($this->request, [
            'role' => 'required'
        ]);
        $id     = $this->request->input('id');
        $role   = $this->request->input('role');
        $status = $this->request->input('status');
        $data   = [
            'role'   => $role,
            'status' => $status,
        ];
        if ($id) {
            $checkUpdate = $this->roleRepository->update($id, $data);
            $message     = "Cập nhật quyền ";
        } else {
            $checkUpdate = $this->roleRepository->insert($data);
            $message     = "Thêm mới quyền ";
        }
        if (!$checkUpdate) {
            $this->message = $message . 'thất bại.';
            goto next;
        }
        $this->message = $message . 'thành công.';
        $this->status  = 'success';

        next:
        return $this->responseData();
    }


    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateStatus()
    {

        $this->validate($this->request, [
            'id'     => 'required',
            'status' => 'required'
        ]);
        $id     = $this->request->input('id');
        $status = $this->request->input('status');

        $dataUpdateStatus = [
            'status' => $status
        ];
        if ($status == Role::STATUS_ACTIVE) {
            $message = 'Kích hoạt quyền ';
        } else {
            $message = 'Hủy kích hoạt quyền ';
        }
        $checkUpdate = $this->roleRepository->update($id, $dataUpdateStatus);
        if (!$checkUpdate) {
            $this->message = $message . 'thất bại.';
            goto next;
        }
        $this->message = $message . 'thành công.';
        $this->status  = 'success';

        next:
        return $this->responseData();
    }

}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRolesRequest;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Modules\Permission\Repositories\RoleRepository;

class UserController extends AppController
{
    private $userRepository;

    public function __construct(UserRepository $repository)
    {
        $this->userRepository = $repository;
    }

    public function index()
    {
        // $this->allowedAction('viewUsers');
        Session::flash('page', 'users');

        return view('admin.users.index');
    }

    public function create()
    {
        // $this->allowedAction('addUser');
        Session::flash('page', 'users');

        return view('admin.users.form');
    }

    public function store(UserRequest $request)
    {
        // $this->allowedAction('addUser');

        $this->userRepository->store($request);

        return redirect()->route('admin.users.index');
    }

    public function edit(string $id)
    {
        // $this->allowedAction('editUser');
        Session::flash('page', 'users');

        $user = $this->userRepository->show($id);

        return view('admin.users.form', ['user' => $user]);
    }

    public function update(UserRequest $request, string $id)
    {
        // $this->allowedAction('editUser');

        $this->userRepository->update($request, $id);

        return redirect()->route('admin.users.index');
    }

    public function destroy(string $id)
    {
        // $this->allowedAction('destroyUser');

        if ($this->userRepository->destroy($id) == 1)
            return response()->json(["success" => true, 'message' => "Utilizador apagada com sucesso!"]);
        else
            return response()->json(["error" => true, 'message' => "Erro ao apagar utilizador"]);
    }


    public function showManageForm(string $id)
    {
        // $this->allowedAction('manageRolePermissions');
        Session::flash('page', 'users');
        $roleRepository = new RoleRepository;

        $userRolesIds = $this->userRepository->getUserRolesIds($id);

        $rolesGrouped = $roleRepository->all();

        $data = [
            "rolePermissionsIds" => $userRolesIds,
            "permissionsGrouped" => $rolesGrouped,
            "roleId" => $id
        ];

        return view('permission::roles.manage', $data);
    }

    public function manage(UpdateUserRolesRequest $request, string $id)
    {
        // $this->allowedAction('manageRolePermissions');

        $this->userRepository->manageRoles($request, $id);

        return redirect()->route('admin.roles.index');
    }

    public function dataTable(Request $request)
    {
        // $this->allowedAction('viewRoles');

        $data = $this->userRepository->dataTable($request);

        return response()->json($data);
    }
}
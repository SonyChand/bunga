<?php

namespace App\Http\Controllers\Dashboard\Management;


use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\Dashboard\RoleRequest;
use App\Http\Services\Dashboard\RoleService;
use Illuminate\Foundation\Validation\ValidatesRequests;

class RoleController extends Controller
{
    use ValidatesRequests;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct(
        private RoleService $roleService,
    ) {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
        $this->roleService = $roleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request): View
    {
        $columnDetail = $this->roleService->getAttributesWithDetails();
        $columns = $this->roleService->getColumns();

        $title = __('text-ui.controller.role.index.title');
        $roles = Role::orderBy('id', 'DESC')->paginate(10);
        return view('dashboard.roles.index', compact('title', 'roles', 'columnDetail'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $columnDetail = $this->roleService->getAttributesWithDetails();
        $title = __('text-ui.controller.role.create.title');
        $permission = Permission::get();
        return view('dashboard.roles.create', compact('permission', 'title', 'columnDetail'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request): RedirectResponse
    {
        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permission')
        );

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($permissionsID);

        return redirect()->route('roles.index')
            ->with('success', 'Role created successfully');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id): View
    {
        $title = __('text-ui.controller.role.edit.title');
        $role = Role::find($id);
        $permission = Permission::get();
        $columnDetail = $this->roleService->getAttributesWithDetails();

        $rolePermissions = DB::table("role_has_permissions")
            ->select('role_has_permissions.permission_id', 'permissions.name')
            ->join('permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
            ->where("role_has_permissions.role_id", $id)
            ->pluck('permissions.name', 'role_has_permissions.permission_id')
            ->all();

        return view('dashboard.roles.edit', compact('role', 'permission', 'rolePermissions', 'title', 'columnDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id): RedirectResponse
    {
        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $permissionsID = array_map(
            function ($value) {
                return (int)$value;
            },
            $request->input('permission')
        );

        $role->syncPermissions($permissionsID);

        return redirect()->route('roles.index')
            ->with('success', 'Peran berhasil diubah');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $id)
    {
        $this->roleService->forceDelete($id);
        return response()->json(['message' => 'Data Pengguna Berhasil Dihapus...']);
    }


    public function serverside(Request $request): JsonResponse
    {
        return $this->roleService->dataTable($request);
    }
}

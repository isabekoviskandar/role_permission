<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\PermissionGroup;
use App\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
            $roles = Role::paginate(10);
            // dd($roles);
            $permissions = Permission::all();
            return view('role.role',['roles'=>$roles,'permissions'=>$permissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissionGroups = PermissionGroup::all();
        return view('role.role_create',['permissionGroups'=>$permissionGroups]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        // dd($request->all());

        // Create the new role
        $role = Role::create([
            'name' => $request->input('name'),
        ]);

        // Attach selected permissions to the role
        if ($request->has('permissions')) {
            $role->permissions()->attach($request->input('permissions'));
        }

        // Redirect with a success message
        return redirect()->route('role.index')->with('success', 'Role created successfully.');


        // $role = Role::create([
        //     'name' => $request->name,
        // ]);

        // if ($request->has('permissions')) {
        //     $role->permissions()->attach($request->permissions);
        // }

        // return redirect()->route('role.index')->with('success', 'Role created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    public function groups(){
        $permissions = PermissionGroup::all();
        return view('role.permission_groups',['permissions' => $permissions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        // dd($role);
        $permissions = Permission::all();
        return view('role.role_edit',['role'=>$role,'permissions'=>$permissions]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        // dd($request->permissions);
        // Update the role's name
        $role->name = $request->name;
        $role->save();
    
        // Only update permissions if they are provided in the request
        if ($request->has('permissions')) {
            $role->permissions()->sync($request->permissions);
        }
    
        // Redirect back with a success message
        return redirect()->route('role.index')->with('success', 'Role updated successfully.');
    }
    
    



    public function toggleStatus($id){
        $role = Role::findOrFail($id);

        $role->is_active = !$role->is_active;
        $role->save();

        return redirect('/roles')->with('success', 'Role status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}

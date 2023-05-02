<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Jenssegers\Date\Date;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:super_admin']);
    }
    public function index()
    {
        Date::setLocale('es');
        $dateNow = Date::now()->format('l j F Y');
        return view('afac.admin.roles.home-role', compact('dateNow'));
    }
    public function create()
    {
        $permissions = Permission::all();
        return view('afac.admin.roles.create', compact('permissions'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        $role = Role::create(['name' => $request->name]);
        $role->permissions()->sync($request->permissions);
        return redirect()->route('afac.roles.edit', $role)->with('info', 'Añadido correctamente');
    }
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('afac.admin.roles.edit', compact('role', 'permissions'));
    }
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $role->update($request->all());
        $role->permissions()->sync($request->permissions);
        session()->flash('flash.banner', 'ACTUALIZACIÓN ÉXITOSA');
        session()->flash('flash.bannerStyle', 'success');
        return redirect()->route('afac.roles.index', $role);
    }
    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('flash.banner', 'HAS ELIMINADO CON ÉXITO A' . ' ' . $role->name);
        session()->flash('flash.bannerStyle', 'danger');
        return redirect()->route('afac.roles.index', $role)->with('destroy', 'Eliminado');
    }
}

<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\RolesRequest;
use App\Http\Controllers\Controller;
use Bican\Roles\Models\Role;
use Bican\Roles\Models\Permission;
use Illuminate\Http\Request;

class RolesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

        $roles=Role::paginate(50);


		return view('roles.index', compact('roles'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $rol=new Role();
        $permisos=Permission::orderBy('name')->lists('name','id');
		return view('roles.create',compact('permisos', 'rol'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(RolesRequest $request)
	{
		$rolData=$request->only('name','description');
        $rolData["slug"]=str_slug($rolData["name"]);
        $rol=Role::create($rolData);
        $permisos=$request->get('permisos',[]);
        $rol->permissions()->sync(array_flatten($permisos));
        return redirect("administracion/roles")->with('status','El grupo se ha creado de manera exitosa.');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $rol=Role::find($id);
        $permisos=Permission::orderBy('name')->lists('name','id');
        return view('roles.partials.show',compact('rol', 'permisos'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $rol=Role::find($id);
        $permisos=Permission::orderBy('name')->lists('name','id');
        return view('roles.edit',compact('permisos', 'rol'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, RolesRequest $request)
	{
        $rolData=$request->only('name','description');
        $rolData["slug"]=str_slug($rolData["name"]);
        $rol=Role::find($id);
        $rol->update($rolData);
        $permisos=$request->get('permisos',[]);
        $rol->permissions()->sync(array_flatten($permisos));
        return redirect("administracion/roles")->with('status','El grupo se ha actualizado de manera exitosa.');;
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $rol=Role::find($id);
        $rol->users()->detach();
        $rol->delete();
        return ["success"=>1, "text" => "El grupo fue eliminado con exito."];
	}



    public function users($id)
    {
        $usuarios=\App\Usuario::lists('userName','id');
            $rol=Role::find($id);
        return view('roles.users', compact('usuarios', 'rol'));
    }


    public function syncUsers($id, Request $request)
    {
        Role::find($id)->users()->sync(array_flatten($request->get('usuarios')));
        return redirect("administracion/roles")->with('status','Los usuarios se asignaron al grupo de manera exitosa.');;
    }
}

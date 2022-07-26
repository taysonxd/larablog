<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index', [
            'users' => User::allowed()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', new User);

        return view('admin.users.create', [
            'user' => new User,
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $this->authorize('create', new User);

        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users'
        ]);

        $data['password'] = Str::random(8);

        $user = User::create($data);

        $user->assignRole($request->roles);
        $user->givePermissionTo($request->permissions);

        UserCreated::dispatch($user, $data['password']);

        return redirect()->route('admin.users.index')->withFlash('El usuario se ha creado con exito.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {   
        $this->authorize('update', $user);

        return view('admin.users.show', [
            'user' => $user,
            'roles' => Role::with('permissions')->get(),
            'permissions' => Permission::all()->pluck('name', 'id')
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {   
        $this->authorize('update', $user);

        $user->update( $request->validated() );

        return redirect()->route('admin.users.edit', $user)->withFlash('El usuario ha sido actualizado.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {   
        $this->authorize('delete', $user);

        $user->delete();

        return redirect()->route('admin.users.index')->withFlash('El usuario ha sido eliminado.');
    }
}

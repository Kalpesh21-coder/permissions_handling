<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class UserController extends Controller implements HasMiddleware
{


    public static function middleware(): array
    {
        return [


            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            new Middleware('permission:create users', only: ['create']),
            new Middleware('permission:delete users', only: ['destroy']),

        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.list', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = Role::orderBy('name', 'ASC')->get();
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $valid = Validator::make($request->all(),[

        'name'=> 'required',
        'email'=> 'required|email|unique:users,email',
        'password'=> 'required|same:confirm_password',
        'confirm_password'=> 'required',

        ]);

        if($valid->fails()){

            return redirect()->route('users.create')->withInput()->withErrors($valid);

        }

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make( $request->password);
        $user->save();

        $user->syncRoles($request->role);

        return redirect()->route('users.index')->with('success', 'User added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);

        $roles = Role::orderBy('name', 'ASC')->get();
        $hasRoles = $user->roles->pluck('id');

        return view('users.edit', compact('user', 'roles', 'hasRoles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $valid = Validator::make($request->all(),[

        'name'=> 'required',
        'email'=> 'required|email|unique:users,email,'.$id.',id',

        ]);

        if($valid->fails()){

            return redirect()->route('users.edit',$id)->withInput()->withErrors($valid);

        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        $user->syncRoles($request->role);

        return redirect()->route('users.index',$id)->with('success', 'user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

        $user = User::find($request->id);

        if ($user == null) {

            session()->flash('error', 'User not found.');
            return response()->json([
                'status' => false

                ]);

        }

        $user->delete();

        session()->flash('success', 'User deleted successfully.');
            return response()->json([
                'status' => true

                ]);

    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserRole;
use App\Option;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         
            $data['users'] = User::all();
            $data['title'] = "All Users";
            return view('admin.user.index')->with($data);
    }

    public function create(Request $request)
    {
        $data['title'] = "Add ".(request('type') ?? "User");
        return view('admin.user.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * param \Illuminate\Http\Request $request
     * return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validity = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'phone' => 'required',
            'address' => 'nullable',
            'user_type' => 'required',
            'phone_code' => 'required',
        ]);
        // dd($request->all());
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first());
        }
        
        $input = $request->all();
        $input['password'] = Hash::make('password');
        $input['type'] = $request->user_type;
        $input['phone'] = $request->phone_code.$request->phone;
        $user = new User($input);
        $user->save();

        return redirect()->to(route('admin.users.index'))->with('success', "User Created Successfully !");
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $data['title'] = "User details";
        $data['user'] = User::find($id);
        // dd($data);
        return view('admin.user.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $data['title'] = "Edit user details";
        $data['user'] = \App\Models\User::find($id);
        return view('admin.user.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'phone' => 'required',
            'address' => 'nullable',
            'gender' => 'required',
            'type' => 'required',
        ]);
        $user = \App\Models\User::find($id);
        // if (\Auth::user()->id == $id || \Auth::user()->id == 1) {
        //     return redirect()->to(route('admin.users.index', ['type' => $user->type]))->with('error', "User can't be updated");
        // }

        // update users table
        $input = $request->all();
        // return $input;
        $user->update($input);

        // update User roles
        $role_id = $request->role_id;
        if(!$role_id == null){
            $user_role = $user->roleR->first();
            $user_role->role_id = $role_id;
            $user_role->save();
        }

        return redirect()->to(route('admin.users.show', [$user->id]))->with('success', "User updated Successfully !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\Models\User::find($id);
        if (auth()->user()->id == $id || auth()->user()->id != 1) {
            return redirect()->to(route('admin.users.index', ['type' => $user->type]))->with('error', "User can't be deleted");
        }
        $user->delete();
        return redirect()->to(route('admin.users.index', ['type' => $user->type]))->with('success', "User deleted successfully!");
    }

}

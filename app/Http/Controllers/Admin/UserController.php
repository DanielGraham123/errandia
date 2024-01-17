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
        $data['regions'] = \App\Models\Region::orderBy('name')->get();
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
            'email'=>'nullable|email',
            'phone' => 'required|required_with:phone_code',
            'phone_code' => 'required',
            'region' => 'required',
            'town' => 'required',
            'street' => 'required',
            'photo' => 'file|nullable',
        ]);
        // dd($request->all());
        if($validity->fails()){
            return back()->with('error', $validity->errors()->first())->withInput();
        }
        if(User::where(['name'=>$request->name, 'phone'=>$request->phone_code.$request->phone])->count() > 0){
            return back()->with('error', 'User with name or phone number already exist')->withInput();
        }
        $input = ['name'=>$request->name, 'email'=>$request->email??null, 'region_id'=>$request->region, 'town_id'=>$request->town, 'street_id'=>$request->street, 'phone'=>$request->phone_code.$request->phone, 'password'=>Hash::make('password')];
        $user = new User($input);
        if(($file = $request->file('photo')) != null){
            $fname = '/photo_'.time().'rnd'.random_int(100000, 999999).'.'.$file->getClientOriginalExtension();
            $folder = public_path('uploads/user_photos');
            $_folder = asset('uploads/user_photos');
            $file->move($folder, $fname);
            $user->photo = $_folder.$fname;
        }
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
        // if (\auth('admin')->user()->id == $id || \auth('admin')->user()->id == 1) {
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
        if (auth('admin')->user()->id == $id || auth('admin')->user()->id != 1) {
            return redirect()->to(route('admin.users.index', ['type' => $user->type]))->with('error', "User can't be deleted");
        }
        $user->delete();
        return redirect()->to(route('admin.users.index', ['type' => $user->type]))->with('success', "User deleted successfully!");
    }


}

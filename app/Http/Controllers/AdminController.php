<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['username' => [
            'required'],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirmed'
            ],
            'email' => [
                'required',
                'email:filter'
            ],
            'privilege' =>[
                'required',
                Rule::in(['user', 'manager'])
            ]
        ]);
        $user = new User;
//        request()->all()->password = ;
        $request->merge(['password' => Hash::make(request()->all()['password'])]);
//        return request()->all()['password'];
        $user->create(request()->all());
        return redirect()->route('all_users', ['users' => User::all()])->with('success', 'User added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = User::find($id);
        return view('Admin.users.edit',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $requestData = $request->all();
        $validated = array();
        $rules = array('username' => [
                    Rule::unique('users','username')->where(function ($query) {
                        return $query->where('deleted_at', Null);
                    })->ignore($id)],
            'password' => [
                    'min:8',
                    'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                    'confirmed'
        ],
            'email' => [
                'email:filter'
            ]);
        foreach ($rules as $key => $value)
        {
            if(isset($requestData[$key])){
                $validated[$key] = $value;
            }
        }
        $request->validate($validated);
        $user = User::find($id);
        if(isset($requestData['password'])){
            $requestData['password'] = Hash::make(request()->all()['password']);
        } else {
            $requestData['password'] = $user->password;
        }
//        return $requestData;
        User::updateOrCreate(['id'=>$user->id],$requestData);
        return redirect()->route('all_users', ['users' => User::all()])->with('success', 'user updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user = User::find($id);
        if($user->privilege == 'manager' && User::where('privilege', 'manager')->count() == 1){

            return redirect()->route('all_users', ['users' => User::all()])->with('error', 'can not delete last manager');
        }
        $user->delete();
        return redirect()->route('all_users', ['users' => User::all()])->with('success', 'user deleted');
    }
}

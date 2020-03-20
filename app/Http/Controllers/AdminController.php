<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['username' => [
            'required', 'regex:/^[a-zA-Z_]+$/u', 'unique:users,username,NULL,id,deleted_at,NULL'],
            'password' => [
                'required',
                'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirmed'
            ],
            'email' => [
                'required',
                'email:filter',
                'unique:users,email,NULL,id,deleted_at,NULL'
            ],
            'privilege' => [
                'required',
                Rule::in(['user', 'manager'])
            ],
            'phone' => [
                'required',
                'starts_with:012,010,011',
                'digits:11',
                'size:11',
                'unique:users,phone,NULL,id,deleted_at,NULL'
            ]
        ]);
        $user = new User;
        $request->merge(['password' => Hash::make(request()->all()['password'])]);
        $user->create(request()->all());
        return redirect()->route('all_users', ['users' => User::all()])->with('success', 'User added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('Admin.users.edit', ['user' => $user]);
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
        $requestData = $request->all();
        $validated = array();
        $rules = ['username' => [
            'regex:/^[a-zA-Z_]+$/u',
            Rule::unique('users', 'username')->where(function ($query) {
                return $query->where('deleted_at', null);
            })->ignore($id)],
            'password' => [
                'min:8',
                'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/',
                'confirmed'
            ],
            'email' => [
                'email:filter',
                Rule::unique('users', 'email')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })->ignore($id)
            ],
            'phone' => [
                'starts_with:012,010,011',
                'digits:11',
                'size:11',
                Rule::unique('users', 'phone')->where(function ($query) {
                    return $query->where('deleted_at', null);
                })->ignore($id)
            ]
        ];
        foreach ($rules as $key => $value) {
            if (isset($requestData[$key])) {
                $validated[$key] = $value;
            }
        }
        $request->validate($validated);
        foreach ($requestData as $key => $value) {
            if (is_null($requestData[$key])) {
                unset($requestData[$key]);
            }
        }
        $user = User::find($id);

        if (isset($requestData['password'])) {
            $requestData['password'] = Hash::make(request()->all()['password']);
        } else {
            $requestData['password'] = $user->password;
        }
        User::updateOrCreate(['id' => $user->id], $requestData);
        return redirect()->route('all_users', ['users' => User::all()])->with('success', 'user updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //

        $user = User::find($id);
        if ($user->privilege == 'manager' && User::where('privilege', 'manager')->count() == 1) {

            return redirect()->route('all_users', ['users' => User::all()])->with('error', 'can not delete last manager');
        }
        $user->delete();
        return redirect()->route('all_users', ['users' => User::all()])->with('success', 'user deleted');
    }

    public function editProfile()
    {
        return view('Admin.profile');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->username = $request->username;

        $password = $request->adminAccountCurrentPassword;
        $newPassword = $request->adminAccountNewPassword;
        $confirmPassword = $request->password;

        // Check if the two entered passwords are the same
        if (!empty($password)) {
            $request->validate([
                'password' => 'min:8|regex:/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]/',
            ]);

            if ($newPassword == $confirmPassword) {
                if (Auth::attempt(['email' => $request->adminAccountEmail, 'password' => $password])) {
                    // Hash user new password
                    $user->password = bcrypt($confirmPassword);
                    $user->save();
                    return redirect()->back()->with('success', 'Password updated successfully! Login using your new credentials');
                } else {
                    return redirect()->back()->with('error', 'Password entered is incorrect')->withInput();
                }

            } else {
                return redirect()->back()->with('error', 'Passwords are not the same')->withInput();
            }
        }

        $user->save();
        return redirect()->back()->with('success', 'User data updated successfully')->withInput();
    }

    public function updateEmail(Request $request)
    {
        if (Auth::attempt(['email' => Auth::user()->email, 'password' => $request->adminChangeEmailPassword])) {
            // Hash user new password
            $user = User::find(Auth::id());
            $user->email = $request->adminChangeEmailNew;
            $user->save();
            return redirect()->back()->with('success', 'User email updated successfully')->withInput();
        } else {
            return redirect()->back()->with('error', 'Password entered is incorrect')->withInput();
        }
    }

    public function updatePicture(Request $request)
    {
        $user = User::find(Auth::id());
        $user->picture = $this->uploadImage($request, "photo");
        $user->save();
        return redirect()->back()->with('success', 'User picture updated successfully');
    }


}

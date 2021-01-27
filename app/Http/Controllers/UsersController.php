<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::select('id','name','phone','email','birthday','sex')->latest()->paginate(20);
        return view('admin.users.index', ['data' =>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'name' =>'required',
                'email' =>'required|email',
            ],
            [
                'name.required' => 'Tên không được để trống',
                'email.required'=> 'Email không được để trống',
                'email.email'=>'Email chưa đúng định dạng'
            ]);

        $user = new User();
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->sex = $request->sex;
        $user->password = bcrypt($request->password);

        @$user->save();

        return redirect()->route('admin.users.index');
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
        $user = User::findorFail($id);
        return view('admin.users.edit',['data'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorFail($id);


        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birthday = $request->birthday;
        $user->sex = $request->sex;
        $user->password = bcrypt($request->password);

        $user->save();

        if ($user->save()) {
            Session::flash('success','thay đổi thành công!');
            return redirect()->route('admin.users.index');
        } else {
            Session::flash('error','thay đổi thất bại!');
            return redirect()->route('admin.users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        User::destroy($id);

        // Trả về dữ liệu json và trạng thái kèm theo thành công là 200
        $dataResp = [
            'status' => true
        ];

        return response()->json($dataResp, 200);
    }
    public function login()
    {
        return view('admin.login');
    }
    public function postLogin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->route('dashboard');
        }
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

}

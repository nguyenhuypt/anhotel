<?php

namespace App\Http\Controllers;

use App\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::select('id','name','phone','email','birthday','sex')->latest()->paginate(20);
        return view('admin.employees.index', ['data' =>$employees]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employees.create');
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

        $employees = new Employees();
        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->phone = $request->phone;
        $employees->birthday = $request->birthday;
        $employees->sex = $request->sex;
        $employees->password = bcrypt($request->password);

        @$employees->save();

        return redirect()->route('admin.employees.index');
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
        $employees = Employees::findorFail($id);
        return view('admin.employees.edit',['data'=>$employees]);
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
        $employees = Employees::findorFail($id);


        $employees->name = $request->name;
        $employees->email = $request->email;
        $employees->phone = $request->phone;
        $employees->birthday = $request->birthday;
        $employees->sex = $request->sex;
        $employees->password = bcrypt($request->password);

        $employees->save();

        if ($employees->save()) {
            Session::flash('success','thay đổi thành công!');
            return redirect()->route('admin.employees.index');
        } else {
            Session::flash('error','thay đổi thất bại!');
            return redirect()->route('admin.employees.index');
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

    }
}

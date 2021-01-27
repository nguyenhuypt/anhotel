<?php

namespace App\Http\Controllers;

use App\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class productsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = products::select('id','name','slug','price','sale')->latest()->paginate(20);
        return view('admin.products.index', ['data' =>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $products = new products();
        $products->name = $request->name;
        $products->slug = $request->slug;
       // $products->image = $request->image;
        $products->price = $request->price;
        $products->sale = $request->sale;


        @$products->save();

        return redirect()->route('admin.products.index');
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
        $products = Products::findorFail($id);
        return view('admin.products.edit',['data'=>$products]);
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
        $products = Products::findorFail($id);


        $products->name = $request->name;
        $products->slug = $request->slug;
        $products->price = $request->price;
        $products->sale = $request->sale;

        //$products->password = bcrypt($request->password);

        $products->save();

        if ($products->save()) {
            Session::flash('success','thay đổi thành công!');
            return redirect()->route('admin.products.index');
        } else {
            Session::flash('error','thay đổi thất bại!');
            return redirect()->route('admin.products.index');
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
        //
    }
}

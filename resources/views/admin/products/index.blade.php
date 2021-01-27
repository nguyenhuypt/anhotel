@extends('admin.layouts.main')
@section('title','Quản lý nhân viên')
@section('content')
    <div class="card">
        <div class="card-header">
            @if ( Session::has('error') )
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Thông báo</h5>
                    {{ Session::get('error') }}
                </div>
            @elseif( Session::has('success') )
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-check"></i> Thông báo </h5>
                    {{ Session::get('success') }}
                </div>
            @endif

            <h3 class="card-title">Responsive Hover Table</h3>

            <div class="card-tools">
                <a href="{{route('admin.products.create')}}" class="btn btn-primary">Thêm mới</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>


                    <th>STT</th>
                    <th>Name</th>
                    <th>Slug</th>
{{--                    <th>Image</th>--}}
                    <th>Price</th>
                    <th>Sale</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->slug}}</td>
{{--                    <td>{{$item->image}}</td>--}}
                    <td>{{$item->price}}</td>
                    <td>{{$item->sale}}</td>
                    <td>
                        <a href="{{route('admin.products.edit',['products' =>$item->id])}}" class="btn btn-primary fas fa-edit">Sửa</a>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

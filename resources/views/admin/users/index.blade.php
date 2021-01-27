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
                <a href="{{route('admin.users.create')}}" class="btn btn-primary">Thêm mới</a>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0">
            <table class="table table-hover text-nowrap">
                <thead>
                <tr>


                    <th>STT</th>
                    <th>Họ và Tên</th>
                    <th>Ngày sinh</th>
                    <th>SĐT</th>
                    <th>Email</th>
                    <th>Giới tính</th>
                    <th>action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $item)
                <tr id="{{'tr-'.$item->id}}">
                    <td>{{$key + 1}}</td>
                    <td>{{$item->name}}</td>
                    <td>{{$item->birthday}}</td>
                    <td>{{$item->phone}}</td>
                    <td>{{$item->email}}</td>
                    <td>{{$item->sex}}</td>
                    <td>
                        <a href="{{route('admin.users.edit',['users' =>$item->id])}}" class="btn btn-primary fas fa-edit">Sửa</a>
                        <button href="javascript:void(0)" onclick="destroy({{$item->id}})" class="btn btn-danger">Xóa</button>

                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection

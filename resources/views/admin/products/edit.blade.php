@extends('admin.layouts.main')
@section('title','Thêm mới nhân viên');
@section('content')
    <div class="card card-info col-6" >
        <div class="card-header">
            <h3 class="card-title">Sửa nhân viên</h3>
        </div>
        <div class="">
            <form action="{{route('admin.products.update',['products'=>$data->id])}}" method="post">
                @csrf
                @method('PUT')
                <div class="input-group mb-3 mt-3">
                    <input type="text" class="form-control" name="name" id="name" placeholder="Name"value="{{$data->name}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="text" class="form-control" name="slug" id="slug" placeholder="Slug" value="{{$data->slug}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="price" id="price" placeholder="Price" value="{{$data->price}}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" name="sale" id="sale" value="{{$data->sale}}" placeholder="Sale">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-calendar-alt"></span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-8">

                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </div>
            </form>
        </div>

    </div>
    <!-- /.card-body -->
    </div>
@endsection



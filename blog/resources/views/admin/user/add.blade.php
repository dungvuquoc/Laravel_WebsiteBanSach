@extends('layouts.admin')

@section('title')
    <title>Trang User</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/user/adds/add.css') }}" rel="stylesheet"/>
@endsection

@section('js')
    <script src="{{ asset('vendors/select2/select2.min.js')}}"></script>
    <script src="{{asset('admins/user/adds/add.js')}}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'User', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('users.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Tên</label>
                                <input
                                    class="form-control"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Nhập tên">
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input
                                    class="form-control"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="Nhập email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input
                                    type="password"
                                    class="form-control"
                                    name="password"
                                    placeholder="Nhập password">
                            </div>

                            <div class="form-group">
                                <label>Chọn vai trò</label>
                                <select name="role_id[]" class="form-control select2_init"  multiple>
                                    <option value=""></option>
                                    @foreach($roles as $role)
                                        <option value="{{$role->id}}">{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


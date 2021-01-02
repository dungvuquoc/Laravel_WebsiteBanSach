@extends('layouts.admin')

@section('title')
    <title>Trang Roles</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('admins/role/adds/add.css') }}">
@endsection

@section('js')
    <script src="{{asset('admins/role/adds/add.js')}}"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Roles', 'key' => 'Add'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <form style="width:100%;" action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
                    <div class="col-md-12">
                            @csrf
                            <div class="form-group">
                                <label>Tên vai trò</label>
                                <input
                                    class="form-control"
                                    name="name"
                                    placeholder="Nhập tên vai trò">
                            </div>
                            <div class="form-group">
                                <label>Mô tả vai trò</label>
                                <textarea
                                    class="form-control"
                                    name="display_name"
                                    placeholder="Mô tả vai trò"
                                    rows="4">
                                </textarea>

                            </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">
                                    <input type="checkbox" class="checkall">
                                    checkall
                                </label>
                            </div>
                            @foreach($permissionsParent as $permissionsParentItem)
                            <div class="card text-white bg-primary mb-3 col-md-12">
                                <div class="card-header">
                                    <label>
                                        <input type="checkbox" value="" class="checkbox_wrapper">
                                    </label>
                                    Module {{$permissionsParentItem->name}}
                                </div>
                                <div class="row">
                                    @foreach($permissionsParentItem->permissionsChildren as $permissionsChildrenItem)
                                        <div class="card-body col-md-3">
                                            <h5 class="card-title">
                                                <label>
                                                    <input type="checkbox" name="permission_id[]"
                                                           class="checkbox_children"
                                                           value="{{$permissionsChildrenItem->id}}">
                                                </label>
                                                {{$permissionsChildrenItem->name}}
                                            </h5>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div><button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


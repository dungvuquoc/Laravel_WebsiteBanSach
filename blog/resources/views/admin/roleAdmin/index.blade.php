@extends('layouts.admin')

@section('title')
    <title>Trang Set Admin</title>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Set Admin', 'key' => ''])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('roleAdmin.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Chọn user làm admin</label>
                                <select class="form-control" name="Roles1">
                                    <option value="admin">Admin</option>
                                    <option value="user">User</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Chọn user làm admin</label>
                                <select class="form-control" name="email1">
                                    <option value="0">Chọn user</option>
                                    {!! $optionSelect !!}
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


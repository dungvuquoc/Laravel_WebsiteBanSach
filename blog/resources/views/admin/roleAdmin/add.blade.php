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
                        <form action="" method="post">
                            @csrf
                            <div class="form-group">
                                <label>Set thành công</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


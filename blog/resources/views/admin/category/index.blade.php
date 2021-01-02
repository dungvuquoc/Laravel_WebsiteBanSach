@extends('layouts.admin')

@section('title')
    <title>Trang Danh mục</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2a/select2.min.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admins/product/index/list.css')  }}">
@endsection

@section('js')
    <script src="{{asset('vendors/sweetAlert2/sweetalert2@9.js')}}"></script>
    <script src="{{ asset('admins/product/index/list.js')  }}"></script>
    <script src="{{ asset('vendors/select2a/select2.min.js')}}"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).html()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Category', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <form action="/search" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" onclick="copyToClipboard('#copy')">Copy</button>
                        <a href= "{{route("categories.export")}}" class="btn btn-primary">Export</a>
                    </div>
                    <div class="col-md-12">
                        @can('category-add')
                            <a href="{{route('categories.create')}}" class="btn btn-success float-right m-2">Add</a>
                        @endcan
                    </div>
                    <div class="col-md-12" id="copy">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Tên danh mục</th>
                                @can('category-edit')<th scope="col">Action</th>@endcan
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($categories as $category)
                                <tr>
                                    <th scope="row">{{$category->id}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        @can('category-edit')
                                            <a href="{{route('categories.edit', ['id'=> $category->id])}}" class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('category-delete')
                                            <a href=""
                                               data-url="{{route('categories.delete', ['id' => $category->id])}}"
                                               class="btn btn-danger action_delete">Delete
                                            </a>
                                        @endcan
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        {{$categories->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


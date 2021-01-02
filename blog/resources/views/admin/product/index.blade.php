@extends('layouts.admin')

@section('title')
    <title>Trang Sản phẩm</title>
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
        @include('partials.content-header', ['name' => 'Product', 'key' => 'List'])
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-2">
                        <form action="/searchProduct" method="get">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control" placeholder="Tìm tên sách">
                                <span class="input-group-prepend">
                                    <button type="submit" class="btn btn-primary">Search</button>
                                </span>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <form action="/searchCategoryProduct" class="input-group" method="get">
                        <select class="form-control select2_init" name="category_id">
                            <option value="">Chon danh mục</option>
                            {!! $htmlOption !!}
                        </select>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <form action="{{route('product.index')}}" class="input-group" method="get">
                            <label style="margin-top: 7px; margin-right: 7px;" for="">Giá</label>
                            <select class="form-control select2_init" name="sortPrice">
                                <option value="descPrice">Cao đến thấp</option>
                                <option value="escPrice">Thấp đến cao</option>
                            </select>
                            <button class="btn btn-primary" type="submit">Search</button>
                        </form>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-primary" onclick="copyToClipboard('#copy')">Copy</button>
                    </div>
                    <div class="col-md-12">
                        <a href="{{route('product.create')}}" class="btn btn-success float-right m-2">Add</a>
                    </div>
                    <div class="col-md-12" id="copy">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Hình ảnh</th>
                                <th scope="col">Danh mục</th>
                                <th scope="col">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $productItem)
                                <tr>
                                    <th scope="row">{{$productItem->id}}</th>
                                    <td>{{ $productItem->name }}</td>
                                    <td>{{($productItem->price)}}</td>
                                    <td><img class="product_image_150_100" src="{{$productItem->feature_image_path}}" alt=""></td>
                                    <td>{{optional($productItem->category)->name}}</td>
                                    <td>
                                        @can('product-edit',  $productItem->user_id )
                                        <a href="{{route('product.edit',['id' => $productItem->id])}}"
                                           class="btn btn-default">Edit</a>
                                        @endcan
                                        @can('product-delete', $productItem->user_id )
                                        <a href=""
                                           data-url="{{route('product.delete', ['id' => $productItem->id])}}"
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
                        {{$products->appends(request()->query())->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@extends('layouts.admin')

@section('title')
    <title>Trang Sản phẩm</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2a/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/adds/add.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{asset('admins/product/index/list.css')}}">
    <style>
        .muti_img_preview {
            width: 150px;
            height: 100px;
            object-fit: cover;
            margin: 10px;
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Product', 'key' => 'Add'])
        <div class="col-md-12">
{{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
        </div>
        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    value="{{old('name')}}"
                                    placeholder="Nhập tên sản phẩm">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input
                                    class="form-control @error('price') is-invalid @enderror"
                                    name="price"
                                    value="{{old('price')}}"
                                    placeholder="Nhập giá sản phẩm">
                                @error('price')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input
                                    type="file"
                                    id="feature_image_path"
                                    class="form-control-file @error('feature_image_path') is-invalid @enderror"
                                    name="feature_image_path"
                                    placeholder="Nhập tên sản phẩm">
                                <div id="images-to-upload0"></div>
                                @error('feature_image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input
                                    type="file"
                                    multiple
                                    id="image_path"
                                    class="form-control-file @error('image_path') is-invalid @enderror"
                                    name="image_path[]"
                                    placeholder="Nhập tên sản phẩm">
                                <div id="images-to-upload"></div>
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                                    <option value="">Chon danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                                @error('category_id')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">

                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nhập nội dung</label>
                                <textarea name="contents" class="form-control tinymce_editor_init @error('contents') is-invalid @enderror" rows="8">
                                    {{old('contents')}}
                                </textarea>
                                @error('contents')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js')
    <script>
        $('#feature_image_path').on('change',function(e){
            var files = e.target.files;
            console.log(files);
            $.each(files, function (i, file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    var template = '<img class="muti_img_preview" src="' + e.target.result + '" alt="">';
                    $('#images-to-upload0').append(template);
                }
            })
        })

        $('#image_path').on('change',function(e){
            var files = e.target.files;
            console.log(files);
            $.each(files, function (i, file) {
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    var template = '<img class="muti_img_preview" src="' + e.target.result + '" alt="">';
                    $('#images-to-upload').append(template);
                }
            })
        })
    </script>
    <script src="{{ asset('vendors/select2a/select2.min.js')}}"></script>
    <script src="{{ asset('admins/product/adds/add.js')}}"></script>
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
@endsection

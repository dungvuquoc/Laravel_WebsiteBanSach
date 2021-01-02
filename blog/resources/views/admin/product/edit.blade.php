@extends('layouts.admin')

@section('title')
    <title>Add Product</title>
@endsection

@section('css')
    <link href="{{asset('vendors/select2a/select2.min.css')}}" rel="stylesheet"/>
    <link href="{{asset('admins/product/adds/add.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="{{ asset('admins/product/index/list.css')  }}">\
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
        @include('partials.content-header', ['name' => 'Product', 'key' => 'Edit'])
        <form action="{{route('product.update', ['id' => $product->id])}}" method="post" enctype="multipart/form-data">
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            @csrf
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input
                                    class="form-control"
                                    name="name"
                                    placeholder="Nhập tên sản phẩm"
                                    value="{{$product->name}}">

                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input
                                    class="form-control"
                                    name="price"
                                    placeholder="Nhập giá sản phẩm"
                                    value="{{$product->price}}">

                            </div>
                            <div class="form-group">
                                <label>Ảnh đại diện</label>
                                <input
                                    type="file"
                                    class="form-control-file"
                                    name="feature_image_path"
                                    id="feature_image_path"
                                    placeholder="Nhập tên sản phẩm">
                                <div id="images-to-upload0"></div>
                                <hr>
                                <div class="col-md-12">
                                    <div class="row">
                                        <img class="product_image_150_100 feature_image" src="{{$product->feature_image_path}}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Ảnh chi tiết</label>
                                <input
                                    type="file"
                                    multiple
                                    class="form-control-file"
                                    name="image_path[]"
                                    placeholder="Nhập tên sản phẩm">
                                <div id="images-to-upload"></div>
                                <hr>
                                <div class="col-md-12 container_image_detail">
                                    <div class="row">
                                        @foreach($product->images as $productImageItem)
                                        <div class="col-md-3">
                                            <img class="product_image_150_100" src="{{$productImageItem->image_path}}" alt="">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Nhập tags cho sản phẩm</label>
                                <select name="tags[]" class="form-control tags_select_choose" multiple="multiple">
                                    @foreach($product->tags as $tagItem )
                                    <option value="{{$tagItem->name}}" selected>{{$tagItem->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Chọn danh mục</label>
                                <select class="form-control select2_init " name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    {!! $htmlOption !!}
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Nhập nội dung</label>
                                <textarea name="contents" class="form-control tinymce_editor_init" rows="8">{{$product->content}}</textarea>
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
        // const feature_image_path = document.getElementById("feature_image_path");
        // const previewContainer = document.getElementById("imagePreview");
        // const previewImage = previewContainer.querySelector(".image-preview__image");
        // const previewDefaultText = previewContainer.querySelector(".image-preview__default-text");
        //
        // feature_image_path.addEventListener('change', function () {
        //     const file = this.files[0];
        //     if(file) {
        //         const reader = new FileReader();
        //
        //         previewDefaultText.style.display = "none";
        //         previewImage.style.display = "block";
        //
        //         reader.addEventListener("load", function () {
        //             console.log(this);
        //             previewImage.setAttribute("src", this.result);
        //         });
        //
        //         reader.readAsDataURL(file);
        //     }
        // })

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
    <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
    <script src="{{ asset('admins/product/adds/add.js')}}"></script>
@endsection

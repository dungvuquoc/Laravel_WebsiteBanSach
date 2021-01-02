@extends('layouts.admin')

@section('title')
    <title>Trang slider</title>
@endsection

@section('css')
    <link rel="stylesheet" href="{{asset('admins/slider/add/add.css')}}">
@endsection

@section('content')
    <div class="content-wrapper">
        @include('partials.content-header', ['name' => 'Slider', 'key' => 'Edit'])

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('slider.update', ['id'=>$slider->id])}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label>Ten slider</label>
                                <input
                                    class="form-control @error('name') is-invalid @enderror"
                                    name="name"
                                    value="{{ $slider->name }}"
                                    placeholder="Nhập tên slider">
                                @error('name')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Mô tả slider</label>
                                <textarea
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description"
                                    placeholder="Mô tả menu"
                                    rows="4">{{ $slider->description }}</textarea>
                                @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hình ảnh</label>
                                <input
                                    type="file"
                                    class="form-control @error('image_path') is-invalid @enderror"
                                    name="image_path">
                                <div class="col-md-4">
                                    <div class="row">
                                        <img style="width: 150px;height: 100px;margin-top: 10px;object-fit: cover;" class="image_slider" src="{{ $slider->image_path }}" alt="">
                                    </div>
                                </div>
                                @error('image_path')
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


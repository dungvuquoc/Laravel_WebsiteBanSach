@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Forbidden'))
{{--<h2>Bạn không có quyền truy cập</h2>--}}

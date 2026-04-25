@extends('admin::core.master')

@section('title', __('New news'))

@section('content')
    {!! BootForm::open()->action(route('admin::index-news'))->addClass('form') !!}
    @include('admin::news._form')
    {!! BootForm::close() !!}
@endsection

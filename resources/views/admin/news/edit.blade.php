@extends('admin::core.master')

@section('title', $model->presentTitle())

@section('content')
    {!! BootForm::open()->put()->action(route('admin::update-news', $model->id))->addClass('form') !!}
    {!! BootForm::bind($model) !!}
    @include('admin::news._form')
    {!! BootForm::close() !!}
@endsection

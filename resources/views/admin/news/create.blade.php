<x-core::layouts.admin :title="__('New news')">
    {!! BootForm::open()->action(route('admin::index-news'))->addClass('form') !!}
    @include('admin::news._form')
    {!! BootForm::close() !!}
</x-core::layouts.admin>

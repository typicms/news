<x-core::layouts.admin :title="$model->presentTitle()" :model="$model">
    {!! BootForm::open()->put()->action(route('admin::update-news', $model->id))->addClass('form') !!} {!! BootForm::bind($model) !!}
    @include('admin::news._form')
    {!! BootForm::close() !!}
</x-core::layouts.admin>

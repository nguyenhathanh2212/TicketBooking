@extends('admin.template.master')

@section('header')
<h1>
    @lang('main.manage_company')
    <small>@lang('main.detail')</small>
</h1>
@endsection

@section('main_content')
<div class="box box-default">
    <div class="box-header with-border">
        <h3 class="box-title">@lang('user.user_information')</h3>
        <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        </div>
    </div>
    <!-- /.box-header -->
    @include('admin.template.notice')
    <div class="box-body">
        {{ Form::open(['class' => 'form-user',
            'url' => route('user.update', $user->id),
            'method' => 'PUT',
            'enctype'=>'multipart/form-data',
            'data-message' => trans('message.confirm_update_user')]) }}
            @include('admin.user.form')
        {{ Form::close() }}
        <!-- /.row -->
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            var form = $('.form-user');

            $(document).on('click', '.btn-user', function () {
                swal({
                    title: 'Are you sure?',
                    text: form.data('message'),
                    icon: 'info',
                    buttons: true,
                    dangerMode: true,
                }).then((ok) => {
                    if (ok) {
                        form.submit();
                    }
                });
            })
        }) 
    </script>
@endpush

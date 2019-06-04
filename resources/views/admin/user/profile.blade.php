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
        {{ Form::open(['class' => 'form-profile',
            'url' => route('admin.update_profile'),
            'method' => 'PUT',
            'enctype'=>'multipart/form-data',
            'data-message' => trans('message.confirm_update_user')]) }}
            <div class="row">
                <div class="box-body">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="first_name">@lang('user.first_name')</label>
                            {{ Form::text('first_name', $user->first_name ?? '', [
                                'class' => 'form-control',
                                'placeholder' => trans('user.first_name'),
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="last_name">@lang('user.last_name')</label>
                            {{ Form::text('last_name', $user->last_name ?? '', [
                                'class' => 'form-control',
                                'placeholder' => trans('user.last_name'),
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('user.email')</label>
                            {{ Form::text('email', $user->email ?? '', [
                                'class' => 'form-control',
                                'placeholder' => trans('user.email'),
                                'disabled' => isset($user)
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="password">@lang('user.password')</label>
                            {{ Form::text('password', '', [
                                'class' => 'form-control',
                                'placeholder' => trans('user.password'),
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">@lang('user.confirm_password')</label>
                            {{ Form::text('confirm_password', $user->confirm_password, [
                                'class' => 'form-control',
                                'placeholder' => trans('user.confirm_password'),
                            ]) }}
                        </div>
                    </div>
                    @if (isset($user))
                        <div class="col-md-4 text-center">
                            <img class="avatar-user-detail" src="{{ $user->avatar }}" alt="">
                            <div>
                                <br>
                                <a class="btn btn-primary btn-change-avatar"
                                    href="#">Change Avatar</a>
                                <input class="file-image-input" style="display: none"
                                    type="file" name="avatar"
                                    accept="image/x-png,image/gif,image/jpeg" />
                            </div>
                        </div>
                    @endif
                </div>
                <div class="clearfix"></div>
                <div class="box-body">
                    <div class="box-footer">
                        <button type="button" class="btn btn-primary btn-sm btn-profile">Submit</button>
                    </div>
                </div>
            </div>
        {{ Form::close() }}
        <!-- /.row -->
    </div>
</div>
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            if ($('.btn-change-avatar'.length)) {
                $(document).on('click', '.btn-change-avatar', function(e) {
                    e.preventDefault();
                    $('.file-image-input').click();
                })

                $(document).on('change', '.file-image-input', function(e) {
                    $('.avatar-user-detail').attr('src', window.URL.createObjectURL(e.target.files[0]));
                })
            }

            var form = $('.form-profile');

            $(document).on('click', '.btn-profile', function () {
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

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
    <div class="box-body">
        <div class="row">
            <div class="col-md-8">
                <form role="form">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="first_name">@lang('user.first_name')</label>
                            {{ Form::text('first_name', $user->first_name, [
                                'class' => 'form-control',
                                'placeholder' => trans('user.first_name'),
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="last_name">@lang('user.last_name')</label>
                            {{ Form::text('last_name', $user->last_name, [
                                'class' => 'form-control',
                                'placeholder' => trans('user.last_name'),
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('user.email')</label>
                            {{ Form::text('email', $user->email, [
                                'class' => 'form-control',
                                'placeholder' => trans('user.email'),
                                'disabled' => true
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="email">@lang('user.role')</label>
                            {{ Form::select('role', $listRoles, $user->role,[
                                'class' => 'form-control',
                                'disabled' => true
                            ]) }}
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            <div class="col-md-4">
                <img class="avatar-user-detail" src="{{ $user->avatar }}" alt="">
            </div>
        </div>
        <!-- /.row -->
    </div>
</div>
@endsection

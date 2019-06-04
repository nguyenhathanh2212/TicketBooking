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
                <label for="email">@lang('user.role')</label>
                {{ Form::select('role', $listRoles, $user->role ?? '',[
                    'class' => 'form-control',
                ]) }}
            </div>
            <div class="form-group">
                <label for="email">@lang('main.status')</label>
                {{ Form::select('status', $statuses, $user->status ?? '',[
                    'class' => 'form-control',
                ]) }}
            </div>
        </div>
        @if (isset($user))
            <div class="col-md-4">
                <img class="avatar-user-detail" src="{{ $user->avatar }}" alt="">
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
    <div class="box-body">
        <div class="box-footer">
            <button type="button" class="btn btn-primary btn-sm btn-user">Submit</button>
        </div>
    </div>
</div>

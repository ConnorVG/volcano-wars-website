@extends('_layouts.boxed')


@section('content')
<form id="update" action="{{ route('post::personal.account') }}" method="POST">
    {!! csrf_field() !!}
</form>

<aside class="form form--auth">
    <div class="form__content">
        <div class="form-group @if ($errors->has('name')) has-danger @endif">
            <label for="name">Name</label>
            <input form="update" type="text" class="form-control" id="name" name="name" placeholder="{{ $user->name }}" value="{{ old('name', $user->name) }}">

        @if ($errors->has('name'))
            <small class="form-text form-control-feedback">{{ $errors->first('name') }}</small>
        @endif
        </div>

        <div class="form-group @if ($errors->has('email')) has-danger @endif">
            <label for="email">Email address</label>
            <input form="update" type="email" class="form-control" id="email" name="email" placeholder="{{ $user->email }}" value="{{ old('email', $user->email) }}">

        @if ($errors->has('email'))
            <small class="form-text form-control-feedback">{{ $errors->first('email') }}</small>
        @endif
        </div>

        <div class="form__actions">
            <button form="update" type="submit" class="btn btn-sm btn-outline-primary">Update</button>
            <a href="{{ route('get::personal.account.password') }}" class="btn btn-sm btn-outline-info">Change password</a>
        </div>
    </div>
</aside>
@endsection

@extends('_layouts.boxed')


@section('content')
<form id="authorisation" action="{{ route('post::auth.sign-in') }}" method="POST">
    {!! csrf_field() !!}
</form>

<aside class="form form--auth">
    <div class="form__content">
        <div class="form-group @if ($errors->has('email')) has-danger @endif">
            <label for="email">Email address</label>
            <input form="authorisation" type="email" class="form-control" id="email" name="email" placeholder="j.doe&commat;example.org" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <small class="form-text form-control-feedback">{{ $errors->first('email') }}</small>
        @endif
        </div>

        <div class="form-group @if ($errors->has('password')) has-danger @endif">
            <label for="password">Password</label>
            <input form="authorisation" type="password" class="form-control" id="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

        @if ($errors->has('password'))
            <small class="form-text form-control-feedback">{{ $errors->first('password') }}</small>
        @endif
        </div>

        <div class="form__actions">
            <button form="authorisation" type="submit" class="btn btn-sm btn-outline-primary">Sign in</button>
            <a href="{{ route('get::auth.sign-up') }}" class="btn btn-sm btn-outline-info">Sign up</a>
            <a href="{{ route('get::auth.forgot') }}" class="btn btn-sm btn-outline-info">Forgotten password</a>
        </div>
    </div>
</aside>
@endsection

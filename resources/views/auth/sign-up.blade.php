@extends('_layouts.boxed')


@section('content')
<form id="registration" action="{{ route('post::auth.sign-up') }}" method="POST">
    {!! csrf_field() !!}
</form>

<aside class="form form--auth">
    <div class="form__content">
        <div class="form-group @if ($errors->has('name')) has-danger @endif">
            <label for="name">Name</label>
            <input form="registration" type="text" class="form-control" id="name" name="name" placeholder="Jane Doe" value="{{ old('name') }}">

        @if ($errors->has('name'))
            <small class="form-text form-control-feedback">{{ $errors->first('name') }}</small>
        @endif
        </div>

        <div class="form-group @if ($errors->has('email')) has-danger @endif">
            <label for="email">Email address</label>
            <input form="registration" type="email" class="form-control" id="email" name="email" placeholder="j.doe&commat;example.org" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <small class="form-text form-control-feedback">{{ $errors->first('email') }}</small>
        @endif
        </div>

        <div class="form-group @if ($errors->has('password')) has-danger @endif">
            <label for="password">Password</label>
            <input form="registration" type="password" class="form-control" id="password" name="password" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

        @if ($errors->has('password'))
            <small class="form-text form-control-feedback">{{ $errors->first('password') }}</small>
        @endif
        </div>

        <div class="form__actions">
            <button form="registration" type="submit" class="btn btn-sm btn-outline-primary">Sign up</button>
            <a href="{{ route('get::auth.sign-in') }}" class="btn btn-sm btn-outline-info">Already got an account?</a>
        </div>
    </div>
</aside>
@endsection

@extends('_layouts.boxed')


@section('content')
<form id="remind" action="{{ route('post::auth.forgot') }}" method="POST">
    {!! csrf_field() !!}
</form>

<aside class="form form--auth">
    <div class="form__content">
        <div class="form-group @if ($errors->has('email')) has-danger @endif">
            <label for="email">Email address</label>
            <input form="remind" type="email" class="form-control" id="email" name="email" placeholder="j.doe&commat;example.org" value="{{ old('email') }}">

        @if ($errors->has('email'))
            <small class="form-text form-control-feedback">{{ $errors->first('email') }}</small>
        @endif
        </div>

        <div class="form__actions">
            <button form="remind" type="submit" class="btn btn-sm btn-outline-primary">Reset</button>
            <a href="{{ route('get::auth.sign-in') }}" class="btn btn-sm btn-outline-info">I remember!</a>
        </div>
    </div>
</aside>
@endsection

@extends('_layouts.boxed')


@section('content')
<form id="update" action="{{ route('post::personal.account.password') }}" method="POST">
    {!! csrf_field() !!}
</form>

<aside class="form form--auth">
    <div class="form__content">
        <div class="form-group @if ($errors->has('current')) has-danger @endif">
            <label for="current">Current</label>
            <input form="update" type="password" class="form-control" id="current" name="current" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

        @if ($errors->has('current'))
            <small class="form-text form-control-feedback">{{ $errors->first('current') }}</small>
        @endif
        </div>

        <div class="form-group @if ($errors->has('new')) has-danger @endif">
            <label for="new">New</label>
            <input form="update" type="password" class="form-control" id="new" name="new" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">

        @if ($errors->has('new'))
            <small class="form-text form-control-feedback">{{ $errors->first('new') }}</small>
        @endif
        </div>

        <div class="form__actions">
            <button form="update" type="submit" class="btn btn-sm btn-outline-primary">Update</button>
        </div>
    </div>
</aside>
@endsection

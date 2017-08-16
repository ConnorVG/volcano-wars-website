@extends('_layouts.boxed')


@section('content')
<form id="accept" method="POST" action="/oauth/authorize">
    {{ csrf_field() }}

    <input type="hidden" name="state" value="{{ $request->state }}">
    <input type="hidden" name="client_id" value="{{ $client->id }}">
</form>

<form id="reject" method="POST" action="/oauth/authorize">
    {{ csrf_field() }}
    {{ method_field('DELETE') }}

    <input type="hidden" name="state" value="{{ $request->state }}">
    <input type="hidden" name="client_id" value="{{ $client->id }}">
</form>

<section class="section section--centered section--sticky-bottom">
    <h1 class="section__title">{{ $client->name }}</h1>

    <p class="section__lead">is requesting permission @if (empty($scopes)) to access your account @else to: @endif</p>
</section>

<aside class="form form--oauth-authorise section--stuck-top">
    <div class="form__content">
        <!-- Scope List -->
        @if (count($scopes) > 0)
            <div class="scopes">
                <ul class="scopes__list">
                @foreach ($scopes as $scope)
                    <li class="scopes__item">{{ $scope->description }}</li>
                @endforeach
                </ul>
            </div>
        @endif

        <div class="form__actions btn-toolbar justify-content-between">
            <button form="accept" type="submit" class="btn btn-outline-success">Authorise</button>
            <button form="reject" type="submit" class="btn btn-outline-danger">Cancel</a>
        </div>
    </div>
</aside>
@endsection

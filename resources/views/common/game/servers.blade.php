@extends('_layouts.boxed')


@section('content')
<section class="section section--centered section--sticky-bottom">
    <h1 class="section__title">Servers</h1>

    <p class="section__lead">Hover for more information</p>
</section>

<aside class="servers section--stuck-top">
    <div class="servers__content">
        <ul class="server__list">
        @for ($a = 0; $a < 5; $a++)
            <li class="server__item">
                <div class="server__content">{{--
                     --}}<h1 class="server__name">My Server</h1>{{--
                     --}}<h1 class="server__state">Lobby</h1>{{--
                     --}}<span class="server__ping">123ms</h1>{{--
                 --}}</div>

                <ul class="player__list">
                @for ($i = 0; $i < 3; $i++)
                    <li class="player__item">{{--
                         --}}<h2 class="player__name"><a href="#">Connor S. Parks</a></h2>{{--
                         --}}<span class="player__score">1,337</span>{{--
                         --}}<span class="player__ping">69ms</span>{{--
                     --}}</li>
                @endfor
                </ul>

                <div class="server__meta">
                    <a href="#" class="server__connect">Connect</a>
                </div>
            </li>
        @endfor
        </ul>
    </div>
</aside>
@endsection

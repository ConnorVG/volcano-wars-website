@extends('_layouts.master')


@section('body')
<main class="main main--boxed">
	<div class="main__content">
		<header class="header">
            <div class="header__logo">
                <a href="{{ route('get::common.home') }}" class="logo__link">{{ $application->name }}</a>
            </div>

			<ul class="header__navigation">
                <li class="navigation__item">
                    <div href="#" class="navigation__dropdown @if ($route->is('common.game.*')) active @endif">
                        Game

                        <ul class="dropdown">
                            <li class="dropdown__item"><a href="{{ route('get::common.game.servers') }}" class="dropdown__link @if ($route->is('common.game.servers')) active @endif">Servers</a></li>
                            <li class="dropdown__item"><a href="{{ route('get::common.game.features') }}" class="dropdown__link @if ($route->is('common.game.features')) active @endif">Features</a></li>
                            <li class="dropdown__item"><a href="{{ route('get::common.game.download') }}" class="dropdown__link @if ($route->is('common.game.download')) active @endif">Download</a></li>
                            <li class="dropdown__item"><a href="{{ route('get::common.game.screenshots') }}" class="dropdown__link @if ($route->is('common.game.screenshots')) active @endif">Screenshots</a></li>
                            <li class="dropdown__item"><a href="{{ route('get::common.game.statistics') }}" class="dropdown__link @if ($route->is('common.game.statistics')) active @endif">Statistics</a></li>
                        </ul>
                    </div>
                </li>
            @auth
				<li class="navigation__item">
                    <div href="#" class="navigation__dropdown @if ($route->is('personal.*')) active @endif">
                        {{ $user->name }}

                        <ul class="dropdown">
                            <li class="dropdown__item"><a href="{{ route('get::personal.account') }}" class="dropdown__link @if ($route->is('personal.account', 'personal.account.*')) active @endif">Account</a></li>
                            <li class="dropdown__item"><a href="{{ route('get::auth.sign-out') }}" class="dropdown__link">Sign out</a></li>
                        </ul>
                    </div>
                </li>
            @else
                <li class="navigation__item">
                    <a href="{{ route('get::auth.sign-in') }}" class="navigation__link @if ($route->is('auth.sign-in')) active @endif">Sign in</a>
                </li>
            @endif
			</ul>
		</header>

    @include('_partials.flash', ['style' => 'boxed'])

	@yield('content')

		<footer class="footer">
			<p class="footer__copy">{!! $application->copyright !!}</p>
		</footer>
	</div>
</main>
@endsection

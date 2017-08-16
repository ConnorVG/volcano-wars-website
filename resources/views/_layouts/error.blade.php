@extends('_layouts.master')


@section('body')
<main class="main main--error">
	<div class="main__content">
		<header class="header">
            <div class="header__logo">
                <a href="{{ route('get::common.home') }}" class="logo__link">{{ $application->name }}</a>
            </div>
		</header>

	@yield('content')

		<footer class="footer">
			<p class="footer__copy">{!! $application->copyright !!}</p>
		</footer>
	</div>
</main>
@endsection

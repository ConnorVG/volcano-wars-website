@extends('_layouts.boxed')


@section('content')
<section class="section section--centered section--sticky-bottom">
    <h1 class="section__title">Download</h1>

    <p class="section__lead">Choose your platform</p>
</section>

<aside class="downloads section--stuck-top">
    <ul class="download__list">
        <li class="download__item">
            <a href="#" class="download__link">
                <div class="download__icon-container">
                    <img class="download__icon" src="/assets/static/targets/windows.svg" alt="Windows 10">
                </div>

                <span class="download__size">13.37KiB</span>
            </a>
        </li>

        <li class="download__item">
            <a href="#" class="download__link">
                <div class="download__icon-container">
                    <img class="download__icon" src="/assets/static/targets/linux.svg" alt="Linux">
                </div>

                <span class="download__size">13.37KiB</span>
            </a>
        </li>

        <li class="download__item">
            <a href="#" class="download__link">
                <div class="download__icon-container">
                    <img class="download__icon" src="/assets/static/targets/osx.svg" alt="OS X">
                </div>

                <span class="download__size">13.37KiB</span>
            </a>
        </li>
    </ul>
</aside>
@endsection

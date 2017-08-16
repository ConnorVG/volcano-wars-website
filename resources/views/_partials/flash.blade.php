@if (! empty($flash))
<aside class="flash">
    <div class="flash__content">
        <ul class="flash__messages">
        @foreach ($flash as $entry)
            <li class="flash__item flash__item--{{ $entry['class'] }}">
                <p class="flash__message">{!! $entry['message'] !!}</p>
            </li>
        @endforeach
        </ul>
    </div>
</aside>
@endif

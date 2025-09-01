@props([
    'size' => 40, // default 40px
    'link' => '#', // default #
    'alt' => 'Logo', // alt default
    'src' => 'assets/images/logo-rar.png', // default logo
])

<a href="{{ $link }}" class="fs-3">
    <img class="img-fluid" style="width: {{ $size }}px; height: auto;" src="{{ asset($src) }}"
        alt="{{ $alt }}">
</a>

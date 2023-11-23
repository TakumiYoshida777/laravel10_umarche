<div>
    {{-- 試し：{{ $filename }} --}}
    @if (empty($filename))

    <img class="common-w-32" src="{{ asset('images/no_image.jpg') }}" alt="">
    @else

    <img class="common-w-32" src="{{ asset('storage/shops/'. $filename) }}" alt="">
    @endif
</div>

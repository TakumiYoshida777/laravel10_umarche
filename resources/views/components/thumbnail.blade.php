<?php
if ($type === 'shops') {
    $path = 'storage/shops/';
} 
elseif ($type === 'products') {
    $path = 'storage/products/';
}
?>

<div>
    @if (empty($filename))
    <img class="common-w-32" src="{{ asset('images/no_image.jpg') }}" alt="">

    @else
    <img class="common-w-32" src="{{ asset($path. $filename) }}" alt="">

    @endif
</div>

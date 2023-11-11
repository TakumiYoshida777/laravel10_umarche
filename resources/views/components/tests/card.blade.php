@props([
'title' => 'タイトルです。',
'message' =>'初期値です。',
'content' => '本文初期値です。']
);

<div {{ $attributes->merge([
    'class' => 'border-w shadow-md w-1/4'
    ]) }}>
    <div>{{ $title }}</div>
    <div>画像</div>
    <div>{{ $content }}</div>
    <div>{{ $message }}</div>
</div>
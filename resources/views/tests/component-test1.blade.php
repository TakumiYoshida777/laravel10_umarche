<x-tests.app>
    <x-slot name="header">
        ヘッダー１
    </x-slot>
    <div>コンポーネントテスト1</div>

    <x-tests.card title="タイトル1" content="本文" :message="$message"></x-tests.card>
    <x-tests.card title="タイトル2"></x-tests.card>
    <x-tests.card title="CSSを変更したい" class="bg-red-300"></x-tests.card>

</x-tests.app>
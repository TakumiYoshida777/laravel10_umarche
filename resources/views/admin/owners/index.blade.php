<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div>
                        <h3>エロクアント</h3>
                        <ul>
                            @foreach ($e_all as $e_owner)
                            <li>
                                {{ $e_owner->name }}<br>
                                {{ $e_owner->created_at->diffForHumans();
                                }}
                            </li>

                            @endforeach
                        </ul>
                    </div>
                    <div>
                        <h3>クエリビルダ</h3>
                        <ul>
                            @foreach ($q_get as $q_owner)
                            <li>
                                {{ $q_owner->name }}<br>
                                {{ Carbon\Carbon::parse($q_owner->created_at)->diffForHumans() }}
                            </li>
                            @endforeach
                        </ul>


                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
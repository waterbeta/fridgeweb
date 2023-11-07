<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('已解決的回報列表') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8 space-y-6">
            <div style="float:right;"><a href="{{ route('showcomment') }}">查看未解決的歷史問題</a></div>
        </div>
    </div>

    @foreach($data as $item)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="max-w-xl">
                        <h2 class="font-semibold text-xl text-gray-700 leading-tight">{{ $item['fridge']['name'] }}</h2>
                        <p class="mt-1 text-sm text-gray-600">{{ $item['fridge']['city'].$item['fridge']['dist'].$item['fridge']['address'] }}</p><br>
                        @forelse($item['comments'] as $comment)
                            <li>
                                {{ $comment['content'] }}
                                <p class="mt-1 text-sm text-gray-400">&ensp;&ensp;解決時間：{{ $comment['updated_at'] }}</p>
                            </li>
                        @empty
                            <p>目前此冰箱無已解決的回報內容</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>

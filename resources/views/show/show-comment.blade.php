<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('未解決的回報列表') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="sm:px-6 lg:px-8 space-y-6">
            <div style="float:right;"><a href="{{ route('solvedcomment') }}">查看已解決的歷史回報</a></div>
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
                                <div style=" float:right;"><a href="{{ route('solved', ['id' => $comment['id']]) }}">問題解決</a></div>
                                <p class="mt-1 text-sm text-gray-400">&ensp;&ensp;回報時間：{{ $comment['created_at'] }}</p>
                            </li>
                        @empty
                            <p>目前此冰箱無回報內容</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</x-app-layout>

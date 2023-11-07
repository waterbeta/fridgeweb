<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('儀表板') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("成功登入!") }}
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 style="font-size:25px;"><strong>已過期食物</strong></h2>
                    <div id="current_date" class="mt-1 text-sm text-gray-400">
                        <script>
                            date = new Date();
                            year = date.getFullYear(); month = date.getMonth() + 1; day = date.getDate();
                            hour = date.getHours(); minute = date.getMinutes();
                            document.getElementById("current_date").innerHTML = "現在時間：" + year + "-" + month + "-" + day + " " + hour + ":" + minute;
                        </script>
                    </div>
                    <iframe src="{{ route('expiredproduct') }}" style="border:0;" width="100%" height="250px"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ url('/add') }}" >新增冰箱</a>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ url('/show') }}" >顯示冰箱</a>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{ route('showcomment') }}" >使用者回報系統</a>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

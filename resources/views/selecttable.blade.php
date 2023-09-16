@extends('layouts.empty')

@section('content')
    <script>
        function send_address(city, dist, address) {
            map_address = city + dist + address;
            parent.postMessage(map_address);
        }
    </script>

    <table>
        <th>冰箱名稱</th><th>地點</th>
        @forelse($fridges as $fridge)
            <tr>
                <td>
                    <a href="{{ route('fridgedetail', ['id' => $fridge['id']]) }}" target="_parent">{{ $fridge['name'] }}</a>
                </td>
                <td>{{ $fridge['city'] }}{{ $fridge['dist'] }}{{ $fridge['address'] }}</td>
                <td>
                    <button onclick="send_address('{{ $fridge['city'] }}', '{{ $fridge['dist'] }}', '{{ $fridge['address'] }}')">地圖</button>
                </td>
            </tr>
        @empty
            <tr><td colspan="2">目前此地區還沒有冰箱</td></tr>
        @endforelse
    </table>
@endsection
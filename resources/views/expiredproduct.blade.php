@extends('layouts.empty')

@section('content')
    <table cellpadding="5">
    <th>冰箱名稱</th><th>食物名稱</th><th>放入時間</th><th>過期時間</th>
    @foreach($data as $item)
        <tr>
        @foreach($item['fridge'] as $fridge)
            <td  align="center"> {{ $fridge['name'] }} </td>
            <td  align="center"> {{ $item['expire']['name'] }} </td>
            <td  align="center"> {{ $item['expire']['put_time'] }} </td>
            <td  align="center"> {{ $item['expire']['alarm_time'] }} </td>
            <td  align="center"><img src="{{ asset('photos/'.$item['expire']['photo_name']) }}" width="40%" height="40%"></td>
            <td  align="center"><a href="/show/content/{{ $fridge['id'] }}" target="_parent">前往</a></td>
        @endforeach
        </tr>
    @endforeach
    </table>
@endsection
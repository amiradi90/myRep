{{--@extends('user.all')--}}
{{--@section('tbody')--}}
    {{--@foreach($users as $user)--}}
        {{--<tr id="result">--}}
            {{--<td>{{$user->id}}</td>--}}
            {{--<td>{{ $user->name }}</td>--}}
            {{--<td>{{ $user->email }}</td>--}}
        {{--</tr>--}}
    {{--@endforeach--}}
{{--@endsection--}}

<tbody id="tbody">
@foreach($users as $user)
    <tr id="result">
        <td>{{$user->id}}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
    </tr>
@endforeach
</tbody>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>کنترل حواله شعب</title>
</head>
<style>
    body {
        background-color: whitesmoke;
        padding: 0;
        font-size: larger;
        width: 90%;
        margin: 0 auto;
        text-align: center;
        font-size: 25px;
        font-family: sg;
    }

    @font-face {
        font-family: exo;
        src: url({{url('/font/exo.woff2')}});

        font-family: sg;
        src: url({{url('/font/iranSans/woff/iransansweb.woff')}});

    }

    #tbl1 td {
        width: 170px;
        height: 170px;
        border-radius: 3px;

    }

    #tbl1 td:hover {
        /*border: 1px solid black;*/
        /*box-shadow: 1px 1px 1px 1px black;*/

    }

    #tbl1 td a {
        list-style-type: none;
        text-decoration: none !important;
        color: black;
    }

    #tbl1 td a:hover {
        color: #f7f7f7;
        font-weight: bold;
    }
</style>
<body>
<div class="" style="font-size:0.7em;padding: 0;margin: 0;position: relative">
    @guest
        <a class=" " href="{{ route('login') }}">{{ __('ورود') }}</a>
        {{--</li>--}}
    @else
        <a id="" class=" " href="#">
            {{ Auth::user()->name }} <span class="caret"></span>
        </a>
        <div style="width: 30%;margin:0 auto;border-bottom: 1px solid black"></div>
        <a class="log-out" href="{{ route('logout') }}"
           onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            {{ __('خروج') }}
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    @endguest
</div>
@if(auth()->check())
    {{--<h6 style="position: relative;color: red">User :{{\Illuminate\Support\Facades\Auth::user()->email}}</h6>--}}
    {{--<div class="">--}}
    {{--<a class="" href="{{route('logout')}}"--}}
    {{--onclick="event.preventDefault();--}}
    {{--document.getElementById('form1').submit();">--}}
    {{--{{ __('Logout') }}--}}
    {{--</a>--}}
    {{--</div>--}}

    <form method="post" id="form1" action="{{route('logout')}}">
        @csrf
    </form>
@endif
<div style=";margin: 2em;padding: 0;margin: 0;">برنامه بررسی حواله های فروشگاه های کتاب بهمن</div>
<div style="display: inline-block">
    <div id="branchesTable" class="" style="margin: 0 auto;">
        <table id="tbl1" class="table-borderless  table-responsive" style="">
            <tr class="">
                <td class="" style="background-color: #b8dbdc">
                    <span>
                    <a href="/draft2/1">
                        شعبه طالقانی
                        </a>
                    </span>
                </td>
                <td class="" style="background-color: #99beca">
                    <a href="/draft2/2">
                    <span>
                    شعبه گوهردشت
                    </span>
                    </a>
                </td>
            </tr>
            <tr class="">
                <td class="" style="background-color:#85bbca">
                    <a href="/draft2/3">
                        <span>شعبه درختی
                        </span>
                    </a>
                </td>
                <td class="" style="background-color:rgb(118,180,202)">
                    <a href="/draft2/4"><span>شعبه شهریار</span></a>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
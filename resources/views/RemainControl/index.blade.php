<!doctype html>
<html lang="en" dir="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ایندکس کنترل موجودی</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
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
<div style=";margin: 2em;padding: 0;margin: 0;">برنامه کنترل موجودی روزانه فروشگاه های کتاب بهمن</div>
<div style="display: inline-block">
    <div id="branchesTable" class="" style="margin: 0 auto;">
        <table id="tbl1" class="table-borderless  table-responsive" style="">
            <tr class="">
                <td class="" style="background-color: #dc2b1b">
                    <span>
                    <a href="/pick/1">
                        شعبه طالقانی
                        </a>
                    </span>
                </td>
                <td class="" style="background-color: #0aca22">
                    <a href="/pick/2">
                    <span>
                    شعبه گوهردشت
                    </span>
                    </a>
                </td>
            </tr>
            <tr class="">
                <td class="" style="background-color:#1a91e6">
                    <a href="/pick/3">
                        <span>شعبه درختی
                        </span>
                    </a>
                </td>
                <td class="" style="background-color:rgba(255, 255, 0, 1)">
                    <a href="/pick/4"><span>شعبه شهریار</span></a>
                </td>
            </tr>
            </tbody>
        </table>
        @role('admin')
        <div style="margin-top: 50px;">
            <a href="/pick/summary" style="text-decoration: none"> گزارش کنترل موجودی شعب</a>
            <hr>
            <a href="/pick/conflict" style="text-decoration: none"> گزارش مغایرت</a>
        </div>
        @endrole
        <hr>
        <ol>
            <li><a href="/draft" style="text-decoration: none"> کنترل حواله شعب</a></li>
            <hr>
            <li><a href="/placement" style="text-decoration: none">جانمایی کالا</a></li>
            <hr>

            <li><a href="/price" style="text-decoration: none">تغییر قیمت روز</a></li>
            <hr>

            <li><a href="/barcode" style="text-decoration: none">پرینت از بارکد</a></li>
            <hr>

            <li><a href="/amm3/jostojoo" style="text-decoration: none">جست و جو کد-عنوان-ناشر</a></li>
            <hr>

            <li><a href="/amm3" style="text-decoration: none">انبارگردانی </a></li>
            <hr>

        </ol>

    </div>
</div>
</body>
</html>
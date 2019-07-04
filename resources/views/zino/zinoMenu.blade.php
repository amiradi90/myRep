<!doctype html>
<html lang="en" dir="" lang="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Zino Menu</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
</head>
<style>
    body {
        /*float: right;*/
        margin: 5px;
    }
     a:hover{
         color:black !important;
         background-color: lightgray !important;
     }
</style>
<body>
<div id="container">
    {{--<h2 style="position: fixed;right:0px;top: 20px;transform: rotate(270deg)"> دریافت قیمت از زینو</h2>--}}
    <div>
        <a class="btn btn-primary" href="{{route('zinoXml',1001)}}" role="button">هنری->مقوای A4 </a>
        <a class="btn btn-primary" href="{{route('zinoXml',1002)}}">هنری->مقوای A3 </a>
        <a class="btn btn-primary" href="{{route('zinoXml',1003)}}">هنری->مقوای 50*70 </a>
        <a class="btn btn-primary" href="{{route('zinoXml',1004)}}">هنری->مقوای 100*70 </a>
        <a class="btn btn-primary" href="{{route('zinoXml',1005)}}">هنری->مقوای سایر </a>
    </div>
    <hr>
    <div style="">
        <a class="btn btn-primary" href="{{route('zinoXml',1010)}}">کادویی->خودنویس نفیس </a>
        <a class="btn btn-primary" href="{{route('zinoXml',1011)}}">کادویی->روان نویس نفیس</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1012)}}">کادویی->خودکار نفیس</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1013)}}">کادویی->جفتی نفیس </a>
        <a class="btn btn-primary" href="{{route('zinoXml',1014)}}">کادویی->سه تایی نفیس</a>
    </div>
    <hr>
    <div>
        <a class="btn btn-primary" href="{{route('zinoXml',1020)}}">اداری->سررسید وزیری</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1021)}}">اداری->سررسید رقعی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1022)}}">اداری->سررسید پالتویی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1023)}}">اداری->سررسید اروپایی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1024)}}">اداری->تقویم رومیزی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1025)}}">اداری->تقویم جیبی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1026)}}">اداری->ست مدیریتی</a>
    </div>
    <hr>
    <div>
        <a class="btn btn-primary" href="{{route('zinoXml',1104)}}">تحریر->تراش</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1105)}}">تحریر->پاک کن</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1106)}}">تحریر->مدادمکانیکی +مغزمدادمکانیکی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1107)}}">تحریر->لاک غلط گیر</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1108)}}">تحریر->ماژیک وایت برد</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1109)}}">تحریر->معمولی</a>
    </div>
    <hr>
    <div id="کمک آموزشی">
        <a class="btn btn-primary" href="{{route('zinoXml',1115)}}">کمک آموزشی->خلاقیت +سرگرمی +آموزشی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1123)}}">کمک آموزشی->خلاقیت +سرگرمی +آموزشی</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1124)}}">کمک آموزشی->خلاقیت +سرگرمی +آموزشی</a>
    </div>
    <hr>
    <div id="مهندسی">
        <a class="btn btn-primary" href="{{route('zinoXml',1127)}}">مهندسی->تراش</a>
        <a class="btn btn-primary" href="{{route('zinoXml',1129)}}">مهندسی->ماشین حساب مهندسی</a>
    </div>
</div>
</body>
</html>
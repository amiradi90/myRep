<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=.75, maximum-scale=5.0, minimum-scale=.75, user-scalable=yes"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>انتشارات</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>

    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css"--}}
    {{--integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">--}}
    {{--<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js"--}}
    {{--integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n"--}}
    {{--crossorigin="anonymous"></script>--}}
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"--}}
    {{--integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb"--}}
    {{--crossorigin="anonymous"></script>--}}
    {{--<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"--}}
    {{--integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn"--}}
    {{--crossorigin="anonymous"></script>--}}
</head>
<style>
    @font-face {
        font-family: myfont;
        {{--                        src: {{asset(url('font/iranSans/IRANSans.ttf'))}};--}}
                                     src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'myfont', Milo, Tahoma;
        font-size: 0.8em;
        color: #0b3750;
        width: 60%;
        margin: 0 auto;
        text-align: right;
    }

    @media only screen and (max-width: 900px) {
        body {
            width: 100%;
            font-size: 2vw !important;
        }

        #column2 {
            margin: 3% -2% !important;
        }

        .row {
            margin: -2%;
            padding: -2%;
        }

        #pBuy {
            font-size: 1.5em;
        }
    }


</style>
<body>
<div class="contents">
    <div class="container" id="divCenter" style=";">
        @foreach($result as $r)
            <div id="column1" class="row" style="padding:0;margin: 2% auto;
            border-radius: 3px;box-shadow: 0 1px 30px -10px #bbbbbb">
                <strong style=";font-size: 1.3em ;width: 100%;margin-right: 16.5%;margin-bottom: -2%;">{{$r->name}}</strong>
                <div class="col-2" style="margin:0;padding:0.8%;">
                    <div class="product-image" style=";margin-top:1% ;vertical-align: middle">
                        <a href="http://www.bahook.com/product/{{$r->id}}" target="_blank;">
                            <img class="img-responsive"
                                 src="http://www.bahook.com/image/pic/new/{{$r->image}}/1/md.jpg"
                                 style=" " alt="NoImage" width="100%">
                        </a>
                    </div>
                </div>
                <div id="column2" class="col-4" style=";margin:3% 0;padding:0;">
                    <div class="row">
                        <div id="pDetails" class="col-6" style="padding:0 15px 0 1%">
                            <ul style=";;padding-right: 0;list-style: none;">
                                <li><span>پدید آورنده: </span>{{$r->author}}</li>
                                <li><span>مترجم:</span>{{$r->translater}}</li>
                                <li><span>ناشر:</span>{{$r->publisher}}</li>
                                <li>
                                    <a href="http://bahook.com/product/{{$r->id}}"
                                       style="background-color: #febe1b;font-size: 1vw;margin-top:30%;;color: #0b3750;"
                                       class="btn">
                                        <span id="pBuy" style=";font-weight: bold"><span
                                                    style="border-left: 1px solid ;padding-left: 5px">

                                                خرید از باهوک</span> <i
                                                    class="fa fa-shopping-cart fa-lg"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div id="pDetails2" class="col-6" style=";padding: 1%;list-style: none;">
                            <ul style=";padding:0;margin: 0;list-style: none;">
                                <li>تعداد صفحات: {{$r->pageno}}</li>
                                <li>سال چاپ:{{$r->pubdate}}</li>
                                <li>نوع جلد: {{$r->jeld}}</li>
                            </ul>
                        </div>
                    </div>
                    {{--<div>--}}
                    {{--<p>2</p>--}}
                </div>
                <div id="column3" class="col-6" style="margin:3% 0 0 0;padding: 0 2% 0 0;">
                    <div id="bookDescription"
                         style=";text-indent: 10px;line-height: 1.4;padding-right: 5px;border-right: 1px solid #606f7b">
                        {{--<p>خواندن رمان و داستان کوتاه همیشه مورد توجه همه انسان‌ها در دوران مختلف بوده اما با ورود رمان--}}
                        {{--و داستان کوتاه به قرن بیستم آن را راحتی و روانی کلام و درک آن توسط خواننده تا حد زیادی از--}}
                        {{--بین رفت و متون دیگر آن سادگی و روانی را نداشتند لذا خواننده نیز برای درک بهتر و صحیح‌تر نیاز--}}
                        {{--پیدا کرد به نقد و بررسی آثار نویسندگان.خواندن نقدهای مختلف و مربوط به ادوار قدیم و جدید--}}
                        {{--همواره احساس چندگانگی و ابهام را در خواننده به وجود می‌آورد و این احساس که رمان و داستان--}}
                        {{--اصلاً قابل خواندن و فهمیدن نیست احساس ناامیدی از ادبیات را برای خواننده به وجود می‌آورد.</p>--}}
                        <p>{{$r->description}}</p>
                    </div>
                </div>
            </div>


        @endforeach
    </div>

</div>
<div style="display: none">

</div>
</body>
</html>
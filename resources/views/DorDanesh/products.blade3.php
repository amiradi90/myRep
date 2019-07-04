<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=.75, maximum-scale=5.0, minimum-scale=.75, user-scalable=yes"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>

    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" --}}
          {{--integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
          crossorigin="anonymous">
    --}}
    {{--
    <script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" --}}
            {{--integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" --}}
            {{--crossorigin="anonymous"></script>
    --}}
    {{--
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" --}}
            {{--integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" --}}
            {{--crossorigin="anonymous"></script>
    --}}
    {{--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" --}}
            {{--integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" --}}
            {{--crossorigin="anonymous"></script>
    --}}
</head>
<style>
    @font-face {
        font-family: myfont;

    {
    {
    -- src: {

    {
    asset
    (
    url
    (
    'font/iranSans/IRANSans.ttf'
    )
    )
    }
    }
    ;
    --

    }
    }
    src:

    url
    (
    'http://ws73/font/iranSans/woff/iransansweb_light.woff'
    )
    ;
    }

    body {
        margin: 0;
        padding: 0;
        font-family: 'myfont', Tahoma;
        /*font-size: 1.2vw;*/
        width: 50%;
        margin: 0 auto;
        /*text-align: right;*/
    }

    @media only screen and (max-width: 900px) {
        body {
            width: 90%;
        }

        #middle-contents ul li {
            font-size: 1.2vw !important;
            line-height: 1 !important;
        }

        div #bookDescription {
            font-size: 1.2vw !important;
        }

    }

    .left-contents {
        /*float: right;*/
    }

    .product-image {
        /*display: block;*/
    }

    .row {
        border-radius: 3px;
        border: 1px solid #bbbbbb;
        background-color: #ffffff;
        margin: 5px auto;
    }

    #middle-contents ul {
        list-style: circle;
    }

    #middle-contents li {
        margin-top: 10px;
        line-height: 1;
        /*padding-right: 0;*/
        padding-bottom: 5px;
        /*width: 200px;*/
        text-align: right;
    }

</style>
<body>
<div class="contents">
    <div class="" id="divCenter" style="text-align: center;">
        <h2 style="font-size: 4vw">{{$result[0]->publisher}},{{$result[0]->parentcat}}</h2>
        @foreach($result as $r)
        <div class="row " style="padding: 5px 0;height: 100%;">
            <h5 class="" id="prTitle"
                style="width: 100%;padding:0 18% 0 0;margin-bottom: -10px;font-weight: bolder;text-align: right;font-size: 1.4vw">
                {{$r->name}}</h5>
            {{--<h6 class="hidden-lg-up" id="prTitle" style="width: 100%;text-align: right">{{$r->name}}</h6>--}}

            <div class=" col-2 col-sm-2 " style="text-align: right;padding: 0 10px 5px 0;;height: 100%">
                <div class="product-image  ">
                    <a href="http://www.bahook.com/product/{{$r->id}}" target="_blank;">
                        <img class=""
                             src="https://www.bahook.com/image/pic/new/{{$r->image}}/1/md.jpg" width="100%"
                             alt="NoImage">
                    </a>
                </div>
            </div>

            <div id="middle-contents" class="col-3 ">
                <ul style=";max-font-size:15px;padding-right: 0;list-style: none;">
                    <li><span>پدید آورنده:</span><a href="#">{{$r->author}}</a></li>
                    <li><span>مترجم:</span><a href="">{{$r->translater}}</a></li>
                    <li><span>ناشر:</span><a href="">{{$r->publisher}}</a></li>
                    <li>تعداد صفحات:<a href="">{{$r->pageno}}</a></li>
                    <li>سال چاپ:<a href="">{{$r->pubdate}}</a></li>
                    <li>نوع جلد: <a href="">{{$r->jeld}}</a></li>
                    <li>
                        <a href="http://www.bahook.com/product/{{$r->id}}" style="">
                            <div style=";
                        ;font-size:1vw;font-weight: bolder;text-align: center;
                    ">
                                <span style="display: table-cell;padding: 1px;background-color: #ffc107;color: black">خرید از باهوک</span>
                            </div>
                        </a>
                    </li>
                </ul>
                <div>

                </div>
            </div>
            <div class=" col-6  "
                 style=";border-right: 1px solid #606f7b;text-align: right;padding:5px;">
                <div id="bookDescription" style=";text-indent: 10px;line-height: 1.4;font-size: 0.8vw;">
                    <p>خواندن رمان و داستان کوتاه همیشه مورد توجه همه انسان‌ها در دوران مختلف بوده اما با ورود رمان
                        و داستان کوتاه به قرن بیستم آن را راحتی و روانی کلام و درک آن توسط خواننده تا حد زیادی از
                        بین رفت و متون دیگر آن سادگی و روانی را نداشتند لذا خواننده نیز برای درک بهتر و صحیح‌تر نیاز
                        پیدا کرد به نقد و بررسی آثار نویسندگان.خواندن نقدهای مختلف و مربوط به ادوار قدیم و جدید
                        همواره احساس چندگانگی و ابهام را در خواننده به وجود می‌آورد و این احساس که رمان و داستان
                        اصلاً قابل خواندن و فهمیدن نیست احساس ناامیدی از ادبیات را برای خواننده به وجود می‌آورد.</p>
                    {{--<p>{{$r->name}} نوشته ی {{$r->author}} است که {{$r->translater}} آن را به فارسی ترجمه کرده--}}
                        {{--است.--}}
                        {{--توسط--}}
                        {{--{{$r->publisher}} در سال {{$r->pubdate}} و {{$r->pageno}} صفحه به بازار عرضه شده است.
                        این--}}
                        {{--اثر از نظر موضوعی در دسته/های--}}
                        {{--ذیل--}}
                        {{--قرار میگیرد:</p>--}}
                    <a href="http://www.bahook.com/product/{{$r->id}}" target="_blank" style="padding: 0;margin: 0">
                        <span>ادامه مطلب</span></a>
                </div>
            </div>
        </div>
        @endforeach
        {{--{{ $result->links() }}--}}
    </div>

</div>
</body>
</html>
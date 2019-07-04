<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    {{--<script--}}
    {{--src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
    {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
    {{--crossorigin="anonymous"></script>--}}

    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>

    <style>
        @font-face {
            font-family: myfont;
            /*src: url('http://ws73/font/iranSans/woff/iransansweb_light.woff');*/
            {{--                        src: {{asset(url('font/iranSans/IRANSans.ttf'))}};--}}
 src: url({{url('/font/iranSans/woff/iransansweb_light.woff')}});

        }

        body {
            direction: rtl;
            background-color: white;
            font-family: "myfont";
            width: 65%;
            margin: 0 auto;
        }

        @media only screen and (max-width: 900px) {
            body {
                width: 100%;
            }

            #menu2Li, #menu3Li {
                font-size: 1.5vw !important;
                /*margin-top: 2% !important;*/
            }
        }

        .part2 .row {
            text-align: center;
        }

        .row {
            margin: 0;
        }

    </style>
    {{--<meta name="viewport"--}}
    {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    <meta name="viewport"
          content="width=device-width, initial-scale=.5, maximum-scale=10.0, minimum-scale=.25, user-scalable=yes"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>انتشارات بهمن</title>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
</head>
<body>
<style>
    body {
        z-index: 100;
    }

    .p1right li {
        list-style: none;
    }

</style>
<div class="" id="main">
    <div>
    </div>
    <div id="p1" class="row" style=";position: relative;">
        <div class="col-2 col-lg-2 col-md-2 col-xs-4 col-xl-2"
             style="background-color: #bbbbbb;width: 100%;padding: 0;">
            <div class="p1Right" style="height: 100%;z-index: 15;position: relative">
                <div id="p1Img" style="display: inline-block">
                    <div class="p1Img1" style=";background-color: #0b2e13;height: 33.3%;">
                        <img src="{{asset('img/dor/bahmanpub.svg')}}" class=""
                             style="width: 100%;height: 100%; ">
                    </div>
                    <div class="p1Img2" style="background-color: #090e2c;height: 33.3%;">
                        <img src="{{asset('img/dor/dor.svg')}}" class=""
                             style="width: 100%;height: 100%">
                        <img id="arrowBlue" src="{{asset('img/dor/arrow dark blue1.svg')}}" width="10%"
                             style=";top:47%;position: absolute;margin-right:-1px ">
                    </div>
                    <div class="p1Img3" style=";background-color:#FAA61A;height: 33.3%;">
                        <img src="{{asset('img/dor/naj.svg')}}" class=""
                             style="width: 100%;height: 100%">
                        <img id="arrowYellow" src="{{asset('img/dor/arrow dark orange1.svg')}}" width="10%"
                             style=";top:81%;position: absolute;margin-right: -1px ">

                    </div>
                </div>
            </div>
            <style>
                #menu-dor li a {
                    /*list-style: none;*/
                    color: white;
                    /*text-decoration-line: ;*/
                }
            </style>
            <div id="menu"
                 style="background-color: red;height: 100%;width:100%;position: absolute;z-index: 9;top: 0;right: 0">
            </div>
            <style>
                #menu-dor a {
                    text-decoration: none;
                }

                #menu2Li a:hover {
                    color: #ffc107;
                }

                #menu3Li a:hover {
                    color: #002752;
                }

            </style>
            <div id="menu-dor" style="position: absolute;right: 0;height: 100%;top:0;visibility: hidden;z-index: 14;">
                <ul style=";color: white;font-size:1vw;list-style-type: none;width: 100%;right: 0;padding: 0;">
                    <div id="menu2Li" style="text-align: right;top:0;right: 0;
    padding-right: 56%;margin-top: 34%;
    line-height: 2;">
                        <li>
                            <a href="#">اخبار و رویدادها</a>
                        </li>

                        <li><a href="{{ url('dorprdLevel/1139/139/Level3') }}">
                                روان شناسی و موفقیت</a></li>

                        <li><a href="{{ url('dorprdLevel/1139/58/level4') }}">
                                داستان مدرن</a></li>

                        <li><a href="{{ url('dorprdLevel/1139/189/level3') }}">
                                کسب و کار</a></li>

                        <li><a href="{{ url('dorprdLevel/1139/400/level3') }}">کودک</a></li>

                        <li><a href="#">درباره ما</a></li>

                        <li><a href="#">ارتباط با ما</a></li>

                        <li><a href="https://www.bahook.com/shelf?cat=3&page=1&per_page=40&q%5B8%5D%5B0%5D=1139">خرید آنلاین</a></li>
                    </div>
                    <div id="menu3Li" style="visibility: hidden;position: absolute;font-size: 1vw;
                    padding-right: 56%;right: 0;top: 0;text-align: right;margin-top: 103%;line-height: 2;">
                        <li>
                            {{--<span style="color:#ffc107">.</span>--}}
                            <a href="#">
                            اخبار و رویدادها
                            </a>
                        </li>
                        <li><a href="{{ url('dorprdLevel/3330/36/level3') }}">ادبیات کلاسیک</a></li>
                        <li>درباره ما</li>
                        <li>ارتباط با ما</li>
                        <li>
                            <a href="https://www.bahook.com/shelf?cat=3&page=1&per_page=40&q%5B8%5D%5B0%5D=3330">خرید آنلاین</a></li>
                    </div>
                </ul>
            </div>
        </div>
        <div id="p1Left" class="col-10 col-lg-10 col-md-10 col-xs-8 col-xl-10 "
             style="background-color: #606f7b;
                     background-image:url({{url('/img/dor/headerlq.jpg')}});
                     /*background-image: url('http://ws73/img/dor/header.jpg');*/
                     background-size: 100%  ;
                     z-index: 5;width: 100%">
            {{--            <img src="{{asset(url('img/dor/left1.jpg'))}}" width="100%" alt="">--}}
        </div>
    </div>

    <script>
        $('.p1Img2').mouseover(function () {
            $("#menu").css({'background-color': '#090e2c'});
            $("#menu").animate({width: "200%"}, 100);
            $("#menu-dor").animate({width: "200%"}, 100).css({'visibility': "visible"});
            $('#menu2Li').css('visibility', 'visible');
            $('#menu3Li').css('visibility', 'hidden');
            $('#arrowBlue').attr('src', 'img/dor/arrow dark blue2.svg');
            $('#arrowYellow').attr('src', 'img/dor/arrow dark orange1.svg');

            // $("#menuRight3Li").css('visibility', 'hidden');
            // $('#ii2').attr('src', 'img/dor/arrowBlue2.png');
            // $(".menuright2")._animateOff();
            // $("#menuright2").css({'background-color': '#090e2c'});
            // $('#menuRight2Li').css('visibility', 'visible');
            // $('#ii3').attr('src', 'img/dor/arrowYellow1.png');

        });
        $('.p1Img3').mouseover(function () {
            $("#menu-dor").animate({width: "200%"}, 100).css({'visibility': "visible"});
            $("#menu").css({'background-color': '#FAA61A'});
            $("#menu").animate({width: "200%"}, 100);
            $('#menu3Li').css('visibility', 'visible');
            $('#menu2Li').css('visibility', 'hidden');
            $('#arrowYellow').attr('src', 'img/dor/arrow dark orange2.svg');
            $('#arrowBlue').attr('src', 'img/dor/arrow dark blue1.svg');
            {{--$('#p1Left').css('background-image', {{url('/img/dor/pic2.jpg')}});--}}


        });

        // $('#p1Left').click(function () {
        // $('#p1Left').css("background-image", "url(/img/dor/pic2.jpg)");
        // });

        $("#menu,#menu-dor,body").mouseleave(function () {
            $("#menu-dor,#menu3Li,#menu2Li").css({'visibility': 'hidden'});
            // $('#menu2Li').css('visibility','hidden');
            $('#menu').animate({width: '100%'}, 100).finish();
            $('#arrowBlue').attr('src', 'img/dor/arrow dark blue1.svg');
            $('#arrowYellow').attr('src', 'img/dor/arrow dark orange1.svg');

        });
    </script>

    <div style="clear: both;margin-bottom:20px;position: relative"></div>
    <style>
        .part2 div {
            margin-bottom: 10px !important;
        }

        /*.part2 div:nth-child(1) {*/
        /*padding-right:  0;*/
        /*}*/
        /*.part2 div:nth-child(4) {*/
        /*padding-left: 0;*/
        /*}*/
        /*.part2 div:nth-child(3),.part2 div:nth-child(3) {*/
        /*padding-left: 5%;*/
        /*padding-right: 5%;*/
        /*}*/
    </style>

    <div>
        <div class="part2 row " style="background-color: #EEEEEE;margin: 0 auto;text-align: center;">
            {{--<div class="row" style="">--}}
            <div class="col-3">
                <a href="https://www.bahook.com/shelf?cat=189&page=1&per_page=40&q%5B8%5D%5B0%5D=1139">
                    <img src="{{asset('img/dor/start.jpg')}}" width="100%" alt="">

                </a>
            </div>
            <div class="col-3">
                <a href="https://www.bahook.com/shelf?cat=139">
                    <img src="{{asset('img/dor/success.jpg')}}" width="100%" alt="">

                </a>
            </div>
            <div class="col-3">
                <a href="https://www.bahook.com/shelf?cat=98&page=1&per_page=40&q%5B8%5D%5B0%5D=1139">
                    <img src="{{asset('img/dor/classic.jpg')}}" width="100%" alt="">

                </a>
            </div>
            <div class="col-3">
                <a href="https://www.bahook.com/shelf?cat=58&page=1&per_page=40&q%5B8%5D%5B0%5D=1139&q%5B8%5D%5B1%5D=3330">
                    <img src="{{asset('img/dor/modern.jpg')}}" width="100%" alt="">

                </a>
            </div>
            {{--</div>--}}
        </div>
    </div>
    <div style="clear: both;margin-bottom: 20px"></div>


    <div id="p3" class="row" style="text-align: right">
        <div class="col-5" style=";;margin: 0;padding: 0">
            <a href="">
                <img src="{{asset('img/dor/pic1.jpg')}}" style="width: 100%;height:100% ">

            </a>
        </div>
        <div class=" col-7" style="background-color: #dddddd;">
            <div style="border: 1px solid black;border-radius: 2px;margin:10px ;height: 90%;vertical-align: center">
                <h1 style="padding:10px 20px 5px 5px;font-size: 2vw;">
                    <span>قصه های هانس کریستیان آندرسن</span>
                </h1>
                <div style="padding: 10px;font-size: 1vw;">
                    <p>جوجه اردکی که طعم خوشبختی را چشید!
                        هانس کریستین آندرسن را پدر افسانه های نو می نامند. نویسندۀ شهیر دانمارکی که خالق داستان های افسانه ای چون: جوجه اردک زشت، لباس جدید پادشاه، دختر کبریت فروش، بند انگشتی، پری کوچک دریایی و دیگر قصه های معروف کودکانه است که برای هر کودک و بزرگی آشناست. قصه های او به 150 زبان دنیا ترجمه شده اند و هنوز هم خوانندگان بسیاری دارد.
                        متن زیر برای تست نوشته شده است. <a href="https://www.bahook.com/review/923">بیشتر ...</a></p>
                </div>
            </div>
        </div>
    </div>
    <div style="clear: both;width: 100%;margin-top: 20px"></div>

    <div id="p4" class="row" style="text-align: right">
        <div class="col-7" style="background-color: #eeeeee;margin: 0;padding: 0">
            <div style="border: 1px solid black;border-radius: 2px;margin:10px ;height: 90%">
                <h1 style="padding:10px 20px 5px 5px;font-size: 2vw;">
                    آمریکانا
                </h1>
                <div style="padding: 10px;
    font-size: 1vw;
    width: 100%;
    max-height: 90%;
    text-overflow: ellipsis;
    overflow-y: hidden;">
                    <p> ایفملو و اوبینزی در دوران نوجوانی در مدرسه متوسطه ای در لاگوس، عاشق یکدیگر می شوند. نیجریه در
                        زمان آن ها تحت حکومت دیکتاتوری دولت نظامی قرار دارد و افرادی که می توانند، کشور را ترک می گویند.
                        ایفملو برای تحصیل به امریکا مهاجرت می کند. او شکست هایی را متحول می شود و پیروزی هایی به دست می
                        آورد و، در همه این مدت، سنگینی موضوعی را حس می کند که در وطن، هیچ گاه تصورش را نیز نمی کرد:
                        نژاد. اوبینزی امید داشت که به او بپیوندد، اما امریکای پس از حادثه یازده سپتامبر، به او اجازه
                        ورود نمی دهد و او در زندگی غیر قانونی در بریتانیا فرو می رود. <a href="https://www.bahook.com/review/519">بیشتر ...</a></p>
                </div>
            </div>
        </div>
        <div class="col-5" style=";margin: 0;padding: 0">
            <a href="https://www.bahook.com/review/519" >
                <img src="{{asset('img/dor/pic2.jpg')}}" height="" width="100%" style=" ">
            </a>
        </div>
    </div>
    <div style="clear: both;width: 100%;margin-top: 20px"></div>


    <style>

        #ulfooter {
            /*list-style-type: none;*/
            /*display: flex;*/
            justify-content: center;
            margin-top: 200px;
            text-align: center;

        }

        ulfooter div {
            list-style: none;
            /*list-style-type: none;*/
            display: inline-block;
            /*color: white;*/
            /*margin: 20px 0;*/
        }
    </style>
    <div class="footer">
        <div class="container-fluid" style="margin:0 ;padding: 0 ">
            <div class="row" style=";height:280px;margin: 0 ;">
                <div class="col-sm-4" style="background-color: #0b2e13;"></div>
                <div class="col-sm-4" style="background-color:#090e2c;display: inline-block">
                    <div id="ulfooter" style="color: white;z-index: 10">
                        <a href="http://www.pinterest.com/bahman" class="twitter">
                            <img src="{{asset('img/social/pinterest.png')}}" style="width: 15%" alt="">
                        </a>
                        <a href="http://www.facebook.com/bahman" class="twitter">
                            <img src="{{asset('img/social/facebook.png')}}" style="width: 15%" alt="">
                        </a>
                        <a href="http://www.instagram.com/bahman" class="twitter">
                            <img src="{{asset('img/social/instagram.png')}}" style="width: 15%" alt="">
                        </a>
                        <a href="http://www.twitter.com/bahman" class="twitter">
                            <img src="{{asset('img/social/twitter.png')}}" style="width: 15%" alt="">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4" style="background-color: #ffae1e;"></div>
            </div>
        </div>
    </div>
</div>
</body>
</html>

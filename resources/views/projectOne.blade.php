<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <style>
        body {
            direction: rtl;
            background-color: white;
            font-family: "IRAN Sans";
            width: 75%;
            text-align: right;
            margin: 0 auto;
        }

        #left img {
            width: 100%;
            height: 540px;
            /*height: 100%;*/
        }

        #main {
            /*width: 100%;*/
            /*text-align: center;*/
            /*position: relative;*/
        }

        #main #p1 {
            /*position: relative;*/
            /*width: 100%;*/
            /*height: 540px;*/
            /*text-align: center;*/
        }

        #main #left {
            position: relative;
            background-color: whitesmoke;
            float: left;
            /*height: 540px;*/
            width: 86%;
        }

        #main #right {
            /*background-color: white;*/
            position: absolute;
            /*height: 540px;*/
            float: right;
            /*width: 15%;*/
            width: 155px;
        }

        #right ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            width: 100%;
        }

        #right li {
            width: 155px;
            height: 100%;
        }

        #right .li1, li2, li3 {
            /*width: 100%;*/
            width: 155px;
            height: 180px;
        }

        .liimg1 {
            width: 155px;
            /*width: 65%;*/
            height: 180px;
        }

        .liimg2 {
            position: absolute;
            top: 74px;
            right: 154px;
            height: 40px;
        }

        #right li a {
            transition: 0.2s ease;
            display: block;
            color: #666;
            text-align: center;
            text-decoration: none;
            width: 100%;
            /*height: 235px;*/
        }

        #right li a img {
            display: block;
        }

        /*li:hover {*/
        /*}*/

        #right li a:hover:not(.active) {
            /*opacity: 0.9;*/
            /*background-color: #1b1e21;*/
            transition: 0.2s ease;
        }

        #right li a.active {
            color: white;
            opacity: 0.5;
        }

        .part2 {
            /*margin-bottom: 20px;*/

            /*background-color: lightgray;*/
        }

        .part2 .row {
            /*margin: 0 auto;*/
            text-align: center;
        }

        .row {
            margin: 0;
        }

    </style>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>انتشارات بهمن</title>
    {{--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">--}}
    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>--}}
</head>
<body>
<div class="" id="main">
    <div class="" id="p1">
        <div id="left" class="" style=";z-index: 5">
            <img src="{{asset('img/dor/left1.jpg')}}" id="menu2" alt="">
            {{--@include('test')--}}
            {{--<iframe id="menu3" src="{{url('sl1')}}" frameborder="1"--}}
            {{--style="width:100%;height:100%;overflow: hidden;display: none;"></iframe>--}}
        </div>
        <div id="right" style="z-index: 10;top: 0;">
            <ul>
                <li class="li1">
                    <a href="#" style="">
                        <img src="{{asset('img/dor/c1.png')}}" class="liimg1">
                        <img src="{{asset('img/dor/bahmanpub.svg')}}" class="" style="width: 155px;height: 180px;
    position: absolute;
    top: 0;">
                    </a>
                </li>
                <li class="li2">
                    <a href="#" onclick="changeSlider2()" style="position: relative;">
                        <img src="{{asset('img/dor/c2.png')}}" class="liimg1">
                        <img src="{{asset('img/dor/dor.svg')}}" class="" style="width: 155px;height: 180px;;position: absolute;
    top: 0;">
                        <img id="ii2" src="{{asset('img/dor/arrowBlue1.png')}}" class="liimg2">
                    </a>
                </li>
                <li class="li3" style="position: relative;">
                    <a href="#" onclick="changeSlider3()">
                        <img id="" src="{{asset('img/dor/c3.png')}}" class="liimg1">
                        <img src="{{asset('img/dor/naj.svg')}}" class="" style="width: 155px;height: 180px;
    position: absolute;
    top: 0;">
                        <img id="ii3" src="{{asset('img/dor/arrowYellow1.png')}}" class="liimg2">
                    </a>
                </li>
            </ul>
        </div>
        <style>
            #menuRight2Li a, #menuRight3Li a {
                text-decoration: none;
                color: white;
            }
        </style>
        <div id="menuright2"
             style="float:right;width:153px;height:540px;position: absolute;z-index: 9;top: 0px;
             display: inline-block;background-color: black">
            <ul style=";padding-right:175px;font-weight: bolder;line-height: 40px ;color: white;padding-top: 100px;;list-style-type: none">
                <div id="menuRight2Li" style="visibility: hidden;">
                    <li><a href="#">اخبار و رویدادها</a></li>

                    <li><a href="{{ url('dorprdLevel/1139/139/Level3') }}">
                            روان شناسی و موفقیت</a></li>

                    <li><a href="{{ url('dorprdLevel/1139/58/level4') }}">
                            داستان مدرن</a></li>

                    <li><a href="{{ url('dorprdLevel/1139/189/level3') }}">
                            کسب و کار</a></li>

                    <li><a href="{{ url('dorprdLevel/1139/400/level3') }}">کودک</a></li>
                    {{--<li><a href="#">داستان مدرن</a></li>--}}
                    <li><a href="#">درباره ما</a></li>

                    <li><a href="#">ارتباط با ما</a></li>

                    <li><a href="https://www.bahook.com">خرید آنلاین</a></li>
                </div>
                <div id="menuRight3Li" style="visibility: hidden;">
                    <li>اخبار و رویدادها</li>
                    <li><a href="{{ url('dorprdLevel/3330/36/level3') }}">ادبیات کلاسیک</a></li>
                    <li>درباره ما</li>
                    <li>ارتباط با ما</li>
                    <li>خرید آنلاین</li>
                </div>
            </ul>
        </div>
    </div>
    <script>
        $('.li2').mouseover(function () {
            $("#menuright2").animate({width: "330px"}, 100);
            $("#menuRight3Li").css('visibility', 'hidden');
            $('#ii2').attr('src', 'img/dor/arrowBlue2.png');
            // $(".menuright2")._animateOff();
            $("#menuright2").css({'background-color': '#090e2c'});
            $('#menuRight2Li').css('visibility', 'visible');
            $('#ii3').attr('src', 'img/dor/arrowYellow1.png');

        });

        $("#menuright2,#li3,#li2").mouseleave(function () {
            $('#menuRight2Li').css('visibility', 'hidden');
            $('#menuRight3Li').css('visibility', 'hidden');
            $('#ii2').attr('src', 'img/dor/arrowBlue1.png');
            $('#ii3').attr('src', 'img/dor/arrowYellow1.png');
            $('#ii3').show();
            $("#menuright2").animate({width: '150px'}, 100).finish();
        });

        $('.li3').mouseover(function () {
            $("#menuright2").animate({width: "330px"}, 100);
            $("#menuRight3Li").css({'visibility': 'visible', 'margin-top': '-120px'});
            $("#menuRight2Li").css('visibility', 'hidden');
            // $("#menuRight3Li").animate({width: "330px"}, 300);
            $("#menuright2").css({'background-color': '#ffae1e'});
            $('#ii3').attr('src', 'img/dor/arrowYellow2.png');
            $('#ii2').attr('src', 'img/dor/arrowBlue1.png');
        });
        // $('.li3').mouseleave(function () {
        // $('#ii3').attr('src', 'img/c3-2.png');
        // $("#menuright2").animate({width: '150px'}, 100).finish();

        // });
        $('.li1').mouseover(function () {
            $("#menuright2").animate({width: '150px'}, 100).finish();
            $('#ii2').attr('src', 'img/dor/arrowBlue1.png');
            $('#ii3').attr('src', 'img/dor/arrowYellow1.png');
            $("#menuRight2Li,#menuRight3Li").css('visibility', 'hidden');


        })

    </script>

    <div style="clear: both;margin-bottom: 20px"></div>
    <style>
        .part2 div {
            margin-bottom: 10px !important;
        }
    </style>

    <div>
        <div class="part2 row " style="background-color: #EEEEEE;margin: 0 auto;text-align: center;">
            {{--<div class="row" style="">--}}
            <div class="col-lg-3 col-md-6 col-xs-6">
                <img src="{{asset('img/dor/start.jpg')}}" width="100%" alt="">
            </div>
            <div class="col-lg-3 col-md-6 col-xs-6">
                <img src="{{asset('img/dor/success.jpg')}}" width="100%" alt="">
            </div>
            <div class="col-lg-3 col-md-6 col-xs-6">
                <img src="{{asset('img/dor/classic.jpg')}}" width="100%" alt="">
            </div>
            <div class="col-lg-3 col-md-6 col-xs-6">
                <img src="{{asset('img/dor/modern.jpg')}}" width="100%" alt="">
            </div>
            {{--</div>--}}
        </div>
    </div>
    <div style="clear: both;margin-bottom: 20px"></div>

    <div class="row">
        {{--<div class="row">--}}
        <div class="col-xl-5 col-lg-5 col-sm-5 col-xs-12" style=";height: 300px;margin: 0;padding: 0">
            <img src="{{asset('img/dor/p3right.jpg')}}" style="width: 100%;height:100% ">

        </div>
        <div class="col-xl-7 col-lg-7  col-sm-7 col-xs-12" style="background-color: #dddddd;height: 300px;;">
            <div style="border: 1px solid black;border-radius: 2px;margin:10px 0 5px 10px;">
                <h1 style="padding:30px 30px 5px 5px;font-size: 30px;">
                    <span>کتاب باهوش تر ،سریع تر ،بهتر</span>
                </h1>
                <div style="padding: 10px;font-size: 20px;">
                    <p> متن زیر برای تست نوشته شده است . </p>
                    <p> متن زیر برای تست نوشته شده است . </p>
                </div>
            </div>
        </div>
        {{--</div>--}}
    </div>

    {{--<div class="container-fluid" style="margin-top: 20px;">--}}
    <div class="row" style="background-color: #eeeeee ;margin-top: 20px">
        <div class="col-sm-7" style=";height: 300px;margin: 0;padding: 0">
            <div style="border: 1px solid black;border-radius: 2px;margin:20px 30px 20px 30px;height: 260px">
                <h1 style="padding:50px 30px 5px 5px;font-size: 140%;">
                    کتاب باهوش تر ،سریع تر ،بهتر
                </h1>
                <div style="padding: 10px;font-size: 100%;font-weight: bold">
                    <p> متن زیر برای تست نوشته شده است . </p>
                    <p> متن زیر برای تست نوشته شده است . </p>
                </div>
            </div>
        </div>
        <div class="col-sm-5" style=";height: 300px;margin: 0;padding: 0">
            <img src="{{asset('img/dor/p3right.jpg')}}" style="width: 100%;height:100% ">
        </div>
    </div>
    {{--</div>--}}

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

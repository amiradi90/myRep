<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
</head>
<style>
    body {
        margin: 0;
        padding: 0;
        font-family: "IRAN Sans", Tahoma;
        font-size: 13px;
        width: 95%;
        margin: 0 auto;
        /*text-align: right;*/
    }

    .left-contents {
        /*float: right;*/
    }

    .product-image {
        /*display: block;*/
    }

    .row {
        padding: 10px;
        border-radius: 3px;
        border: 1px solid #bbbbbb;
        background-color: #ffffff;
        max-width: 700px;
        /*margin-bottom: 5px;*/
        margin: 5px auto;
    }

    .middle-contents ul {
        list-style: circle;
    }

    .middle-contents li {
        padding-right: 0;
        padding-bottom: 5px;
        width: 200px;
        text-align: right;
    }

</style>
<body>
<div class="contents">
    <div class="" id="divCenter" style="text-align: center;">
        <h2>{{$result[0]->publisher}},{{$result[0]->parentcat}}</h2>
        @foreach($result as $r)
            <div class="row " style="padding: 5px 0;">
                <h6 id="prTitle" style="width: 100%;padding-right: 190px;text-align: right">{{$r->name}}</h6>

                <div>
                <div class="product-image " style="width:165px;height:220px">
                    <a href="http://www.bahook.com/product/{{$r->id}}" target="_blank;" >
                        <img src="https://www.bahook.com/image/pic/new/{{$r->image}}/1/md.jpg" height="210px"
                              alt="NoImage">
                    </a>
                </div>
                </div>
                <div class="middle-contents  ">
                    <ul style="padding-right: 35px;list-style: none">
                        <li ><span>پدید آورنده:</span><a href="#">{{$r->author}}</a></li>
                        <li><span>مترجم:</span><a href="">{{$r->translater}}</a></li>
                        <li><span>ناشر:</span><a href="">{{$r->publisher}}</a></li>
                        <li>تعداد صفحات:<a href="">{{$r->pageno}}</a></li>
                        <li>سال چاپ:<a href="">{{$r->pubdate}}</a></li>
                        <li>نوع جلد: <a href="">{{$r->jeld}}</a></li>
                    </ul>
                    <a href="http://www.bahook.com/product/{{$r->id}}" style="text-decoration: none;">
                        <div style="width: 120px;height: 30px;padding-top: 2px;border: 1px solid lightgray;
                        border-radius: 10px;font-size: 16px;
                    border-radius: 2px;margin: 0 22px;background-color: #ffe924;color: black">
                            خرید از باهوک
                        </div>
                    </a>
                </div>
                <div class="book-description " style=";border-right: 1px solid #606f7b;text-align: right;">
                    <div style="max-width: 250px;padding:5px ;text-indent: 10px;line-height: 1.5;max-height: 200px;">
                        <p>{{$r->name}} نوشته ی {{$r->author}} است که {{$r->translater}} آن را به فارسی ترجمه کرده
                            است.
                            توسط
                            {{$r->publisher}} در سال {{$r->pubdate}} و {{$r->pageno}} صفحه به بازار عرضه شده است. این اثر از نظر موضوعی در دسته/های
                            ذیل
                            قرار میگیرد:</p>
                        <a href="http://www.bahook.com/product/{{$r->id}}" target="_blank" style="padding: 0;margin: 0"><span>ادامه مطلب</span></a>
                    </div>
                </div>
            </div>
        @endforeach
        {{--{{ $result->links() }}--}}
    </div>

</div>
</body>
</html>
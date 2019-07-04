<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>لیست اسناد انبارگردانی</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <script src="{{asset(url('js/bs4/bootstrap.bundle.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>

    <script>
        $('document').ready(function(){
            $('#tbl0').width($('#tbl1').width());
        });
    </script>
    <style>
        body {
            background-color: whitesmoke;
            font-family: amm, Tahoma;
        }

        @font-face {
            font-family: amm;
            src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
        }

        @media only screen and (max-width: 900px) {
            body, html {
                font-size: 0.9em !important;
                font-weight: bold;
            !important;
            }
        }

        #content {
            text-align: center;
        }

        #row {
            margin: 0 auto;
            display: inline-block;
        }

        ul.pagination {
            padding-right: 0px;
        }
    </style>
</head>
<body >
<div id="content">
    <h1>لیست اسناد ثبتی انبارگردانی</h1>

    <div id="" style="margin: 0 auto;padding: 0 ;width: auto;">
        <table id="tbl0" class="table-sm table-bordered" style="margin: auto;text-align: center"
               style="display: inline"
        >
            <tr>
                <td>
                    <label for="servername">نام سرور:</label>
                    <span id="servername">{{$servername}}</span>
                </td>
                <td>
                    {{date("Y-m-d H:i:s")}}
                </td>
                <td>
                    <div class="dropdown">
                        @if(auth()->check())
                            <form method="post" id="form1" action="{{route('logout')}}">
                                @csrf
                            </form>
                        @endif
                        <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                            <a id="" class=" " href="#" style="color:white;text-decoration: none">
                                {{ Auth::user()->name }}
                                <span class="caret"></span>
                            </a>
                        </button>
                        <ul class="dropdown-menu">
                            <li style="text-align: center">
                                <a class="log-out dropdown-item" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                    {{ __('خروج') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                </td>
            </tr>
        </table>
    </div>


    <div id="row">
        <table id="tbl1" class="table-striped table table-bordered table-responsive table-sm table-hover">
            <thead>
            <tr>
                <td><a href="{{route('amm3.create')}}" style="text-decoration:none; ">
                        <input type="button" id="BtnIndex" class="form-control btn-primary" value="جدید"
                               tabindex="-1"
                               onclick="" style="">
                    </a>
                </td>
            </tr>
            <tr>
                <td style="">شماره سند</td>
                <td>ایجاد کننده</td>
                <td>بروز کننده</td>
                <td>ردیف</td>
                <td>مجموع</td>
                <td>وضعیت</td>
            </tr>
            <tr id="trSearch">
                <td id="tdSearch" style="max-width: 80px">
                    <input id="inpSearch" autofocus accesskey="x"
                           onkeypress="if(event.keyCode=='13'){searchDoc(this.value,this.id)}; "
                           class="input-group-text " type="text" placeholder="" style=";font-size:0.8em;width: 100%">
                </td>
                <td>
                    <input id="inpCreator" class="input-group-text" type="text" placeholder=""
                           onkeypress="if(event.keyCode=='13'){searchDocCreator(this.value,this.id)};"
                           style="width: 100px;font-size:0.8em; ">

                </td>
                <td>
                    <input id="inpUpdater" class="input-group-text" type="text" placeholder=""
                           onkeypress="if(event.keyCode=='13'){searchDocUpdater(this.value,this.id)};"
                           style="width: 100px;font-size:0.8em">
                </td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            @foreach($dp as $d)
                <tr class="trDocs">
                    <td class="tdDocs">
                        <a id="aid" href="amm3/{{$d->DocId}}/edit"
                           style="font-size: 1.9em;font-weight: bolder;">{{$d->DocId}}</a>
                    </td>
                    <td class="tdCreator">{{$d->creator}}</td>
                    <td class="tdUpdater">{{$d->updater}}</td>
                    <td class="tdRows">{{$d->rows}}</td>
                    <td class="tdCnt">{{$d->cnt}}</td>
                    <td class="tdStatus">{{$d->status}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="" style=";margin: 0 auto;display: inline-block;">
            {{ $dp->links() }}
        </div>
    </div>
</div>
</body>
</html>
<script>

    function searchDoc(inp, q) {
        // console.log(inp);
        // if (){}
        if (inp == '') {
            $('.trDocs').css('display', 'table-row');
            return;
        }
        ;
        // if (inp != null && q == 'inpSearch') {
        if (q == 'inpSearch') {
            $('.trDocs').each(function (i, tr) {
                    // if (i = td.eq(1).search(inp))
                    let id = $(tr).children('.tdDocs').text().trim();
                    // console.log(id.trim());
                    if (id == inp) {
                        console.log(id);
                        $(tr).siblings().hide();
                        $(tr).show();
                        $(tr).nextUntil().show();
                    }
                }
            );
            return;
        }
        ;
    }

    function searchDocCreator(inp, q) {
        inp = inp.toLowerCase();
        if (inp == '') {
            $('.trDocs').css('display', 'table-row');
            return;
        }
        ;
        // if (inp != null && q == 'inpCreator') {
        $('.trDocs').each(function (i, tr) {
                // if (i = td.eq(1).search(inp))
                let creator = $(tr).children('.tdCreator').text().toLowerCase();
                // console.log(id);
                if (creator != inp) {
                    // $(tr).siblings().hide();
                    $(tr).hide();
                    $(tr).nextUntil().show();
                }
            }
        );
        // }
    }

    function searchDocUpdater(inp, q) {
        inp = inp.toLowerCase();
        if (inp == '') {
            $('.trDocs').css('display', 'table-row');
            return;
        }
        ;
        // if (inp != null && q == 'inpCreator') {
        $('.trDocs').each(function (i, tr) {
                // if (i = td.eq(1).search(inp))
                let updater = $(tr).children('.tdUpdater').text().toLowerCase();
                // console.log(id);
                if (updater != inp) {
                    // $(tr).siblings().hide();
                    $(tr).hide();
                    $(tr).nextUntil().show();
                }
            }
        );
        // }
    }
</script>
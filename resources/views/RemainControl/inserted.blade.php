<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>کنترل موجودی</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>

</head>
<style>
    @font-face {
        font-family: amm;
        src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
    }

    body {
        background-color: whitesmoke;
        margin: 0;
        padding: 0;
        font-family: amm, Tahoma;
        font-size: medium;
        tabindex: "-1";
    }

    .active {
        background-color: black;
    }

    #loading {
        background: url({{URL('/')}}/img/background/loading/831.svg) no-repeat center center;
        background-color: rgba(0, 0, 0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 9999999;
    }

    #loading2 {
        /*background: url("/img/background/loading/bar.gif") no-repeat center center;*/
        background: url({{URL('/')}}/img/background/loading/800.svg) no-repeat center center;
        background-color: rgba(0, 0, 0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 9999999;
    }

    .row {
        margin: 0;
        padding: 0;
    }

    @media only screen and (max-width: 900px) {
        body {

            font-size: 2.3vw !important;
            /*margin-top: 2% !important;*/
        }
    }

    #divGrpBtn {
        font-size: medium;
        text-align: center;
        /*display: inline-block;*/
        margin: 5px auto;
    }

    #tbl1 td {
        padding: 2px;
        line-height: 2;
    }

    #tbl1 tbody {
        counter-reset: rowNumber-1;
    }

    #tbl1 tbody tr {
        counter-increment: rowNumber;
    }

    #tbl1 tbody tr td:first-child::before {
        content: counter(rowNumber);
        min-width: 1em;
        margin-right: 0;
    }
</style>
@if(auth()->check() && auth()->user()->hasAnyRole('admin|all_principals'))
    <script>
        $(document).ready(function () {
            checkConflict();
            var path = window.location.pathname,
                link = window.location.href;
            $('a[href="' + path + '"], a[href="' + link + '"]').parent().addClass('active');
        });

        function refreshRemain() {
            console.log({{isset($data[0]->partcode)}});
                    {{--if ({{isset($data[0]->partcode)}}) {--}}
                    @if(isset($data[0]))
            var day =@json($data[0]->pickdateday);
            var stock =@json($data[0]->stock);
            var docid =@json($data[0]->docremain_id);
            @endif
            $('#loading2').show(10);
            $('input').attr('disabled', 'disabled');
            $.ajax({
                url: '/pick/RefreshRemainOnline',
                method: 'get',
                data: {day: day, stock: stock, docid: docid},
                success: function (res) {
                    console.log('res =>' + res);
                    $('input').removeAttr('disabled');
                    $('#loading2').hide(10);
                    $.confirm({
                        title: 'Success!',
                        content: 'بروزرسانی با موفقیت انجام شد',
                        type: 'green',
                        typeAnimated: true,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                },
                error(request, status, error) {
                    $('#loading2').hide(10);
                    $.confirm({
                        title: 'Error!',
                        type: 'red',
                        content: request.responseText,
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                    // alert(request.responseText);
                    $('input').removeAttr('disabled');
                }
            })
            // }
        };
    </script>
@endif

<script>
    $(document).ready(function () {
        $(document).on("keypress", "form", function (event) {
            return event.keyCode != 13;
        });
        $('#loading').hide(10);
        checkZero();
    });

    function fnEnter(e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        // console.log(key);
        if (key == 13) {
            return false;
            e.preventDefault();
        }
    }

    function checkZero() {
        $('.trData #remainControl').each(function (i, v) {
            // console.log($(v).parent());
            if (v.innerText == 0)
                $(v).parent().css('background-color', 'black');
        });
    }

    function submitFunc(i, p, r2, s, drid, thisOne) {

        var list = [i, p, r2, s, drid];
        // console.log(i, p, r2, s, drid);
        // $(t).parent().parent().find('#tdInpRemain2').css('background-color', 'green');
        $('input').attr('disabled', 'disabled');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/pick',
            method: 'post',
            data: {
                data: list, "_token": "{{ csrf_token() }}"
            },
            success: function (res) {
                console.log(res);
                $('input').removeAttr('disabled');
                $('.tdSave').css('background-color', '');
                // console.log($(thisOne).siblings());

                $(thisOne).parent().css('background-color', '#fb050a');
                $.alert({
                    title: 'saved successfully!',
                    content: res,
                    type: 'green',
                    rtl: true,
                    backgroundDismiss: false,
                    backgroundDismissAnimation: 'glow'
                });
            },
            error: function (request, status, error) {
                $('input').removeAttr('disabled');
                // alert(request.responseText);
                $.alert('خطا در داده ورودی|دوباره وارد برنامه شوید.');
            }
        });
    }

    function searchPartcode(e, v) {
        if (v == '') {
            $('.trData').css('display', 'table-row');
            return;
        }
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if (key == 13) {
            $('.trData #tdPartcode').each(function (i, td) {
                    if (td.innerText == v) {
                        var tr = $(td).parent();
                        // console.log(tr);
                        // console.log(tr.siblings());
                        tr.siblings().hide();
                        // $(tr).nextUntil().show();
                        // console.log($(td).parent().find('#tdId').text())
                    }
                }
            )
        }
    }

    function searchBarcode(e, v) {
        if (v == '') {
            $('.trData').css('display', 'table-row');
            return;
        }
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if (key == 13) {
            $('.trData #tdBarcode').each(function (i, td) {
                    if (td.innerText == v) {
                        var tr = $(td).parent();
                        tr.siblings().hide();
                    }
                }
            )
        }
    }

    function checkConflict() {
        $('.trData .tdInpRemain2').each(function (i, inp) {
            let r = parseInt($(inp).parent().parent().find('td#tdRemain').text());
            if (r != parseInt(inp.value)) {
                $(inp).parent().parent().css('background-color', '#e1e637');
            }
            ;
        });
    }

    function fnExcelReport(e) {
        e.preventDefault();
        var tab_text = "<table border='1px'><tr bgcolor='#87AFC6'>";
        var textRange;
        var j = 0;
        tab = document.getElementById('tbl1'); // id of table
        for (j = 0; j < tab.rows.length; j++) {
            tab_text = tab_text + tab.rows[j].innerHTML + "</tr>";
        }
        tab_text = tab_text + "</table>";
        // tab_text = tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
        // tab_text = tab_text.replace(/<img[^>]*>/gi, ""); // remove if u want images in your table
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

        // var ua = window.navigator.userAgent;
        // var msie = ua.indexOf("MSIE ");
        // if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
        // {
        //     txtArea1.document.open("txt/html", "replace");
        //     txtArea1.document.write(tab_text);
        //     txtArea1.document.close();
        //     txtArea1.focus();
        //     sa = txtArea1.document.execCommand("SaveAs", true, "Say Thanks to Sumit.xls");
        // }
        // else                 //other browser not tested on IE 11

        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));
        return (sa);
    }

    function getImage(p) {

        $.ajax({
                url: '/pick/getImage',
                method: 'get',
                data: {p: p},
                dataType: 'json',
                success: function (data) {
                    // var json = data;
                    // console.log(data.id);

                    // for (var i = 0; i < json.length; ++i) {
                    // var a;
                    // let b = 0;
                    //
                    // for (a = 1; a <= 10; a++) {
                    //     if (data.level + a == null) {
                    //         console.log(data.level + a);
                    //         b = a - 1;
                    //     }
                    //     // break;
                    // }
                    // ;
                    // console.log(data.level+"1");

                    if (data != 0) {
                        $('#specs').html('');
                        // $('#specs').append('[کد:' + data.id + ']');
                        $('#specs').append(';[ بارکد:' + data.barcode + ']');
                        $('#specs').append(';[ناشر: ' + data.publisher + ']');
                        $('#specs').append('[گروه بندی: ' + data.level0 + '>' + data.level1 + '>' + data.level2 +
                            '>' + data.level3 +
                            '>' + data.level4 +
                            '>' + data.level5 +
                            '>' + data.level6 +
                            '>' + data.level7 +
                            '>' + data.level8 +
                            '>' + data.level9 +
                            '>' + data.level10 +
                            ']');
                        let src = "http://www.bahook.com/image/pic/new/" + data.image + "/1/md.jpg";
                        $('#divImage,#specs,#divSpecs').show();
                        let h = $('#divSpecs').height();
                        $('#divImage').css('bottom', h);
                        let i = $("#ImageFrame");
                        i.attr("src", src);
                        i.show();
                        // }
                        return;
                    }
                    else {
                        let src1 = "/img/iconic/noimage.jpg";
                        $('#divImage,#specs,#divSpecs').show();
                        $('#specs').html('');
                        let h = $('#divSpecs').height();
                        // console.log(h);
                        $('#divImage').css('bottom', h);
                        let i = $("#ImageFrame");
                        i.attr("src", src1);
                        i.show();
                        return 0;
                    }

                    // if (res != 0) {
                    //     $('#divImage').show();
                    //     $i = $("#ImageFrame");
                    //     $i.attr("src", res);
                    //     $i.show();
                    //     // $("#divImage").content=res;
                    // }
                    // else {
                    //     $i = $("#ImageFrame");
                    //     $i.attr("src", "/img/iconic/noimage.jpg");
                    //     $i.show();
                    // }
                    // console.log(res);
                },
                error:
                    function (request, status, error) {
                        // alert(error);
                        alert('Connection Error Happened');
                    }
            }
        );
    }

    function clickToHide() {
        $('#specs,#ImageFrame,#divSpecs').hide();
    }

</script>

@if(auth()->check() && auth()->user()->hasAnyRole('admin|b'.$stockid.'_members'))

    <body>
    <div id="loading"></div>
    <div id="loading2" style="display: none;"></div>
    <div id="divImage"
         style="display: none;clear: both;margin: 0;right:10%;position: fixed;border: 1px solid white;border-radius: 1px">
        <img id="ImageFrame" class="img-responsive" style="display: block;height: 100%;position: relative"
             onclick="clickToHide()">

    </div>
    <div id="divSpecs"
         style=";bottom: 1px;margin: 0;position: fixed;border: 1px solid white;border-radius: 1px">
        <div id="specs" style=";display: block;background-color: #83bde6;position: relative;"></div>

    </div>

    <script>

    </script>

    @role('admin|all_principals')
    <button id="btnExport" onclick="fnExcelReport(event);" style="left:0;position: absolute" tabindex="-1"
            title="خروجی اکسل">
        <span><i class="fa fa-download fa-lg" style="color:#007bff"></i></span>
    </button>
    @endrole
    {{--<button id="btnExport" onclick="fn2(event)"> EXPORT2</button>--}}
    {{--<iframe id="txtArea1" style="display:none"></iframe>--}}
    <form method="post" id="form1" class="" action="{{route('logout')}}" autocomplete="off">
        @csrf

        <div id="divGrpBtn">
            <table id="tblCategory" class="table-responsive table-sm table-bordered  ">
                <tbody>
                <tr>
                    <td>
                        <span style="color: #ff2b12">{{auth::user()->name}}
                            <i class="fa fa-user-tie fa-lg"></i></span>

                        <div class="">
                            <a class="" href="{{route('logout')}}" tabindex="-1"
                               onclick="event.preventDefault();
                                    document.getElementById('form1').submit();">
                                <i class="fa fa-sign-out fa-lg" title="خروج"></i>
                                {{--{{ __('خروج') }}--}}
                            </a>
                        </div>

                    </td>
                    <td style="color: #ff2b12;">
                            <span style="display: inline-block">
                                Bahman <span>{{$stockid}}</span>
                            </span>
                        <br>
                        <span style="display: inline-block;color: #007bff">
                            @role('all_principals|admin')
                                <a class="" href="#" tabindex="-1"
                                   onclick="event.preventDefault();refreshRemain()">
                                    <i class="fa fa-refresh fa-lg" title="به روز رسانی موجودی"></i>
                                    {{--{{ __('خروج') }}--}}
                                </a>
                            {{--<button onclick="event.preventDefault();refreshRemain(event);" tabindex="-1"--}}
                            {{--onkeypress=""--}}
                            {{--style="color: #007bff;border: 0;background-color: transparent;"--}}
                            {{--title="به روز رسانی موجودی">--}}
                            {{--<i class="fa fa-refresh fa-lg"></i>--}}
                            {{--</button>--}}
                            @endrole
                            </span>

                    </td>
                    <td onclick="">
                        {{($today)}}
                    </td>
                </tr>
                <tr style="background-color:white;">
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

                <tr>
                    <td colspan="1">
                        <a href="{{url('pick/')}}" title="برگشت به منو">
                            <i class="fa fa-home fa-lg"></i>
                        </a>

                    </td>
                    <td colspan="1">
                        @hasanyrole('admin|all_principals')
                        <a href="{{url('pick/'.$stockid)}}" style="">همه</a>
                        @endhasanyrole
                    </td>
                    <td colspan="1">
                        <a href="{{url('pick/'.$stockid.'/7')}}">سی دی</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="{{url('pick/'.$stockid.'/1')}}">کمک درسی</a></td>
                    <td><a href="{{url('pick/'.$stockid.'/2')}}">زبان</a>
                    </td>
                    <td><a href="{{url('pick/'.$stockid.'/3')}}">دانشگاهی/کامپیوتر</a>
                    </td>
                </tr>
                <tr>
                    <td><a href="{{url('pick/'.$stockid.'/4')}}">عمومی</a>
                    </td>
                    <td><a href="{{url('pick/'.$stockid.'/5')}}">کودک</a>
                    </td>
                    <td><a href="{{url('pick/'.$stockid.'/6')}}">نوشت افزار</a>
                    </td>

                </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <table id="tbl1" class=" table-striped  table-responsive table-bordered  table-sm"
                   style="margin:0 auto;text-align: center;">
                <thead>
                <td>no</td>
                <td class="">partcode</td>
                <td class="">barcode</td>
                <td class="">name</td>
                <td class="">Remain2</td>
                <td class="">save</td>
                @hasanyrole('all_principals|admin')
                <td class="">
                    remain
                </td>
                @else
                    @endhasanyrole
                    <td>publisher</td>
                    <td class="">grpid</td>
                    <td class="">grp</td>
                    <td class="">stock</td>
                    <td class="">drID</td>
                    <td class="">pickdate</td>
                    <td class="">Day</td>
                    <td class="">ID</td>
                    <td id="" style="display: none;"></td>
                </thead>
                <thead>
                <td></td>
                <td id="barcodeSearch" style="margin: 0;padding: 0;">
                    <input class="input-group-lg  " type="text" tabindex="1"
                           onkeypress="searchPartcode(event,this.value)"
                           style="margin:0 auto ;padding:3px 0;height: 100%;font-size: medium;max-width: 100px">
                </td>
                <td id="nameSearch" style="margin: 0;padding: 0;">
                    <input id="inppartcode" tabindex="-1" type="text"
                           onkeypress="searchBarcode(event,this.value)"
                           style="margin:0 auto ;padding:3px 0;height: 100%;font-size: medium;max-width:100px">
                </td>
                </thead>

                <tbody>
                @foreach($data as $d)
                    <tr id="trData" class="trData">
                        <td></td>
                        <td id="tdPartcode" ondblclick="getImage({{$d->partcode}})">{{$d->partcode}}</td>
                        <td id="tdBarcode">{{$d->barcode}}</td>
                        <td class="" style="max-width: 220px;">{{$d->name}}</td>
                        <td id="tdRemain2" class="">
                            <input id="tdInpRemain2" class="tdInpRemain2" type="number"
                                   onkeypress=""
                                   style="width:50px;padding: 0;margin: 0" tabindex="-1"
                                   min="0"
                                   value="{{$d->remain2}}">
                        </td>
                        <td id="tdSave" class="tdSave" style="width:35px;">
                            <input
                                    style="
                                margin: 0;padding: 0;width: 100%;height:30px;
                                " type="button" tabindex="-1"
                                    class="form-control btn-primary"
                                    value="Save"
                                    onclick="
                                if($(this).parent().parent().find('#tdInpRemain2').val() !='') {
                                    submitFunc(
                                $(this).parent().parent().find('#tdId').text(),
                                $(this).parent().parent().find('#tdPartcode').text(),
                                $(this).parent().parent().find('#tdInpRemain2').val(),
                                $(this).parent().parent().find('#tdStock').text(),
                                $(this).parent().parent().find('#tdDocremainid').text(),
                                this
                                )
                                }else alert('Enter Number');
                        ">
                        </td>
                        @hasanyrole('admin|all_principals')
                        <td id="tdRemain" class="tdRemain">
                            {{($d->remain)}}
                        </td>
                        @endhasanyrole
                        <td>{{$d->publisher}}</td>
                        <td>{{$d->grpid}}</td>
                        <td>{{$d->grp}}</td>
                        <td id="tdStock">{{$d->stock}}</td>
                        <td id="tdDocremainid">{{$d->docremain_id}}</td>
                        <td>{{$d->pickdate}}</td>
                        <td>{{$d->pickdateday}}</td>
                        <td id="tdId" id="">{{$d->id}}</td>
                        <td id="remainControl" style="display: none"> {{$d->remain}}</td>
                    </tr>
                @endforeach
            </table>
            </tbody>
        </div>

    </form>

    </body>
@else
    <h2 style="float: right;direction: ltr">
        <span>  شما مجوز دسترسی به این شعبه را ندارید</span>
        <span> <span style="color:#ff2b12;"> {{auth()->user()->name}}</span> کاربر </span>
    </h2>
@endif

</html>

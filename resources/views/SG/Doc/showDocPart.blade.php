<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit StockLacking Document</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery.playSound.js'))}}'></script>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>
    <script>
        window.onload = () => {
            setTimeout(() => {
                countSum();
            }, 1000)
        }
        $(document).ready(function () {
            if (parseInt({{$docStatus}}) == 2) {
                $("input").attr('disabled', 'disabled');
                $('td.rmv,.thRemove,th#thX').hide();
                $('#btnFinalDocConfirm').val('برگشت از تایید');
                $('#btnFinalDocConfirm,#BtnIndex').removeAttr('disabled');
                $('#btnSubmit').css('background-color', '#e9ecef');
            }
            ;
        });

        function funcSubmit() {
            $('#btnSubmit').val('بروز رسانی');
            $('#btnSubmit').css('background-color', 'royalblue');
            $('.sound-player').remove();
            if (iterateCheckPartcode() != 'ok') {
                // alert('Iterate Happened');
                return;
            }
            $("input").attr('disabled', 'disabled');//wait until update compelete
            $.confirm({
                escapeKey: 'خیر',
                title: '!Update',
                content: 'سند به روزرسانی شود؟',
                type: 'green',
                draggable: true,
                animationSpeed: 2,
                animation: 'scaleX',
                closeAnimation: 'scaleX',
                backgroundDismissAnimation: 'glow',
                // typeAnimated: false,
                buttons: {
                    confirm: {
                        text: 'بله',
                        btnClass: 'btn-green',
                        direction: 'ltr',
                        action: function () {
                            if ($('#tbody tr').length > 0) {//check not empty list
                                $('#loading').show();
                                // var list = postArray();
                                var list = postArray();
                                // return;
                                var docid = $('#documentId').text();
                                $.ajax({
                                    // url: '/amm3/' + docid,
                                    // method: 'put',
                                    url: '/amm3/update/' + docid,
                                    method: 'post',
                                    data: {
                                        data: list, documentid: docid, "_token": "{{ csrf_token() }}"
                                    },
                                    success: function (res) {
                                        $('#btnSubmit').removeClass('btn-primary').attr({
                                            // "disabled": "disabled",
                                            'value': 'Successfully Updated'
                                        }).css('background-color', 'green');
                                        $("input").removeAttr('disabled');
                                        $('#loading').hide();
                                        $.alert({
                                            title: 'سند بروز شد.',
                                            content: '',
                                        });
                                        // location.reload();
                                        // $('#documentId').text('Document ID: ' + res).css('background-color', '#2a9055');
                                        // console.log(res);
                                    },
                                    error: function (request, status, error) {
                                        $('#btnSubmit').removeClass('btn-primary').attr({
                                            // "disabled": "disabled",
                                            'value': 'Error '
                                        }).css('background-color', 'red');
                                        $("input").removeAttr('disabled');
                                        $('#loading').hide();
                                        alert(request.responseText);
                                        alert(error);
                                    }
                                });
                            }
                            else $.confirm({
                                title: '',
                                content: 'لیست خالی است.',
                                buttons: {
                                    close: function () {
                                        $("input").removeAttr('disabled');
                                        return;
                                    }
                                }
                            })
                        }
                    },
                    'خیر': function () {
                        $("input").removeAttr('disabled');
                    }
                }
            });
        }

        function funcFinalDocConfitm() {
            var btnValue = $('#btnFinalDocConfirm').val();
            var currentStatus = btnValue == 'برگشت از تایید' ? 2 : 1;
            console.log('DocStatus==>' + currentStatus);

            $('.sound-player').remove();
            if (iterateCheckPartcode() != 'ok') {
                alert('Iterate Happened');
                return;
            }
            $.confirm({
                title: '!Confirm',
                content: 'مطمئن هستید؟',
                type: 'dark',
                typeAnimated: true,
                buttons: {
                    confirm: {
                        text: 'بله',
                        btnClass: 'btn-green',
                        direction: 'ltr',
                        action: function () {
                            if ($('#tbody tr').length > 0) {
                                var list = postArray();//for showing last data before final confirm.
                                var docid = $('#documentId').text();
                                $.ajax({
                                    url: '/amm3/finalDocConfirm/' + docid,
                                    method: 'put',
                                    data: {
                                        documentid: docid,
                                        "_token": "{{ csrf_token() }}",
                                        'currentStatus': currentStatus
                                    },
                                    success: function (res) {
                                        console.log(res);
                                        if (res == 'تایید شد') {
                                            $('#btnFinalDocConfirm').removeClass('btn-dark').attr({
                                                'value': res
                                            });
                                            $('#btnSubmit').css('background-color', '#e9ecef');
                                            $("input").attr('disabled', 'disabled');
                                            $("#BtnIndex").removeAttr('disabled');
                                            $('td.rmv,.thRemove,th#thX').hide();
                                        }
                                        else if (res == 'تایید نهایی') {
                                            $('#btnFinalDocConfirm').addClass('btn-dark').attr({'value': res});
                                            $('#btnSubmit').css('background-color', 'royalblue');
                                            $("input").removeAttr('disabled');
                                            $('td.rmv,.thRemove,th#thX').show();
                                        }
                                        location.reload();
                                    },
                                    error: function (request, status, error) {
                                        console.log(error);
                                        $('#btnFinalDocConfirm').removeClass('btn-primary').attr({
                                            'value': 'Error '
                                        }).css('background-color', 'red');
                                        alert(request.responseText);
                                    }
                                });
                            }
                            else $.confirm({
                                title: '',
                                content: 'لیست خالی است.',
                                buttons: {
                                    close: function () {
                                        return;
                                    }
                                }
                            })
                        }
                    },
                    'خیر': function () {
                    }
                }
            });
        }

        @role('admin')
        function fnSortByRemain() {
            var tbody = $('#tbodySP');
            $('.trSp .divRemain').each(function (i, td) {
                let n = parseInt(td.innerText);
                if (n > 0) {
                    tbody.prepend(td.parentElement);
                }
            });
        }

        @endrole

    </script>
    <script>
        var _timer = 0;

        function DelayedShowResult(str, id) {
            // console.log(id+ str +'** length=>'+str.length)
            if (_timer)
                window.clearTimeout(_timer);
            _timer = window.setTimeout(function () {
                if (str.length == 0) {
                    // document.getElementById("livesearch" + id).innerHTML = "";
                    // document.getElementById("livesearch" + id).style.border = "0px";
                    $('livesearch' + id).html('').finish();
                    // $('livesearch'+id).html('').finish();
                }
                if (str.length > 3)
                    showResult(str, id);
            }, 1000);
        }

        function showResult(str, id) {
            var str = encodeURIComponent(str); // otherwise + sign is omitted
            // if (str.length == 0) {
            //     document.getElementById("livesearch" + id).innerHTML = "";
            //     document.getElementById("livesearch" + id).style.border = "0px";
            //     return;
            // }

            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            // else {  // code for IE6, IE5
            //     xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            // }
            // if (str.length > 3) {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    // console.log(this.responseText);
                    document.getElementById("livesearch" + id).innerHTML = this.responseText;
                    document.getElementById("livesearch" + id).style.border = "1px solid #A5ACB2";
                }
            }
            if (id == 'name0') {
                xmlhttp.open("GET", "/amm3/searchName?q=" + str, true);
                xmlhttp.send();
                return;
            }
            xmlhttp.open("GET", "/amm3/searchPartcode?q=" + str, true);
            xmlhttp.send();
        }

        function addPartcode(v, partref) {
            // var v = $.trim(t);//space between don't remove;--}}
            console.log('selected partcode=>' + v + '&& partref=>' + partref);
            $('input').attr('disabled', 'disabled');
            $('#livesearchpartcode0,#livesearchname0,#partcode0,#name0').val('').html('');
            console.log('!!');
            if (searchRepeatPartcode(v) == 'Successfully Added') {//search in PARTCODE of list
                $('.sound-player').remove();
                $.playSound("{{asset(url('media/repeat.mp3'))}}");
                $('input').removeAttr('disabled');
                $('#barcode0').focus();
                return;
            }
            $.ajax({
                method: 'get',
                url: '/amm3/selectPartcode',
                data: {q: v, partref: partref},
                success: function (res) {
                    $('input').removeAttr('disabled');
                    var el = $('#tbody tr:first');
                    if (el.length) {
                        $('.trLast').css('background-color', '');
                        el.before(res);
                        $.playSound("{{asset(url('media/newEntry.wav'))}}");
                    }
                    else {
                        $('.trLast').css('background-color', '');
                        $("#tbody").append(res);
                        $.playSound("{{asset(url('media/newentry.wav'))}}");
                    }
                    $('#barcode0').focus();
                    countSum();
                },
                error: function (e) {
                    $('input').removeAttr('disabled');
                    $('#barcode0').focus();
                    alert(e);
                }
            })
        };

        function PressEnterAddPartcode1(v) {
            // var v = $.trim(t);//space between don't remove;--}}
            console.log('Entered partcode=>' + v);
            $('input').attr('disabled', 'disabled');
            $('#livesearchpartcode0,#livesearchname0,#partcode0,#name0').val('').html('');
            console.log('PressEnterAddPartcode Called');
            if (searchRepeatPartcode(v) == 'Successfully Added') {//search in PARTCODE of list
                $('.sound-player').remove();
                $.playSound("{{asset(url('media/repeat.mp3'))}}");
                $('input').removeAttr('disabled');
                $('#barcode0').focus();
                return;
            }
            $.ajax({
                method: 'get',
                url: '/amm3/selectPartcode',
                data: {q: v},
                success: function (res) {
                    $('#livesearchpartcode0,#livesearchname0,#partcode0,#name0').val('').html('');
                    $('input').removeAttr('disabled');
                    var el = $('#tbody tr:first');
                    if (el.length) {
                        $('.trLast').css('background-color', '');
                        el.before(res);
                        $.playSound("{{asset(url('media/newEntry.wav'))}}");
                    }
                    else {
                        $('.trLast').css('background-color', '');
                        $("#tbody").append(res);
                        $.playSound("{{asset(url('media/newentry.wav'))}}");
                    }
                    $('#barcode0').focus();
                    countSum();
                },
                error: function (e) {
                    $('input').removeAttr('disabled');
                    $('#barcode0').focus();
                    alert(e);
                }
            })
        };

    </script>

    <style>
        body {
            overscroll-behavior: contain;
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
            border: 0;
            /*line-height: 0.5vw;*/
            font-size: 0.9vw;
            font-family: amm, Tahoma;
            width: 98.5%;
            text-align: center;
            color: #000000;
            tab-index: -1;
        }

        @font-face {
            font-family: amm;
            src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
        }

        @media only screen and (max-width: 900px) {
            body, html {
                font-size: 0.83em !important;
                /*margin-top: 2% !important;*/
            }

            .barcode0 {
                font-size: 1.1em !important;
            }

            .partcode0 {
                font-size: 1.6em !important;
            }

            #tblSP .divPartcode {
                font-size: 1.4em !important;
            }

            #tblSP .divPartname {
                font-size: 1.4em !important;
            }

            #thName0:focus, input#name0:focus {
                width: 110px !important;
            }

            td.tedad {
                font-size: 1.3em !important;
            }
        }

        #content1 {

        }

        #tblMain, #tblMain input {
            border: 0;
        }

        td:hover {
            /*-webkit-box-shadow: 1px 1px 4px gray;*/
            -webkit-box-shadow: 1px 1px 4px gray;
            -moz-box-shadow: 1px 1px 4px gray;
            box-shadow: 1px 1px 4px gray;
        }

        #divHead {
            /*background-color: #bbbbbb;*/
            /*font-size: 13px;*/
            /*padding: 5px;*/
            /*margin: 0;*/
            /*line-height: 0.8;*/
        }

        #tbldiv {
            margin: auto;
            padding-right: 15px;
        }

        #livesearchpartcode0 td, #livesearchname0 td {
            padding: 10px 0;
            font-size: 0.9em;
        }

        #livesearchpartcode0, #livesearchname0 {
            max-height: 600px;
            overflow-y: auto;
        }

        /*td.name0 {*/
        /*max-height: 40px !important;*/
        /*overflow-y: scroll;*/
        /*}*/

        #trFooter {
            background-color: mistyrose;
            /*font-family: "Arial Black", arial-black;*/
            font-weight: bolder;
        }

        #divPs {
            /*text-align: right;*/
        }

        td.rmv, td.grp0, td.tedad, td.price0, .inpTedad {
            padding: 1px;

        }

        .name0Focus {
        'min-width': '200px',
        'position': 'relative'
        }

        .tedad, .grp0, .price, .inpTedad {
            /*margin: 0;*/
            /*padding: 0;*/
            /*border: 0;*/
            font-size: 1em;
            /*max-width: 60px;*/
        }

        .tedad {
            /*font-size: 12px;*/
        }

        .inpTedad {
            max-width: 55px;
            /*padding-top: 1px;*/
            /*padding-bottom: 1px;*/
            /*height: 100%;*/
        }

        #partcode0, #barcode0, #name0 {
            max-width: 200px;
            font-size: 16px;
        }

        #loading {
            background: url({{URL('/')}}/img/background/loading/spinner.svg) no-repeat center center;
            background-color: rgba(0, 0, 0, 0.5);
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
            z-index: 9999999;
        }
    </style>

</head>
{{--<body onkeydown="return (event.keyCode != 116)">--}}
<body onkeydown="">
<div id="loading" style="display: none"></div>
<div id="content1">
    <form method="post" class="" autocomplete="off">
        @method('post')
        @csrf
        <div id="divHead" style="width: 99%;margin: 2px auto;">
                <span><span style="display: inline-block;float:right;"> ویرایش سند شماره <span
                                id="documentId"
                                style="font-weight: normal;color:#0009ff;">{{$docid}}
                            &nbsp;</span></span><span>ثبت کننده :{{$creator}}</span></span>

            <span style="float: left;padding-left: 10px">:User</span>
            <span id="documentId" style="float: left;;color:#0009ff;">{{Auth::user()->name}}</span>
        </div>
        <div class="row" style="clear: both;">
            <div id="tbldiv" class="">
                <div style="clear: both;">
                    <input type="button" id="btnSubmit" class="form-control btn-primary" value="بروز رسانی"
                           tabindex="-1"
                           onclick="funcSubmit()" style="color: white;width:160px;float: left;padding:2px;margin: 2px">
                    <input type="button" id="btnFinalDocConfirm" class="form-control btn-dark" value="تایید نهایی"
                           tabindex="-1"
                           onclick="funcFinalDocConfitm()" style="width: 160px;float: right;padding:2px;margin: 2px">
                </div>
                <table id="tblMain" class="table-bordered table-striped table-hover table-responsive">
                    <thead class="thead-light">
                    <tr style="">
                        <th><input id="barcode0" accesskey="c"
                                   class="form-control form-control-lg" type="text"
                                   autofocus
                                   onfocus='$("#livesearchpartcode0,#livesearchname0").html("");$("#partcode0,#name0").val("")'
                                   style="padding-left: 0;padding-right: 0;"
                                   placeholder="barcode" dir="ltr">
                        </th>
                        <th>
                            <input id="partcode0" class="form-control form-control-lg" type="text" accesskey="x"
                                   oninput="DelayedShowResult(this.value,this.id);"
                                   {{--onkeydown="  return (event.keyCode != 13)"--}}
                                   onkeydown="  if (event.keyCode == 13) PressEnterAddPartcode(this.value)"
                                   onfocus='$("#livesearchname0").html("");$("#name0,#barcode0").val("")'
                                   style="padding-left: 0;padding-right: 0 " tabindex="-1;"
                                   placeholder="کد کالا" dir="ltr">
                            <div id="livesearchpartcode0" style="position:absolute;background-color:floralwhite;"></div>
                            <div id="livesearchname0" style="position:absolute;background-color:floralwhite;"></div>

                        </th>
                        <th id="thName0">
                            <input id="name0" class="form-control form-control-lg" type="text" placeholder="نام"
                                   accesskey="z"
                                   oninput="DelayedShowResult(this.value,this.id) "
                                   onfocus='$("#livesearchpartcode0").html("");$("#partcode0,#barcode0").val("")'
                                   style="padding-left: 0;padding-right: 0 " tabindex="-1"
                                   onkeydown="return (event.keyCode!=13)">
                            {{--<div id="livesearchname0" style="position:absolute;background-color:floralwhite;"></div>--}}

                        </th>
                        <th id="tedad0" class="form-control-static ">Count</th>
                        <th class="form-control-static" style="font-size:12px">Group</th>
                        <th class="form-control-static" style="font-size:11px">Rial</th>
                        <th class="thRemove form-control-static" style="color:red;width:13px;">X</th>
                        <th id="thRow" style="font-size: 20px">#</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    @include('sg.doc.sB')
                    </tbody>
                    <tr id="trFooter">
                        <td>
                            <a href="{{route('amm3.index')}}" style="text-decoration: none" tabindex="-1">
                                <input type="button" id="BtnIndex" class="form-control btn-primary" value="لیست"
                                       tabindex="-1"
                                       onclick="">

                            </a>
                        </td>
                        <td id="ProductRemain" style="font-family: Tahoma;font-size: 10px">
                        </td>
                        <td>
                            @role('admin')
                            <select id="stockCode" style="display: none">
                                <option value="30">30</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                            </select>
                            @endrole
                        </td>
                        <td id="tdCountSum"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td onclick="$('#stockCode').toggle()"></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
<script>

    function searchRepeatBarcode(v) {
        v = v.toLowerCase().trim();
        var arr0 = [];
        $('.trLast td#barcodebarcode0').each(function (ix, td) {//BAR Code is storing in arr0
            arr0.push(td.innerText.toLowerCase().trim());
        });
        var indx = arr0.indexOf(v);
        if (indx != (-1)) {// -1 for not exists
            var columnCount = $('.trLast:nth-child(' + (parseInt(indx) + 1) + ') td:eq(3) input');
            var countVal = columnCount.val();
            // console.log('countVal=> ' + parseInt(countVal));
            columnCount.val(++countVal);
            console.log('++countVal=>' + (countVal));
            $('#barcode0').val('');
            $(".trLast").css("background-color", '');
            $('tr:eq(' + (indx + 1) + ')').css('background-color', 'yellow');
            let firstRow = $('#tbody tr:first');
            $('tr:eq(' + (indx + 1) + ')').insertBefore(firstRow);
            countSum();
            return 'Successfully Added';
        }
        countSum();
        return 'not added';
    };

    function searchRepeatPartcode(v) {
        var arr0 = [];
        v = v.trim();
        // $('.trLast td:nth-child(2)').each(function (ix, td) {//Part Code is storing in arr0
        $('.trLast td.partcode0').each(function (ix, td) {//Part Code is storing in arr0
            arr0.push(td.innerText.toLowerCase().trim());
        });
        console.log(v);
        console.log(arr0);
        var indx = arr0.indexOf(v);//0 base index
        console.log(indx);
        if (indx != (-1)) {// -1 for not exists
            var columnCount = $('.trLast:nth-child(' + (parseInt(indx) + 1) + ') td:eq(3) input');
            var countVal = columnCount.val();
            columnCount.val(++countVal);
            console.log('++countVal=>' + (countVal));
            $(".trLast").css("background-color", '');
            let selectedRow = $('.trLast:eq(' + (indx) + ')').css('background-color', 'yellow');
            let firstRow = $('#tbody tr:first');
            selectedRow.insertBefore(firstRow);
            countSum();
            return 'Successfully Added';
        }
        countSum();
        return 'not added';
    };

    function enterBarcode(val, id) {
        var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
        var v = $.trim(val);//space between don't remove;
        $('#barcode0').attr('disabled', 'disabled');
        if (searchRepeatBarcode(v) == 'Successfully Added') {
            $('.sound-player').remove();
            $.playSound("{{asset(url('media/repeat.mp3'))}}");
            $('#barcode0').removeAttr('disabled').focus().val();
            return;
        }
        $.ajax({
            url: '/amm3/searchBarcode',
            method: 'get',
            data: {e: v},
            success: function (res) {
                $('#barcode0').removeAttr('disabled').focus().val('');
                if (res[0] == '<') {
                    $(".trLast").css("background-color", '');
                }
                ;
                var el = $('#tbody tr:first');
                if (el.length) {
                    el.before(res);
                }
                else {
                    $("#tbody").append(res);
                }
                countSum();
                if (res[0] != '<') {// if not exist in db
                    $.playSound("{{asset(url('media/error.wav'))}}");
                    $.alert({
                        title: 'Barcode Not Found',
                        content: v,
                    });
                    return;
                }
                $.playSound("{{asset(url('media/newEntry.wav'))}}");
            },
            error: function (request, status, error) {
                $('#barcode0').removeAttr('disabled').focus().val('');
                alert(request.responseText);
            }
        });
    };

    $('#barcode0').keypress(function (e) {
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if (key == 13 && this.value != '') {
            $('#barcode0').attr('disabled', 'disabled');
            var i = this.id;
            var v = $.trim(this.value);//space between don't remove;
            $('#barcode0').val('');
            console.log(i + ' entry is =>' + v);
            if (searchRepeatBarcode(v) == 'Successfully Added') {
                $('.sound-player').remove();
                $.playSound("{{asset(url('media/repeat.mp3'))}}");
                $('#barcode0').removeAttr('disabled').focus().val('');
                return;
            }
            $.ajax({
                url: '/amm3/searchBarcode',
                method: 'get',
                data: {e: v},
                success: function (res) {
                    if (res[0] == '<') {// if res has value for insert in list
                        $(".trLast").css("background-color", '');
                    }
                    ;
                    $('#barcode0').removeAttr('disabled').focus().val('');
                    var el = $('#tbody tr:first');
                    if (el.length) {
                        el.before(res);
                    }
                    else {
                        $("#tbody").append(res);
                    }
                    countSum();
                    if (res[0] != '<') {// if not exist in view
                        $.playSound("{{asset(url('media/error.wav'))}}");
                        $.alert({
                            title: 'Barcode Not Found',
                            content: v,
                        });
                        return;
                    }
                    $.playSound("{{asset(url('media/newEntry.wav'))}}");
                },
                error: function (request, status, error) {
                    $('#barcode0').removeAttr('disabled').focus().val('');
                    alert(request.responseText);
                }
            });
        }
    });

    function showRemain(p) {
        @role('admin')
        var stock = $('#stockCode').find(":selected").text();
        // var stock = $('#stockCode').val();
        $('#ProductRemain').text('');
        $.ajax({
            url: '/amm3/ShowRemain',
            method: 'get',
            data: {p: p, stock: stock},
            success: function (res) {
                // console.log(res);
                // console.log(p + ' remain=>' + parseInt(res[0]['remain']));
                // $('#ProductRemain').text(parseInt(res[0]['remain']));
                // console.log(p + ' remain=>' + parseInt(res[0][""]));
                // forEach(res as r){
                //
                // }
                // $('#ProductRemain').html(res[0]["title"] + ':' + res[0]['VALUE']);
                // console.log(res[0]['title'] + ':' + res[0]['VALUE']);

                // console.log(res[0]);
                $('#ProductRemain').html(p + ' ' + '<span style="color:red" >' + parseInt(res[0][""]) + '</span>');
            },
            error: function (request, status, error) {
                console.log(p + '=>' + error);
            }
        });
        @endif
    }

    function countSum() {
        var sumCount = $('#trFooter #tdCountSum');
        var ss = 0;
        $('.trLast td.tedad .inpTedad').each(function (i, inp) {
            ss += parseInt(inp.value);
            sumCount.text(ss);
            radif();
        });
    }

    function rmv(td) {
        //if (confirm('Are You Sure?Delete row = ' + $(td).next().text())) {

        $.confirm({
            escapeKey: 'cancel',
            title: 'DELETE!',
            content: '? Are You Sure To Delete row = ' + $(td).next().text(),
            type: 'red',
            draggable: true,
            animationSpeed: 2,
            animation: 'scaleX',
            closeAnimation: 'scaleX',
            backgroundDismissAnimation: 'glow',
            buttons: {
                confirm: {
                    text: 'Delete Item',
                    btnClass: 'btn-red',
                    action: function () {
                        var r = $(td).parent('tr:first');
                        console.log('removing done: ' + r.html());
                        $('#barcode0').focus();
                        r.remove();
                        radif();
                        countSum();
                    },
                },
                cancel: function () {
                    return;
                }
            }
        });
    };

    function radif() {
        $('.trLast td.radif').each(function (i, td) {
            td.innerText = i + 1;
        })
    }

    function postArray() {
        var pArr = Array();
        $('.trLast td').each(function (i, td) {
            if (td.lastElementChild && td.lastElementChild.localName == "input") {
                // console.log(td.lastElementChild.value);
                pArr.push(td.lastElementChild.value)//push input value of count in array
            } else
                pArr.push(td.innerText);
        });
        console.log('Posting Array=>' + pArr);
        // $.alert({
        //     title: 'Alert!',
        //     content: pArr,
        // });
        return pArr;
    }

    function iterateCheckPartcode() {
        var arr0 = [];
        // $('.trLast td:nth-child(1)').each(function (i, p) {
        $('.trLast td:nth-child(2)').each(function (i, p) {
            arr0.push(p.innerText);
        })
        // console.log(arr0);
        var valuesSoFar = [];
        for (var i = 0; i < arr0.length; ++i) {
            var value = arr0[i];
            if (valuesSoFar.indexOf(value) !== -1) {
                // return alert('partcode=>' + value + ' is iterative.Check Your List Again');
                return $.alert({
                    title: 'ردیف تکراری',
                    content: 'partcode=>' + value + ' ردیف تکراری!',
                });
            }
            valuesSoFar.push(value);
        }
        return 'ok';
    }
</script>
</body>
</html>

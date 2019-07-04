<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>بررسی حواله</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>

</head>
<style>
    body {
        background-color: #e6f1ff;
        margin: 0;
        padding: 0;
        font-family: amm, Tahoma;
        /*font-size: medium;*/
        tabindex: "-1";

    }

    @media only screen and (max-width: 900px) {
        body {

            font-size: 2.3vw !important;
            /*margin-top: 2% !important;*/
        }
    }

    input[type='checkbox'] {
        -webkit-appearance: none;
        width: 20px;
        height: 20px;
        background: white;
        border-radius: 3px;
        border: 1px solid #555;
    }

    input[type='checkbox']:checked {
        background: #dc3545;
    }

    #loading2 {
        /*background: url("/img/background/loading/bar.gif") no-repeat center center;*/
        background: url(<?php echo e(URL('/')); ?>/img/background/loading/800.svg) no-repeat center center;
        background-color: rgba(0, 0, 0, 0.7);
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 100%;
        z-index: 9999999;
    }
</style>
<script>
    function GetDocContents() {
        $('#loading2').show(10);
        let docno = $('#inpDocNo').val();
        let branch = $('#branch').text();
        console.log(docno + ' ' + branch);
        var request = $.ajax({
            url: "/drafts/getDraft2",
            method: "get",
            data: {branch: branch, docno: docno},
        });

        request.done(function (res) {
            $('#tbody').html(res);
            $('#loading2').hide(10);
            // $("#log").html(msg);
            checkCntConflict();
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
            $('#loading2').hide(10);
        });
    }

    function saveCount(a, b, c, d, e) {
        console.log(a, b, c, d, e);
        $('#loading2').show(10);
        var request = $.ajax({
            url: "/drafts/saveDraftCounted",
            method: "get",
            data: {vchnum: a, partcode: b, cnt: c, stockRef: d, opStockRef: e},
        });

        request.done(function (res) {
            alert(res);
            $('#loading2').hide(10);
            $('tr').css('background-color','');
            checkCntConflict();
        });

        request.fail(function (jqXHR, textStatus) {
            $('#loading2').hide(10);
            alert(textStatus);
            alert('Error');
            alert('Error');
        });
    }

    function checkCntConflict() {
        $('#trBody #cntValue').each(function (i, inp) {
            let qty = $(inp).parent().parent().children('td#qtyValue').text().trim();
            // console.log($(inp).parent().find('#qtyValue'));
            // console.log('inputValue='+inp.value + ' and qty=' + qty);
            if (parseInt(qty.trim()) != parseInt(inp.value)) {
                $(inp).parent().parent().css('background-color', '#d4e69a');
            }
            ;
        });
    }

    function SavePlace(partref, partcode, partname, opStockRef, shelf, barcode) {
        // let stockid = $('#stockid').text();
        // console.log('opStockRef=' + opStockRef);
        console.log(partref, partcode, partname, opStockRef, shelf, barcode);
        // return;
        $.ajax({
            method: 'get',
            url: '/placement/UpdateShelfFromDraft',
            data: {
                partref: partref,
                partcode: partcode,
                partname: partname,
                opStockRef: opStockRef,
                shelf: shelf,
                barcode: barcode
            },
            success: function (res) {
                if (res == 'error') {
                    alert('عدد وارد شده اشتباه است!');
                    alert('عدد وارد شده اشتباه است!');
                    alert('عدد وارد شده اشتباه است!');
                    return false;

                }
                $('input').removeAttr('disabled');
                alert(res);
                $('#partcode0').focus();
                // alert(partcode + 'جانمایی شد.');
            },
            error: function (xhr, ajaxOptions, thrownError) {
                $('input').removeAttr('disabled');
                alert(xhr.responseText);
                // alert(thrownError);
                alert('در ذخیره سازی خطایی رخ داده است.');
                // alert('در ذخیره سازی خطایی رخ داده است.');
                $('#partcode0').focus();
            }
        })
    }

</script>
<body>
{{--<form action="">--}}
<div id="container">
    <div id="loading2" style="display: none;"></div>
    <div id="tableDiv">
        <div style="float: right;margin:7px;">
            {{--@if(isset($lastDocs))--}}
            {{--<select name="LastDocs" id="">--}}
            {{--@foreach($lastDocs as $l)--}}
            {{--<option value="">--}}
            {{--{{$l->vchnum}}--}}
            {{--</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--@endif--}}
            @hasanyrole('user')
            <span style=";color: #505235;font-size: 1.6vw"> شعبه<span id="branch">{{($branch)}}</span> </span>
            <label for="inpDocNo">شماره سند: </label>
            <input id="inpDocNo" type="number" min="1" class="  input_number input-group-sm input-sm">
            <input type="button" onclick="GetDocContents()" class="btn btn-primary btn-sm" value="Get">
            @endhasanyrole()

        </div>
        <table class="table-bordered table-striped table table-responsive table-sm table-hover">
            <thead>
            <tr id="trHead" style="text-align: center">
                <td></td>
                <td>شماره سند</td>
                <td></td>
                <td>کد کالا</td>
                <td>نام کالا</td>
                <td>گروه کالا</td>
                <td>قیمت</td>
                <td style="text-align: center">تعداد</td>
                <td style="text-align: center">ذخیره</td>
                <td>#</td>
                <td>تاریخ سند</td>
                <td>انبار مبدا</td>
                <td>انبار مقصد</td>
                <td>شماره قفسه</td>
                {{--<td>تغییر شماره جدید</td>--}}
                <td></td>

            </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
        </table>
    </div>
</div>
{{--</form>--}}
</body>
</html>
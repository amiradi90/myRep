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
</style>
<script>
    function GetDocContents() {
        let docno = $('#inpDocNo').val();
        let branch = $('#branch').text();
        console.log(docno + ' ' + branch);
        var request = $.ajax({
            url: "/drafts/getDraft",
            method: "get",
            data: {branch: branch, docno: docno},
        });
        // }


        request.done(function (res) {
            $('#tbody').html(res);
            // $("#log").html(msg);
        });

        request.fail(function (jqXHR, textStatus) {
            alert("Request failed: " + textStatus);
        });
    }

</script>
<body>
{{--<form action="">--}}
<div id="container">
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
            <span style=";color: #505235;font-size: 1.6vw"> شعبه<span id="branch">{{($branch)}}</span> </span>
            <label for="inpDocNo">شماره سند: </label>
            <input id="inpDocNo" type="number" min="1" class="  input_number input-group-sm input-sm">
            <input type="button" onclick="GetDocContents()" class="btn btn-primary btn-sm" value="Get">

        </div>
        <table class="table-bordered table-striped table table-responsive table-sm table-hover">
            <thead>
            <tr id="trHead">
                <td></td>
                <td>شماره سند</td>
                <td></td>
                <td>کد کالا</td>
                <td>نام کالا</td>
                <td>گروه کالا</td>
                <td>قیمت</td>
                <td>تعداد</td>
                <td>تاریخ سند</td>
                <td>انبار مبدا</td>
                <td>انبار مقصد</td>

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
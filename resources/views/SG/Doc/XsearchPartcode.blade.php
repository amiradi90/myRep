{{--<!doctype html>--}}
{{--<html lang="en" dir="rtl">--}}
{{--<head>--}}
    {{--<meta charset="UTF-8">--}}
    {{--<meta name="viewport"--}}
          {{--content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="ie=edge">--}}
    {{--<title>Document</title>--}}

    {{--<script src="{{asset(url('js/jquery.min.js'))}}"></script>--}}
    {{--<link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>--}}
    {{--<link rel="stylesheet" href={{asset(url('css/select2.min.css'))}}/>--}}

    {{--<script src='{{asset(url('js/select2.min.js'))}}'></script>--}}
    {{--<script src='{{asset(url('js/jquery.playSound.js'))}}'></script>--}}

    {{--<script>--}}

        {{--$(document).ready(function () {--}}

        {{--});--}}

        function addPartcode(t) {
            var v = $.trim(t);//space between don't remove;--}}
            console.log('selected Partcode=>' + v);
            document.getElementById("livesearch").innerHTML = "";
            $('#partcode0').val('');
            $.ajax({
                method: 'get',
                url: 'amm3/selectPartcode',
                data: {q: v},
                success: function (res) {
                    console.log(res);
                    $("#tbody").append(res);
                    // $('#livesearch').html('');
                },
                // error: function (e) {
                //     alert(e);
                // }
            })
        };

        function showResult(str) {
            // console.log(str);
            if (str.length == 0) {
                document.getElementById("livesearch").innerHTML = "";
                document.getElementById("livesearch").style.border = "0px";
                // document.getElementById("divPs").innerHTML = "";
                return;
            }

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
                    document.getElementById("livesearch").innerHTML = this.responseText;
                    document.getElementById("livesearch").style.border = "1px solid #A5ACB2";
                }
            }
            xmlhttp.open("GET", "/amm3/searchPartcode?q=" + str, true);
            xmlhttp.send();
            // }
        }

        // $('.classPart').click(function (e) {
        //     e.preventDefault();
        //     $.ajax({
        //         method: 'get',
        //         url: 'amm3/searchBarcode',
        //         data: {e: '1234100017'},
        //         success: function (res) {
        //             $("#tbody").append(res);
        //         }
        //     })
        // });

        // $('.classPart').attr('href','localhost/amm3/searchBarcode?e=12');

    </script>
    <script>
        var _timer = 0;

        function DelayedShowResult(str) {
            if (_timer)
                window.clearTimeout(_timer);
            _timer = window.setTimeout(function () {
                if (str.length == 0) {
                    document.getElementById("livesearch").innerHTML = "";
                    document.getElementById("livesearch").style.border = "0px";
                }
                if (str.length > 3)
                    showResult(str);
            }, 500);
        }
    </script>

    <style>
        body {
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
            font-size: 14px;
            line-height: 1.8;
            font-weight: revert;
        }

        #content1 {
            text-align: center;
            color: #1f6fb2;
        }

        #tbldiv {
            display: inline-block;
            margin: 10px auto;
        }

        .name0 {
            max-width: 300px;
            font-size: 13px;
        }

        #partcode0, #barcode0 {
            min-width: 190px;
            max-width: 200px;
        }

        #trFooter {
            background-color: mistyrose;
            font-family: "Arial Black", arial-black;
        }

        #btnSubmit {
            background-color: royalblue;
        }

        #divPs {
            margin: 0;
            padding: 0;
            text-align: right;
            /*height: 800px;*/
            /*width: 500px;*/
            overflow-y: scroll;
        }

        .divPartPrice {
            max-width: 300px;
        }
    </style>

</head>
{{--<body onkeydown="return (event.keyCode != 116)">--}}
<body onkeydown="">
<div id="content1">
    <form method="post" class="" autocomplete="off">
        @method('post')
        @csrf
        {{--<input type="hidden" name="arr[]" id="hidInput" value="">--}}
        <span>{{ \Carbon\Carbon::now('iran')}}</span>
        <div class="row">
            <div id="tbldiv" class="">
                <h3>register System</h3>
                {{--<input type="button" id="btnSubmit" class="form-control btn-primary" value="Save"--}}
                {{--onclick="funcSubmit()">--}}

                <table id="tblMain" class="table-bordered table-striped table-hover table-responsive ">
                    <thead>
                    <tr style="">
                        <th><input id="barcode0" onfocusout="function keyPressListener(e) {if (e.keyCode == 13){}}"
                                   accesskey="x" class="form-control form-control-lg" type="text"
                                   placeholder="barcode"></th>
                        {{--<th class="col-2"></th>--}}
                        <th>
                            {{--<input id="partcode0" class="form-control form-control-lg" type="text"--}}
                            {{--placeholder="کد کالا" autofocus autocomplete="off">--}}
                            <input class="form-control form-control-lg" type="text" id="partcode0" autofocus
                                   onkeyup="DelayedShowResult(this.value);"
                                   {{--onkeyup="showResult(this.value)"--}}
                                   onkeydown="return (event.keyCode != 13)"
                                   placeholder="کد کالا">
                            <div id="livesearch" style="position:absolute;
                            ;background-color:floralwhite;"></div>
                        </th>
                        <th><input id="name0" class="form-control form-control-lg" type="text" placeholder="نام">
                        </th>
                        <th id="tedad0" class="form-control-static">Count</th>
                        <th class="form-control-static">Group</th>
                        <th class="form-control-static" style="font-size:11px">Price</th>
                        <th class="form-control-static" style="color:red;width:13px;font-size: 11px;">Delete</th>
                        <th id="thRow" style="font-size: 11px">Row</th>
                    </tr>
                    </thead>
                    <tbody id="tbody">

                    </tbody>
                    <tr id="trFooter">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td id="tdCountSum">0</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>
<script>
    {{--$('#partcode0').keypress(function (e) {--}}
    {{--if (e.keyCode == 13 && this.value != '') {--}}
    {{--var i = this.id;--}}
    {{--var v = $.trim(this.value);//space between don't remove;--}}
    {{--console.log(i + ' entry is =>' + v);--}}
    {{--// iterateCheckPartcode();//check for duplicate partcode--}}
    {{--$.ajax({--}}
    {{--url: '/amm3/searchPartcode',--}}
    {{--method: 'get',--}}
    {{--data: {q: v},--}}
    {{--success: function (res) {--}}
    {{--$(".trLast").css("background-color", '');--}}
    {{--$('#partcode0').val('');--}}
    {{--var el = $('#tbody tr:first');--}}
    {{--if (el.length) {--}}
    {{--el.before(res);--}}
    {{--}--}}
    {{--else {--}}
    {{--$("#tbody").append(res);--}}
    {{--}--}}
    {{--// countSum();--}}
    {{--if (res.search('<tr') == -1) {// if not exist in db--}}
    {{--$.playSound("{{asset(url('media/error.wav'))}}");--}}
    {{--return;--}}
    {{--}--}}
    {{--// HidInputChangeArray();--}}
    {{--$.playSound("{{asset(url('media/newEntry.wav'))}}");--}}
    {{--},--}}
    {{--error: function (request, status, error) {--}}
    {{--alert(request.responseText);--}}
    {{--}--}}
    {{--});--}}
    {{--}--}}
    {{--});--}}

</script>
</body>
</html>

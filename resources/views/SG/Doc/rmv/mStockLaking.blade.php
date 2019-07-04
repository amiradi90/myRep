<!doctype html>
<html lang="en" dir="rtl">
<head>

    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Mobile StockLacking Document</title>

    <script>
        var host = "serratus.github.io";
        if ((host == window.location.host) && (window.location.protocol != "https:")) {
            window.location.protocol = "https";
        }
    </script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

        ga('create', 'UA-56318310-1', 'auto');
        ga('send', 'pageview');

    </script>


    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>

    <script src='{{asset(url('js/jquery.playSound.js'))}}'></script>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>

    <script>
        $(document).ready(function () {
            $('#barcode0,#partcode0,#name0').focus(function () {
                $('#livesearchpartcode0').trigger('focusout');
                $('#livesearchname0').trigger('focusout');
                // $('.inpTedad').inputFilter(function (value) {
                //     return /^-?\d*$/.test(value);
                // });

            });

            $("#livesearchpartcode0").on("focusout", function (e) {
                document.getElementById("livesearchpartcode0").innerHTML = "";
                document.getElementById("livesearchname0").innerHTML = "";
                $('#partcode0').val('');
                $('#name0').val('');
                // console.log(e.type, 'on #livesearch');
            });


        });

        function funcSubmit() {
            $('.sound-player').remove();

            if (iterateCheckPartcode() != 'ok') {
                alert('Iterate Happened');
                return;
            }
            // if (confirm('سند ذخیره شود؟')) {
            $.confirm({
                title: '!SAVE',
                content: 'سند ذخیره شود؟',
                type: 'green',
                typeAnimated: true,
                buttons: {
                    confirm: {
                        text: 'بله',
                        btnClass: 'btn-green',
                        direction: 'ltr',
                        action: function () {
                            if ($('#tbody tr').length > 0) {
                                var list = postArray();
                                $.ajax({
                                    url: '/amm3',
                                    method: 'post',
                                    data: {
                                        data: list, "_token": "{{ csrf_token() }}"
                                    },
                                    success: function (res) {
                                        $('#btnSubmit').removeClass('btn-primary').attr({
                                            "disabled": "disabled",
                                            'value': 'Successfully Saved'
                                        }).css('background-color', '#2a9055');
                                        $("input").attr('disabled', 'disabled');
                                        $('td.rmv,.thRemove').hide();
                                        $('#documentId').text('Document ID: ' + res).css('background-color', '#2a9055');
                                        console.log(res);
                                    },
                                    error: function (request, status, error) {
                                        alert(request.responseText);
                                    }
                                });
                                // $('form').submit();
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

    </script>
    <script>
        var _timer = 0;

        function DelayedShowResult(str, id) {
            // console.log(id+ str +'** length=>'+str.length)
            if (_timer)
                window.clearTimeout(_timer);
            _timer = window.setTimeout(function () {
                if (str.length == 0) {
                    document.getElementById("livesearch" + id).innerHTML = "";
                    document.getElementById("livesearch" + id).style.border = "0px";
                }
                if (str.length > 3)
                    showResult(str, id);
            }, 600);
        }

        function showResult(str, id) {
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

        function addPartcode(t) {
            var v = $.trim(t);//space between don't remove;--}}
            console.log('selected Partcode=>' + v);
            if (searchRepeatPartcode(v) == 'Successfully Added') {//search in PARTCODE of list
                // document.getElementById("livesearchpartcode0").innerHTML = "";
                $('#livesearchpartcode0').html('');

                // document.getElementById("livesearchname0").innerHTML = "";
                $('#livesearchname0').html('');

                document.getElementById("partcode0").value = "";
                // $('#partcode0').val('');

                document.getElementById("name0").value = "";
                // $('#name0').val('');


                $('.sound-player').remove();
                $.playSound("{{asset(url('media/repeat.mp3'))}}");
                return;
            }
            document.getElementById("livesearchpartcode0").innerHTML = "";
            document.getElementById("livesearchname0").innerHTML = "";
            document.getElementById("name0").value = "";

            $('#partcode0').val('');
            $.ajax({
                method: 'get',
                url: '/amm3/selectPartcode',
                data: {q: v},
                success: function (res) {
                    // console.log(res);

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


                    // $("#tbody").append(res);
                    countSum();
                    // $('#livesearch').html('');
                },
                // error: function (e) {
                //     alert(e);
                // }
            })
        };

        function addName(t) {
        };

        // $('#name0').focusout().delay(500);
    </script>

    <style>

        body {
            /*background-repeat: repeat;*/
            background-color: whitesmoke;
            margin: 0;
            padding: 20px;
            line-height: 1.8;
            font-size: 13px;
            width: 100%;
            /*font-weight: bolder;*/
        }

        #content1 {
            text-align: center;
            color: #000000;
        }

        #tbldiv {
            /*padding-right: 5px;*/
            display: inline-block;
            margin: 10px auto;
        }

        #barcode0 {
            max-width: 250px;
            height: 47px;
            /*padding: 0 20px 0 0;*/
            margin: 0;
        }

        td.barcode0 {
            /*padding-right: 20px;*/
        }

        td.name0 {
            max-width: 400px;
            font-size: 12px;
        }

        td.partcode0, td.barcode0 {
            /*min-width: 190px;*/
            max-width: 120px;
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

        .name0Focus {
        'min-width': '200px',
        'position': 'relative'
        }

        /*#name0:focus, #livesearchname0:focus {*/
        /*position: relative;*/
        /*min-width: 200px;*/
        /*}*/

        .jconfirm-content {
            /*float: right;*/
        }

        .tdCnt, .grp0, .price0 {
            margin: 0;
            padding: 0;
            font-size: 12px;
            max-width: 60px;
        }

        .tedad {
            padding: 0;
        }

        .inpTedad {
            max-width: 50px;
            padding-top: 4px;
            padding-bottom: 4px;
            height: 100%;
        }
    </style>

</head>
{{--<body onkeydown="return (event.keyCode != 116)">--}}
{{--<body onkeydown="" background="img/background/i2.jpg" )>--}}
<body onkeydown="" )>
<div id="content1">
    <form method="post" class="" autocomplete="off">
        @method('post')
        @csrf
        <span id="documentId"></span>
        {{--<div id="scanner" style="margin: 0 auto;border: 1px solid black;padding: 0;">--}}
        <div id="scanner" style="">
            <div>
                {{--<span id="insertCode">1</span>--}}
            </div>
            <div id="interactive" class="viewport"></div>
            <section>
                {{--<section id="container" class="container" style="max-height:500px">--}}
                <section id="container" class="container" style="">

                    {{--<div class="controls" style="max-height:100%;overflow: scroll">--}}
                    <div class="controls" style="">
                        {{--<fieldset class="input-group">--}}
                        {{--<button class="stop">Stop</button>--}}
                        {{--</fieldset>--}}
                        <fieldset class="reader-config-group">
                            <label>
                                <span>Barcode-Type</span>
                                <select name="decoder_readers">
                                    <option value="code_128" >Code 128</option>
                                    {{--<option value="code_39">Code 39</option>--}}
                                    {{--<option value="code_39_vin">Code 39 VIN</option>--}}
                                    <option value="ean" selected="selected">EAN</option>
                                    <option value="ean_extended">EAN-extended</option>
                                    <option value="ean_8">EAN-8</option>
                                    {{--<option value="upc">UPC</option>--}}
                                    {{--<option value="upc_e">UPC-E</option>--}}
                                    {{--<option value="codabar">Codabar</option>--}}
                                    {{--<option value="i2of5">I2of5</option>--}}
                                    {{--<option value="2of5">Standard 2 of 5</option>--}}
                                    {{--<option value="code_93">Code 93</option>--}}
                                </select>
                            </label>
                            <label>
                                <span>Resolution (long side)</span>
                                <select name="input-stream_constraints">
                                    <option value="320x240">320px</option>
                                    <option selected="selected" value="640x480">640px</option>
                                    <option  value="800x600">800px</option>
                                    <option value="1280x720">1280px</option>
                                    <option value="1600x960">1600px</option>
                                    <option value="1920x1080">1920px</option>
                                </select>
                            </label>
                            <label>
                                <span>Patch-Size</span>
                                <select name="locator_patch-size">
                                    <option value="x-small">x-small</option>
                                    <option value="small">small</option>
                                    <option selected="selected" value="medium">medium</option>
                                    <option value="large">large</option>
                                    <option value="x-large">x-large</option>
                                </select>
                            </label>
                            <label>
                                <span>Half-Sample</span>
                                <input type="checkbox" checked="checked" name="locator_half-sample"/>
                            </label>
                            <label>
                                <span>Workers</span>
                                <select name="numOfWorkers">
                                    <option value="0" selected="selected">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option  value="4">4</option>
                                    <option value="8">8</option>
                                </select>
                            </label>
                            <label>
                                <span>Camera</span>
                                <select name="input-stream_constraints" id="deviceSelection">
                                </select>
                            </label>
                            <label style="">
                                <span>Zoom</span>
                                <select name="settings_zoom"></select>
                            </label>
                            <label style="">
                                <span>Torch</span>
                                <input type="checkbox" name="settings_torch"/>
                            </label>
                        </fieldset>
                    </div>
                    {{--<div id="result_strip">--}}
                    {{--<ul class="thumbnails"></ul>--}}
                    {{--</div>--}}

                </section>

                {{--<script src="{{asset(url('js/jquery.min.js'))}}"></script>--}}
                {{--<script src="{{asset(url('js/barcode/quagga/adapter-latest.js'))}}" type="text/javascript"></script>--}}
                {{--<script src='{{asset(url('js/barcode/quagga/quagga.min.js'))}}'></script>--}}
                {{--<script src='{{asset(url('js/barcode/quagga/live_w_locator.js'))}}'></script>--}}
            </section>
        </div>
        <div style="clear: both;"></div>
        <div class="row">

            <div id="tbldiv" class="">
                <div style="">

                    <input class="btn" type="button" onclick="enterBarcode($('#barcode0').val(),'barcode0')"
                           style="float:right" value="barcode">
                    <span style=";margin-left: 20px">User: {{Auth::user()->name}}</span>
                    <input type="button" id="btnSubmit" class="form-control btn-primary" value="Save" tabindex="-1"
                           style=";float:left;display:inline-block;width: 150px;left: 100px"
                           onclick="funcSubmit()">
                </div>

                {{--<div id="scanner" style="width: 300px;height: 400px">--}}
                {{--<iframe src="{{url('test')}}" frameborder="1" style="width: 300px;height: 400px"></iframe>--}}
                {{--</div>--}}
                <table id="tblMain" class="table-bordered table-striped table-hover table-responsive ">
                    <thead class="thead-light">
                    <tr style="">
                        <th><input id="barcode0"
                                   class="form-control form-control-lg" type="text"
                                   autofocus accesskey="x"
                                   placeholder="barcode">
                        </th>
                        <th>
                            <input id="partcode0" class="form-control form-control-lg" type="text"
                                   onkeyup="DelayedShowResult(this.value,this.id);"
                                   onkeydown="  return (event.keyCode != 13)"
                                   placeholder="کد کالا">
                            <div id="livesearchpartcode0"
                                 style="position:absolute;background-color:floralwhite;"></div>
                        </th>
                        <th>
                            <input id="name0" class="form-control form-control-lg" type="text" placeholder="نام"
                                   onkeyup="DelayedShowResult(this.value,this.id) "
                                   onkeydown="return (event.keyCode!=13)">
                            <div id="livesearchname0" style="position:absolute;background-color:floralwhite;"></div>

                        </th>
                        <th id="tedad0" class="form-control-static">Count</th>
                        <th class="form-control-static" style="font-size:12px">Group</th>
                        <th class="form-control-static" style="font-size:11px">Rial</th>
                        <th class="thRemove form-control-static" style="color:red;width:13px;">X</th>
                        <th id="thRow" style="font-size: 20px">#</th>
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

    function searchRepeatBarcode(v) {
        var arr0 = [];
        $('.trLast td:nth-child(1)').each(function (ix, td) {//BAR Code is storing in arr0
            arr0.push(td.innerText);
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
            // HidInputChangeArray();
            countSum();
            return 'Successfully Added';
        }
        countSum();
        return 'not added';
    };

    function searchRepeatPartcode(v) {
        var arr0 = [];
        $('.trLast td:nth-child(2)').each(function (ix, td) {//BAR Code is storing in arr0
            arr0.push(td.innerText);
        });
        var indx = arr0.indexOf(v);//0 base index
        if (indx != (-1)) {// -1 for not exists
            var columnCount = $('.trLast:nth-child(' + (parseInt(indx) + 1) + ') td:eq(3) input');
            var countVal = columnCount.val();
            columnCount.val(++countVal);
            console.log('++countVal=>' + (countVal));
            $(".trLast").css("background-color", '');
            $('.trLast:eq(' + (indx) + ')').css('background-color', 'yellow');
            countSum();
            return 'Successfully Added';
        }
        countSum();
        return 'not added';
    };

    function enterBarcode(val, id) {
        alert(val);
        // alert(event.keyCode);
        // $('#barcode11').keypress(function (e) {
        // alert(e.keyCode);
        // var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
        // var key = event.keyCode;
        // if (key == 13 && val != '')
        var i = val;
        // var i = t.id;
        var v = $.trim(val);//space between don't remove;
        // var v = $.trim(t.value);//space between don't remove;
        // console.log(i + ' entry is =>' + v);
        // iterateCheckPartcode();//check for duplicate partcode
        if (searchRepeatBarcode(v) == 'Successfully Added') {
            // if (searchRepeatBarcode(v) == 'Successfully Added') {
            $('.sound-player').remove();
            // HidInputChangeArray();
            $.playSound("{{asset(url('media/repeat.mp3'))}}");
            return;
        }
        $.ajax({
            url: '/amm3/searchBarcode',
            method: 'get',
            data: {e: v},
            success: function (res) {
                // console.log('res=>' + res);
                $(".trLast").css("background-color", '');
                $('#barcode0').val('');
                var el = $('#tbody tr:first');
                if (el.length) {
                    el.before(res);
                }
                else {
                    $("#tbody").append(res);
                }
                countSum();
                if (res.search('<tr') == -1) {// if not exist in db
                    // HidInputChangeArray();
                    $.playSound("{{asset(url('media/error.wav'))}}");
                    return;
                }
                // HidInputChangeArray();
                $.playSound("{{asset(url('media/newEntry.wav'))}}");
            },
            error: function (request, status, error) {
                alert(request.responseText);
            }
        });
        // }
        // });
    };

    $('#barcode0').keypress(function (e) {
        // alert(e.keyCode);
        var key = e.charCode ? e.charCode : e.keyCode ? e.keyCode : 0;
        if (key == 13 && this.value != '') {
            var i = this.id;
            var v = $.trim(this.value);//space between don't remove;
            console.log(i + ' entry is =>' + v);
            // iterateCheckPartcode();//check for duplicate partcode
            if (searchRepeatBarcode(v) == 'Successfully Added') {
                // if (searchRepeatBarcode(v) == 'Successfully Added') {
                $('.sound-player').remove();
                // HidInputChangeArray();
                $.playSound("{{asset(url('media/repeat.mp3'))}}");
                return;
            }
            $.ajax({
                url: '/amm3/searchBarcode',
                method: 'get',
                data: {e: v},
                success: function (res) {
                    // console.log('res=>' + res);
                    $(".trLast").css("background-color", '');
                    $('#barcode0').val('');
                    var el = $('#tbody tr:first');
                    if (el.length) {
                        el.before(res);
                    }
                    else {
                        $("#tbody").append(res);
                    }
                    countSum();
                    if (res.search('<tr') == -1) {// if not exist in db
                        // HidInputChangeArray();
                        $.playSound("{{asset(url('media/error.wav'))}}");
                        return;
                    }
                    // HidInputChangeArray();
                    $.playSound("{{asset(url('media/newEntry.wav'))}}");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
            });
        }
    });

    function countSum() {
        var sumCount = $('#trFooter #tdCountSum');
        var ss = 0;
        $('.trLast td.tedad .inpTedad').each(function (i, inp) {
            ss += parseInt(inp.value);
            sumCount.text(ss);
            radif();
        });
    }
</script>
<script>
    // function rmv(td) {
    //     if (confirm('Are You Sure?Delete row = ' + $(td).next().text())) {
    //         var r = $(td).parent('tr:first');
    //         console.log('removing done: ' + r.html());
    //         r.remove();
    //         radif();
    //     }
    //     else return false;
    // };


    function rmv(td) {
        //if (confirm('Are You Sure?Delete row = ' + $(td).next().text())) {

        $.confirm({
            title: 'DELETE!',
            content: '? Are You Sure To Delete row = ' + $(td).next().text(),
            type: 'red',
            draggable: true,
            animationSpeed: 200,
            animation: 'scaleX',
            closeAnimation: 'scaleX',
            backgroundDismiss: false,
            backgroundDismissAnimation: 'glow',
            buttons: {
                confirm: {
                    text: 'Delete Item',
                    btnClass: 'btn-red',
                    action: function () {
                        var r = $(td).parent('tr:first');
                        console.log('removing done: ' + r.html());
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


        // var r = $(td).parent('tr:first');
        //     console.log('removing done: ' + r.html());
        //     r.remove();
        //     radif();
        //}
        //else return false;
    };

    function radif() {
        $('.trLast td.radif').each(function (i, td) {
            td.innerText = i + 1;
        })
    }

    function postArray() {
        var pArr = [];
        $('.trLast td').each(function (i, td) {
            // if (0) {
            if (td.lastElementChild && td.lastElementChild.localName == "input") {
                pArr.push(td.lastElementChild.value)//push input value of count in array
                // console.log(td.innerHTML);
            } else
                pArr.push(td.innerText);
            // pArr.push(this.eq(i).innerText);
        });
        console.log('Posting Array=>' + pArr);
        return pArr;
    };

    function iterateCheckPartcode() {
        var arr0 = [];
        $('.trLast td:nth-child(1)').each(function (i, p) {
            arr0.push(p.innerText);
        })
        // console.log(arr0);
        var valuesSoFar = [];
        for (var i = 0; i < arr0.length; ++i) {
            var value = arr0[i];
            if (valuesSoFar.indexOf(value) !== -1) {
                return alert('partcode=>' + value + ' is iterative.Check Your List Again');
            }
            valuesSoFar.push(value);
        }
        return 'ok';
    }
</script>
</body>
</html>
<script>

    // $('.pagination a').on('click', function (e) {
    //     console.log('link clicked');
    //     e.preventDefault();
    //     // var url = $(this).attr('href');
    //     // $.get(url, function (data) {
    //     //     $('#tblSP').html(data);
    //     // });
    // });

    // $('.pagination a').on('click', function (e) {
    //     console.log('link clicked');
    //     e.preventDefault();
    //     var url = $(this).attr('href');
    //     $.get(url, function (data) {
    //         $('#divPs').html(data);
    //     });
    // });

    // select2
    {{--function disableF5(e) {--}}
    {{--if (( e.keyCode) == 116) e.preventDefault();--}}
    {{--};--}}
    {{--$(document).on("keydown", disableF5);--}}

    // $('#hidInput').val(JSON.stringify(array1));//save array1 on hidden input
    // var rows = $('.trLast').length;
    // $('#cnt').text(rows);//save count of row in #cnt span
    // $.each(array1, function (i, value) {
    // });
    //}

    // function HidInputChangeArray() {
    //     var array1 = [];
    //     $('.trLast td:nth-child(4)').each(function (i, td) {
    //         array1.push(td.lastElementChild.localName);
    //     });
    //     console.log(array1);
    //     // $('#hidInput').val(array1);
    // }


    $('#barcode0').on('focusin', function () {
        // $('#scanner').css('display', 'block');
        // Quagga.start();
        $('#barcode0').css({
            'min-width': '200px',
            'position': 'relative'
        });
    });
    $('#barcode0').on('focusout', function () {
        setTimeout(function () {
            $('#barcode0').removeAttr('style');
        }, 400)
    });

    $('#name0').on('focusin', function () {
        $('#name0').css({
            'min-width': '200px',
            'position': 'relative'
        });
    });
    $('#name0').on('focusout', function () {
        setTimeout(function () {
            $('#name0').removeAttr('style');
        }, 400)
    });
    $('#partcode0').on('focusin', function () {
        setTimeout(function () {
            $('#partcode0').css({
                'min-width': '200px',
                'position': 'static'
            });
        }, 400);

    });
    $('#partcode0').on('focusout', function () {
        setTimeout(function () {
            $('#partcode0').removeAttr('style');
        }, 400)
    });


    $('#barcode0').on('click', function () {
        $('#scanner').css('display', 'block');
        // App.attachListeners();
        // App.checkCapabilities();
        Quagga.start();
        var track = Quagga.CameraAccess.getActiveTrack();

    });
</script>

<script src="{{asset(url('js/barcode/quagga/adapter-latest.js'))}}" type="text/javascript"></script>
<script src='{{asset(url('js/barcode/quagga/quagga.min.js'))}}'></script>
<script src='{{asset(url('js/barcode/quagga/live_w_locator.js'))}}'></script>


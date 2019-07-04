<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>StockLacking Document</title>

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
            }, 400);
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
                xmlhttp.open("GET", "sgb/name?q=" + str, true);
                xmlhttp.send();
                return;
            }
            xmlhttp.open("GET", "/amm3/searchPartcode?q=" + str, true);
            xmlhttp.send();
        }

        function addPartcode(t) {
            var v = $.trim(t);//space between don't remove;--}}
            console.log('selected Partcode=>' + v);
            if (searchRepeatPartcode(v) == 'Successfully Added') {
                document.getElementById("livesearchpartcode0").innerHTML = "";
                document.getElementById("livesearchname0").innerHTML = "";
                document.getElementById("partcode0").value = "";
                document.getElementById("name0").value = "";
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
                    countSum();
                },

            })
        };

        function addName(t) {
        };

        // $('#name0').focusout().delay(500);
    </script>

    <style>
        body {
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
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
            display: inline-block;
            margin: 10px auto;
        }

        td.barcode0 {
            padding-right: 20px;
        }

        td.name0 {
            max-width: 400px;
            /*font-size: 14px;*/
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
    </style>

</head>
{{--<body onkeydown="return (event.keyCode != 116)">--}}
<body onkeydown="">
<div id="content1">
    <form method="post" class="" autocomplete="off">
        @method('post')
        @csrf
        <span id="documentId"></span>
        <div class="row">
            <div id="tbldiv" class="">
                <h2>Search In Bahook</h2>
                {{--<input type="button" id="btnSubmit" class="form-control btn-primary" value="Save" tabindex="-1"--}}
                {{--onclick="funcSubmit()">--}}

                <table id="tblMain" class="table-bordered table-striped table-hover table-responsive ">
                    <thead class="thead-light">
                    <tr style="">
                        <th><input id="barcode0"
                                   class="form-control form-control-lg" type="text"
                                   autofocus accesskey="x"
                                   placeholder="کـــــد محصول">
                        </th>
                        <th>
                            <input id="partcode0" class="form-control form-control-lg" type="text"
                                   onkeyup="DelayedShowResult(this.value,this.id);"
                                   onkeydown="  return (event.keyCode != 13)"
                                   placeholder="بارکـــــــد">
                            <div id="livesearchpartcode0"
                                 style="position:absolute;background-color:floralwhite;"></div>
                        </th>
                        <th>
                            <input id="name0" class="form-control form-control-lg" type="text" placeholder="نــــــام"
                                   onkeyup="DelayedShowResult(this.value,this.id) "
                                   onkeydown="return (event.keyCode!=13)">
                            <div id="livesearchname0" style="position:absolute;background-color:floralwhite;"></div>

                        </th>
                        {{--<th id="tedad0" class="form-control-static">#</th>--}}
                        {{--<th class="form-control-static">Group</th>--}}
                        {{--<th class="form-control-static" style="font-size:11px">Rial</th>--}}
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
                        {{--<td id="tdCountSum">0</td>--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        {{--<td></td>--}}
                        <td></td>
                    </tr>
                </table>
                <input class="btn" type="button" onclick="enterBarcode($('#barcode0').val(),'barcode0')">
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
        var indx = arr0.indexOf(v);
        if (indx != (-1)) {// -1 for not exists
            var columnCount = $('.trLast:nth-child(' + (parseInt(indx) + 1) + ') td:eq(3) input');
            var countVal = columnCount.val();
            // console.log('countVal=> ' + parseInt(countVal));
            columnCount.val(++countVal);
            console.log('++countVal=>' + (countVal));
            // $('#barcode0').val('');
            $(".trLast").css("background-color", '');
            // $('tr:eq(' + (indx + 1) + ')').css('background-color', 'yellow');
            $('.trLast:eq(' + (indx) + ')').css('background-color', 'yellow');
            // HidInputChangeArray();
            countSum();
            return 'Successfully Added';
        }
        countSum();
        return 'not added';
    };

    function enterBarcode(val, id) {
        // alert(event.keyCode);
        // $('#barcode11').keypress(function (e) {
        // alert(e.keyCode);
        var key = event.charCode ? event.charCode : event.keyCode ? event.keyCode : 0;
        // if (key == 13 && val != '') {
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
                url: '/sgb/barcode',
                method: 'get',
                data: {q: v},
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

    function rmv(td) {
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


    $('#name0').on('focusin', function () {
        $('#name0').css({
            'min-width': '200px',
            'position': 'relative'
        });
    });
    $('#name0').on('focusout', function () {
        setTimeout(function () {
            $('#name0').removeAttr('style');
        }, 100)
    });
    $('#partcode0').on('focusin', function () {
        setTimeout(function () {
            $('#partcode0').css({
                'min-width': '200px',
                'position': 'static'
            });
        }, 100);

    });
    $('#partcode0').on('focusout', function () {
        setTimeout(function () {
            $('#partcode0').removeAttr('style');
        }, 100)
    });

</script>

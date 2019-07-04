<!doctype html>
<html lang="en" xmlns="" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>

    <style>
        @font-face {
            font-family: amm;
            src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
        }

        body {
            background-color: #ffffd2;
            margin: 0;
            padding: 0;
            font-family: amm, Tahoma;
            /*font-size: medium;*/
            tabindex: "-1";
        }

        @media only screen and (max-width: 900px) {
            body, html {
                font-size: 2.3vw !important;
                /*margin-top: 2% !important;*/
            }

            body, html {
                font-size: 1em !important;
                /*margin-top: 2% !important;*/
            }

            /*.barcode0 {*/
            /*font-size: 2.1em !important;*/
            /*}*/
            /*.partcode0 {*/
            /*font-size: 2.6em !important;*/
            /*}*/
            #partcode0, #partname0, #barcode0 {
                width: 100px !important;
            }
        }

        .row {
            margin: 0;
            padding: 0;
        }

    </style>
    <script>
        var _timer = 0;

        function DelayedShowResult(str, id) {
            console.log(str + ' ' + id);
            // console.log(id+ str +'** length=>'+str.length)
            if (_timer)
                window.clearTimeout(_timer);
            _timer = window.setTimeout(function () {
                if (str.length == 0) {
                    // document.getElementById("livesearch" + id).innerHTML = "";
                    // document.getElementById("livesearch" + id).style.border = "0px";
                    $('livesearch' + id).html('').fadeOut(10);
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
            let stid = $('#stockid').text();
            console.log('stid=' + stid);
            if (id == 'name0') {
                xmlhttp.open("GET", "/placement/" + stid + "/searchPartname?q=" + str, true);
                xmlhttp.send();
                return;
            }
            xmlhttp.open("GET", "/placement/" + stid + "/searchPartcode?q=" + str, true);
            xmlhttp.send();
        }

        function searchRepeatPartcode(v) {
            var arr0 = [];
            v = v.toLowerCase().trim();
            $('.trLast td:nth-child(2)').each(function (ix, td) {//BAR Code is storing in arr0
                arr0.push(td.innerText.toLowerCase().trim());
            });
            var indx = arr0.indexOf(v);//0 base index
            if (indx != (-1)) {// -1 for not exists
                var columnCount = $('.trLast:nth-child(' + (parseInt(indx) + 1) + ') td:eq(3) input');
                var countVal = columnCount.val();
                columnCount.val(++countVal);
                console.log('++countVal=>' + (countVal));
                $(".trLast").css("background-color", '');
                let selectedRow = $('.trLast:eq(' + (indx) + ')').css('background-color', 'yellow');
                let firstRow = $('#tbody tr:first');
                selectedRow.insertBefore(firstRow);
                // countSum();
                return 'Successfully Added';
            }
            // countSum();
            return 'not added';
        };

        function addPartcode1(v, partref) {
            // var v = $.trim(t);//space between don't remove;--}}
            console.log('selected Partcode=>' + v);
            let stockid = $('#stockid').text();
            // $('input').attr('disabled', 'disabled');
            $('#livesearchpartcode0,#livesearchname0,#partcode0,#name0').val('').html('');
            if (searchRepeatPartcode(v) == 'Successfully Added') {//search in PARTCODE of list
                $('input').removeAttr('disabled');
                $('#partcode0').focus();
                return;
            }
            $.ajax({
                method: 'get',
                url: '/placement/selectPartcode',
                data: {q: v, partref: partref, stockid: stockid},
                success: function (res) {
                    // $('input').removeAttr('disabled');
                    $('#partcode0').focus();
                    var el = $('#tbody tr:first');
                    if (el.length) {
                        $('.trLast').css('background-color', '');
                        el.before(res);
                    }
                    else {
                        $('.trLast').css('background-color', '');
                        $("#tbody").append(res);
                    }
                    $('#barcode0').focus();
                    // countSum();
                },
                error: function (e) {
                    // $('input').removeAttr('disabled');
                    $('#partcode0').focus();
                    alert(e);
                }
            })
        };


        function SavePlace(partref, partcode, partname, stock, shelf, barcode) {
            let stockid = $('#stockid').text();
            console.log('stockid=' + stockid);
            console.log(partref, partcode, name, stock, shelf, barcode);
            // return;
            $.ajax({
                method: 'get',
                url: '/placement/UpdateShelf',
                data: {
                    partref: partref,
                    partcode: partcode,
                    partname: partname,
                    stockid: stockid,
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

</head>
<body>
@if(auth()->check() && auth()->user()->hasAnyRole('admin|b'.$stockid.'_members'))
    <div style="width: 100%;text-align: center;margin:0 auto;">

        <div>
            <h2>جانمایی شعبه <span style="color: red;" id="stockid">{{$stockid}}</span></h2>
        </div>

        <div style="display: inline-block">
            <table class="table-bordered  table-striped table-hover table-responsive header-fixed">
                <thead>
                <tr>
                    <th style="display: none">partref</th>
                    <th>barcode</th>
                    <th>partcode</th>
                    <th>name</th>
                    <th>جانمایی</th>
                    <th>save</th>
                    <th>grp</th>
                    <th>$</th>
                    <th style="color:red;">X</th>
                    <th>rowNumber</th>
                </tr>
                <tr>
                    <th>
                        <input type="text" id="barcode0" class="form-control form-control-lg" disabled="disabled">
                    </th>
                    <th>
                        <input type="text" id="partcode0" style="display: block;min-width:150px" autofocus
                               oninput="DelayedShowResult(this.value,this.id);"
                               class="form-control form-control-lg">
                    </th>
                    <th>
                        <input type="text" id="name0" class="form-control form-control-lg" style="min-width: 200px"
                               oninput="DelayedShowResult(this.value,this.id);">
                    </th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <th>
                        <div id="livesearchpartcode0" style="position:absolute;background-color:floralwhite;"></div>
                        <div id="livesearchname0" style="position:absolute;background-color:floralwhite;"></div>
                    </th>
                </tr>
                </thead>

                <tbody id="tbody">
                <tr>

                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endif
</body>
</html>
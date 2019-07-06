<!doctype html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>barcode Print</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <script src="{{asset(url('js/barcode/jquery-barcode.js'))}}"></script>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>
    <script src='{{asset(url('js/print/jquery.PrintArea.js'))}}'></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>
    <style>
        #barcodeTarget2 {
            zoom: 2;
            overflow: hidden !important;
        }

        @media print {
            #barcodeTarget2 {
                zoom: 2.3;
                overflow: hidden !important;
            }

            td, tr {
                border: 2px solid black !important;
            }

            #insPartname, #insPrice, #insCnt {
                zoom: 1.4;
            }

            th {
                text-align: center;
            }

            .example-screen {
                display: none;
                /*visibility: hidden;*/
            }

            .example-print {
                display: block;
            }
        }

        body {
            /*background-color: whitesmoke;*/
            padding: 0;
            font-size: larger;
            /*width: 500px;*/
            margin: 0;
            text-align: center;
            /*font-size: 25px;*/
            font-family: sg;
        }

        @font-face {
            font-family: exo;
            src: url({{url('/font/exo.woff2')}});

            font-family: sg;
            src: url({{url('/font/iranSans/woff/iransansweb.woff')}});

        }

        #insBarcode, #insPartname, #insPartcode, #insPrice, #insCnt {
            width: 60px;
            font-size: 15px;
            font-weight: bold;
        }

        #insRow {
            width: 20px;
        }

        #name0, thName0 {
            width: 100px;
        }

    </style>
    <script>
        // $(document).ready(function () {
        //     $("input[type='button']").click(function () {
        //         generateBarcode();
        //     });

        // function generateBarcode() {
        //     var value = $("#barcodeValue").val();
        //     var btype = $("input[name=btype]:checked").val();
        //     var renderer = $("input[name=renderer]:checked").val();
        //
        //     var quietZone = false;
        //     if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')) {
        //         quietZone = true;
        //     }
        //
        //     var settings = {
        //         output: renderer,
        //         bgColor: $("#bgColor").val(),
        //         color: $("#color").val(),
        //         barWidth: $("#barWidth").val(),
        //         barHeight: $("#barHeight").val(),
        //         moduleSize: $("#moduleSize").val(),
        //         posX: $("#posX").val(),
        //         posY: $("#posY").val(),
        //         addQuietZone: $("#quietZoneSize").val()
        //     };
        //     if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')) {
        //         value = {
        //             code: value,
        //             rect: true
        //         };
        //     }
        //     if (renderer == 'canvas') {
        //         clearCanvas();
        //         $("#barcodeTarget").hide();
        //         $("#canvasTarget").show().barcode(value, btype, settings);
        //     } else {
        //         $("#canvasTarget").hide();
        //         $("#barcodeTarget").html("").show().barcode(value, btype, settings);
        //     }
        // }

        // function showConfig1D() {
        //     $('.config .barcode1D').show();
        //     $('.config .barcode2D').hide();
        // }

        // function showConfig2D() {
        //     $('.config .barcode1D').hide();
        //     $('.config .barcode2D').show();
        // }

        // function clearCanvas() {
        //     var canvas = $('#canvasTarget').get(0);
        //     var ctx = canvas.getContext('2d');
        //     ctx.lineWidth = 1;
        //     ctx.lineCap = 'butt';
        //     ctx.fillStyle = '#FFFFFF';
        //     ctx.strokeStyle = '#000000';
        //     ctx.clearRect(0, 0, canvas.width, canvas.height);
        //     ctx.strokeRect(0, 0, canvas.width, canvas.height);
        // }

        // $(function () {
        //     $('input[name=btype]').click(function () {
        //         if ($(this).attr('id') == 'datamatrix') showConfig2D();
        //         else showConfig1D();
        //     });
        //     $('input[name=renderer]').click(function () {
        //         if ($(this).attr('id') == 'canvas') $('#miscCanvas').show();
        //         else $('#miscCanvas').hide();
        //     });
        //     generateBarcode();
        // });
        // });
    </script>
    <script>
        $(document).ready(function () {
            $("#printButton").click(function () {
                window.print();
                return;
                var mode = 'iframe'; //popup
                var close = mode == "popup";
                var options = {mode: mode, popClose: close};
                $("div.printableArea").printArea(options);
            });
        });

        function generateBarcode2(v) {
            // var value = $("#barcodeValue").val();
            var value = v;
            var btype = $("input[name=btype]:checked").val();
            var renderer = $("input[name=renderer]:checked").val();

            var quietZone = false;
            if ($("#quietzone").is(':checked') || $("#quietzone").attr('checked')) {
                quietZone = true;
            }

            var settings = {
                output: renderer,
                bgColor: $("#bgColor").val(),
                color: $("#color").val(),
                barWidth: $("#barWidth").val(),
                barHeight: $("#barHeight").val(),
                moduleSize: $("#moduleSize").val(),
                posX: $("#posX").val(),
                posY: $("#posY").val(),
                addQuietZone: $("#quietZoneSize").val()
            };
            if ($("#rectangular").is(':checked') || $("#rectangular").attr('checked')) {
                value = {
                    code: value,
                    rect: true
                };
            }
            if (renderer == 'canvas') {
                clearCanvas2();
                $("#barcodeTarget2").hide();
                $("#barcodeTarget2").show().barcode(value, btype, settings);
            } else {
                $("#canvasTarget2").hide();
                $("#barcodeTarget2").html("").show().barcode(value, btype, settings);
            }
        }

        function showConfig1D2() {
            $('.config .barcode1D').show();
            $('.config .barcode2D').hide();
        }

        function showConfig2D2() {
            $('.config .barcode1D').hide();
            $('.config .barcode2D').show();
        }

        function clearCanvas2() {
            var canvas = $('#canvasTarget').get(0);
            var ctx = canvas.getContext('2d');
            ctx.lineWidth = 1;
            ctx.lineCap = 'butt';
            ctx.fillStyle = '#FFFFFF';
            ctx.strokeStyle = '#000000';
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            ctx.strokeRect(0, 0, canvas.width, canvas.height);
        }

    </script>

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
                xmlhttp.open("GET", "/barcode/searchPartname?q=" + str, true);
                xmlhttp.send();
                return;
            }
            xmlhttp.open("GET", "/barcode/searchPartcode?q=" + str, true);
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
            // if (searchRepeatPartcode(v) == 'Successfully Added') {//search in PARTCODE of list
            //     $('input').removeAttr('disabled');
            //     $('#partcode0').focus();
            //     return;
            // }
            $.ajax({
                method: 'get',
                url: '/barcode/selectPartcode',
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
                    radif();
                    generateBarcode2(v);
                },
                error: function (e) {
                    // $('input').removeAttr('disabled');
                    $('#partcode0').focus();
                    alert(e);
                }
            })
        };

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

        function excelTemplate() {
            // $('#insBarcode,#rmv,#insPrice').remove().finish();
            fnExcelReport(event);
        }

        // function ClearVal(){
        //     $('#livesearchpartcode0,#livesearchname0,#partcode0').val('').html('');
        // }

    </script>

</head>
<body>
<div id="barcodeConfigArea" style="visibility: hidden;position: absolute;">
    <div id="generator">Please fill in the code :
        <input type="text" id="barcodeValue" value="12345670">
        <div id="submit">
            <input type="button" class="btn btn-primary"
                   value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Generate the barcode&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
        </div>
        <div id="config" style="visibility: hidden;position: absolute">
            <div class="config">
                <div>
                    {{--<div class="title">Type</div>--}}
                    {{--<input type="radio" name="btype" id="ean8" value="ean8" >--}}
                    {{--<label for="ean8">EAN 8</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="ean13" value="ean13">--}}
                    {{--<label for="ean13">EAN 13</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="upc" value="upc">--}}
                    {{--<label for="upc">UPC</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="std25" value="std25">--}}
                    {{--<label for="std25">standard 2 of 5 (industrial)</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="int25" value="int25">--}}
                    {{--<label for="int25">interleaved 2 of 5</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="code11" value="code11">--}}
                    {{--<label for="code11">code 11</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="code39" value="code39">--}}
                    {{--<label for="code39">code 39</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="code93" value="code93">--}}
                    {{--<label for="code93">code 93</label>--}}
                    <br/>
                    <input type="radio" name="btype" id="code128" value="code128" checked="checked">
                    <label for="code128">code 128</label>
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="codabar" value="codabar">--}}
                    {{--<label for="codabar">codabar</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="msi" value="msi">--}}
                    {{--<label for="msi">MSI</label>--}}
                    {{--<br/>--}}
                    {{--<input type="radio" name="btype" id="datamatrix" value="datamatrix">--}}
                    {{--<label for="datamatrix">Data Matrix</label>--}}
                    {{--<br/>--}}
                    {{--<br/>--}}
                </div>
            </div>

            <div class="config">
                <div class="title">Misc</div>
                Background :
                <input type="text" id="bgColor" value="#FFFFFF" size="7">
                <br/>"1" Bars :
                <input type="text" id="color" value="#000000" size="7">
                <br/>
                <div class="barcode1D">bar width:
                    <input type="text" id="barWidth" value="1" size="3">
                    <br/>bar height:
                    <input type="text" id="barHeight" value="40" size="3">
                    <br/>
                </div>
                <div class="barcode2D">Module Size:
                    <input type="text" id="moduleSize" value="5" size="3">
                    <br/>Quiet Zone Modules:
                    <input type="text" id="quietZoneSize" value="1" size="3">
                    <br/>Form:
                    <input type="checkbox" name="rectangular" id="rectangular">
                    <label for="rectangular">Rectangular</label>
                    <br/>
                </div>
                <div id="miscCanvas">x :
                    <input type="text" id="posX" value="10" size="3">
                    <br/>y :
                    <input type="text" id="posY" value="20" size="3">
                    <br/>
                </div>
            </div>
            <div class="config">
                <div class="title">Format</div>
                <input type="radio" id="css" name="renderer" value="css" checked="checked">
                <label for="css">CSS</label>
                <br/>
                <input type="radio" id="bmp" name="renderer" value="bmp">
                <label for="bmp">BMP (not usable in IE)</label>
                <br/>
                <input type="radio" id="svg" name="renderer" value="svg">
                <label for="svg">SVG (not usable in IE)</label>
                <br/>
                <input type="radio" id="canvas" name="renderer" value="canvas">
                <label for="canvas">Canvas (not usable in IE)</label>
                <br/>
            </div>
        </div>

    </div>
    <div id="barcodeTarget" class="barcodeTarget"></div>
    <canvas id="canvasTarget" width="200" max-height="50"></canvas>

</div>

<div style=";text-align: right;margin: 5px; ;">
    <div>
        <input id="printButton" class="example-screen btn btn-primary btn-sm" type="button" value="PRINT">
        <button id="btnExport" onclick="excelTemplate()"
                style="float:right;position: absolute;height: 30px;margin-right: 10px" tabindex="-1"
                title="خروجی اکسل">
            <span><i class="fa fa-download fa-lg" style="color:#007bff;"></i></span>
        </button>
    </div>
    <div>
        <div id="printableArea" class="printableArea" style="direction: rtl;margin: 0;padding: 0;">
            <table id="tbl1" class="table-bordered  table-striped table-hover table-responsive img-responsive ">
                <thead>
                <tr>
                    <th id="row0" class="example-screen" style="max-width: 20px"></th>
                    {{--<th style="display: none">partref</th>--}}
                    {{--<th>barcode</th>--}}
                    <th>partcode</th>
                    <th id="thName0" class="example-screen">name</th>
                    <th>cnt</th>
                    <th>$</th>
                    <th style="color:red;" class="example-screen">X</th>
                </tr>
                <tr class="example-screen">
                    <th></th>
                    {{--<th>--}}
                    {{--<input type="text" id="barcode0" class="form-control form-control-lg" disabled="disabled">--}}
                    {{--</th>--}}
                    <th>
                        <input type="text" id="partcode0" style="display: block;width:150px" autofocus
                               onclick="$('#livesearchpartcode0,#livesearchname0,#name0').val('').html('')"
                               oninput="DelayedShowResult(this.value,this.id);"
                               class="form-control form-control-lg">
                    </th>
                    <th>
                        <input type="text" id="name0" class="form-control form-control-lg" style="width: 100px"
                               onclick="$('#livesearchpartcode0,#livesearchname0,#partcode0').val('').html('')"
                               oninput="DelayedShowResult(this.value,this.id);">
                    </th>
                    <th></th>
                    <th></th>
                    <th class="example-screen"></th>
                    {{--<th></th>--}}
                </tr>
                <tr>
                    <th>
                        <div id="livesearchpartcode0" style="position:absolute;background-color:floralwhite;"></div>
                        <div id="livesearchname0" style="position:absolute;background-color:floralwhite;"></div>
                    </th>
                </tr>
                </thead>

                <tbody id="tbody">
                {{--<tr>--}}

                {{--</tr>--}}
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
<script>
    function rmv(td) {
        $.confirm({
            title: 'DELETE!',
            content: '? Are You Sure To Delete row = ' + $(td).next().text(),
            type: 'red',
            draggable: true,
            animationSpeed: 2,
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
                        $('#partcode0').focus();
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
</script>
{{--<script>--}}
{{--$("div#printButton").click(function () {--}}
{{--$("div.printableArea").printArea([OPTIONS]);--}}
{{--});--}}
{{--</script>--}}
</html>
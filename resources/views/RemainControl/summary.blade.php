<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    {{--    <link rel="stylesheet" href={{asset(url('css/fa.min.css'))}}/>--}}
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>
    {{--<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">--}}
    <title>گزارش خلاصه کنترل موجودی شعب</title>
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
        color: black;
        font-size: small;
        tabindex: "-1";
    }
    .trData{
        font-size: x-small;
    }

    @media only screen and (max-width: 900px) {
        body {
            font-size: 1.7vw !important;
        }
    }
    a:hover {
        text-decoration: none;
    }

    .row {
        margin: 0;
        padding: 0;
    }

    #tbl1 {
        width: 100%;
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
<script>
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

    function selectDay(t, e) {
        e.preventDefault();
        $('a,input').hide();
        var docid = $(t).attr('data-docid');
        var stock = $(t).attr('data-stock');
        var day = $('#select1').find(':selected').val();
        $.ajax({
            url: '/pick/summary',
            method: 'get',
            data: {docid: docid, stock: stock, day: day},
            success: function (res) {
                $('#tbody1').empty().append(res);
                $('input,a').show();
                setTimeout(checkConflict, 3000)
                // checkConflict();
            }
        });
        console.log(stock + ' ' + day + ' ' + docid);
    }

    function checkConflict() {
        $('.trData #tdRemain2').each(function (i, inp) {
            let r = parseInt($(inp).parent().find('td#tdRemain').text());
            // console.log(inp.innerText + ' and ' + r);
            if (r != parseInt(inp.innerText)) {
                $(inp).parent().css('background-color', '#e1e637');
            }
            ;
        });
    }
</script>
<body>
@if(auth()->check() && auth()->user()->hasAnyRole('admin'))
    <button id="btnExport" class="" onclick="fnExcelReport(event);" style="left:0;position: absolute"
            title="خروجی اکسل">
        {{--<span><i class="fas fa-download fa-lg" style="color:royalblue"></i></span>--}}
        <span><i class="fa fa-download fa-lg" style="color:royalblue"></i></span>
    </button>
    <table class="table table-bordered table-responsive" style="text-align: center">
        <tbody>
        <tr>
            <td style="background-color: #aaaaaa"><a href="/pick">منو اصلی</a></td>
            <td>
                <a href="/pick/summary/1/1/1" onclick="selectDay(this,event)"
                   data-docid="{{\App\DocRemain::where('stock',30)->where('status',1)->latest()->first()->id  }}"
                   data-stock="1">
                    شعبه 1
                </a>
            </td>
            <td>
                <a href="/pick/summary/2/2/1" onclick="selectDay(this,event)"
                   data-docid="{{\App\DocRemain::where('stock',20)->where('status',1)->latest()->first()->id  }}"
                   data-stock="2">
                    شعبه 2
                </a>
            </td>
            <td>
                <a href="/pick/summary/3/3/1" onclick="selectDay(this,event)" data-value="3"
                   data-docid="{{\App\DocRemain::where('stock',21)->where('status',1)->latest()->first()->id  }}"
                   data-stock="3">
                    شعبه 3
                </a>
            </td>
            <td>
                <a href="/pick/summary/4/4/1" onclick="selectDay(this,event)" data-value="4"
                   data-docid="{{\App\DocRemain::where('stock',22)->where('status',1)->latest()->first()->id  }}"
                   data-stock="4">
                    شعبه 4
                </a>
            </td>
            <td>
                <select name="branch" id="select1">
                    @for($i=1;$i<=365;$i++)
                        <option value="{{$i}}">{{$i}}</option>
                    @endfor
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <div class="row">
        <table id="tbl1" class=" table-striped  table-responsive table-bordered  table-sm"
               style="margin:0 auto;text-align: center;">
            <thead>
            <td>no</td>
            <td class="">partcode</td>
            <td class="">barcode</td>
            <td class="">name</td>
            <td class="">Remain2</td>
            {{--<td class="">save</td>--}}
            @hasanyrole('all_principals|admin')
            <td class="">
                remain
            </td>
            @endhasanyrole
            <td>publisher</td>
            <td class="">grpid</td>
            <td class="">grp</td>
            <td class="">stock</td>
            <td class="">drID</td>
            <td class="">pickdate</td>
            <td class="">Day</td>
            <td class="">ID</td>
            {{--<td id="" style="display: none;"></td>--}}
            </thead>

            <thead>
            <td></td>
            <td id="barcodeSearch" style="margin: 0;padding: 0;">
                <input class="input-group-lg  " type="text" tabindex="1"
                       onkeypress="searchPartcode(event,this.value)"
                       style="margin:0 auto ;padding:3px 0;height: 100%;font-size: medium;max-width: 100px">
            </td>
            <td id="nameSearch" style="margin: 0;padding: 0;">
                <input id="inppartcode" tabindex="-1" type="text" onkeypress="searchBarcode(event,this.value)"
                       style="margin:0 auto ;padding:3px 0;height: 100%;font-size: medium;max-width:100px">
            </td>
            </thead>
            <tbody id="tbody1">

            </tbody>

        </table>
    </div>
@endif
</body>
</html>
<!doctype html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>barcode-partcode conflict</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>
    <link rel="stylesheet" href={{asset(url('css/font-awesome.min.css'))}}/>
</head>
<style>
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
    function submitFunc(p, r2, s) {
        var list = [p, r2, s];
        console.log(p, r2, s);
        // return null;
        // $(t).parent().parent().find('#tdInpRemain2').css('background-color', 'green');
        $('input').attr('disabled', 'disabled');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/pick/bp',
            method: 'post',
            data: {
                data: list, "_token": "{{ csrf_token() }}"
            },
            success: function (res) {
                console.log(res);
                $('input').removeAttr('disabled');
                $('.tdSave').css('background-color', '');
                // console.log($(thisOne).siblings());

                $(s).parent().css('background-color', '#fb050a');
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
                alert(request.responseText);
                // $.alert('خطا در داده ورودی|دوباره وارد برنامه شوید.');
            }
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
        tab_text = tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params
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
<body>
<button id="btnExport" onclick="fnExcelReport(event);" style="left:0;position: absolute" tabindex="-1"
        title="خروجی اکسل">
    <span><i class="fa fa-download fa-lg" style="color:#007bff"></i></span>
</button>

<div id="divImage"
     style="display: none;clear: both;margin: 0;right:10%;position: fixed;border: 1px solid white;border-radius: 1px">
    <img id="ImageFrame" class="img-responsive" style="display: block;height: 100%;position: relative"
         onclick="clickToHide()">
</div>
<div id="divSpecs"
     style=";bottom: 1px;margin: 0;position: fixed;border: 1px solid white;border-radius: 1px">
    <div id="specs" style=";display: block;background-color: #83bde6;position: relative;"></div>

</div>
<form method="post" id="form1" class="" action="{{route('logout')}}" autocomplete="off">
    @csrf
    <div>
        @if(auth()->check() && auth()->user()->hasAnyRole('admin|b'.$stockid.'_members'))
            <table id="tbl1" class=" table-striped  table-responsive table-bordered  table-sm">
                <thead>
                <td>ردیف</td>
                <td>بـــــارکد</td>
                <td>کد کالا</td>
                <td>نام کــــالا</td>
                <td>گروه کـــالا</td>
                <td>انبار {{$st}}</td>
                <td>remain2</td>
                <td>ذخیره</td>
                </thead>
                <tbody>
                @foreach($data as $b)
                    <tr>
                        <td></td>
                        <td>{{$b->barcode}}</td>
                        <td id="tdPartcode" ondblclick="getImage({{$b->bp_partcode}})">{{$b->bp_partcode}}</td>
                        <td>{{$b->bp_partname}}</td>
                        <td>{{$b->grp}}</td>
                        <td>
                            @hasanyrole('admin|all_principals')
                            {{$b->$st}}
                            @endhasanyrole
                        </td>
                        <td>
                            <input id="tdInpRemain2" style="width: 50px" type="number"
                                   class="input_number input-group-sm" value="{{ $b->$rem }}">
                        </td>
                        <td>
                            <input id="{{$rem}}" type="button" class="btn btn-primary" value="Save" onclick="
                                    if($(this).parent().parent().find('#tdInpRemain2').val() !='') {
                                    submitFunc(
                                    $(this).parent().parent().find('#tdPartcode').text(),
                                    $(this).parent().parent().find('#tdInpRemain2').val(),
                                    this.id)
                                    }else alert('Enter Number');
                                    ">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</form>
</body>
</html>
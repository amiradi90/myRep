<!doctype html>
<html lang="en" xmlns="" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=2, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>price</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>

    {{--persianDatePicker--}}
    <link rel="stylesheet" href={{asset(url('css/datepicker/persianDatepicker-default.css'))}}/>
    <script src="{{asset(url('js/datepicker/persianDatepicker.min.js'))}}"></script>

    <style>
        @font-face {
            font-family: amm;
            src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
        }

        body {
            background-color: #f8f4ff;
            margin: 0;
            padding: 0;
            font-family: amm, Tahoma;
            /*font-size: medium;*/
            tabindex: "-1";
        }

        @media only screen and (max-width: 900px) {
            body, html {
                font-size: 2.7vw !important;
                /*margin-top: 2% !important;*/
            }

            body, html {
                font-size: 1em !important;
                /*margin-top: 2% !important;*/
            }
        }

        .row {
            margin: 0;
            padding: 0;
        }
    </style>

    <script type="text/javascript">
        $(function () {
            // $("#input1, #span1").persianDatepicker();
            $("#date0").persianDatepicker({showGregorianDate: true});
        });
        $("#date0").persianDatepicker({
            months: ["فروردین", "اردیبهشت", "خرداد", "تیر", "مرداد", "شهریور", "مهر", "آبان", "آذر", "دی", "بهمن", "اسفند"],
            dowTitle: ["شنبه", "یکشنبه", "دوشنبه", "سه شنبه", "چهارشنبه", "پنج شنبه", "جمعه"],
            shortDowTitle: ["ش", "ی", "د", "س", "چ", "پ", "ج"],
            showGregorianDate: !1,
            persianNumbers: !0,
            formatDate: "YYYY/MM/DD hh:ss",
            selectedBefore: !1,
            selectedDate: null,
            startDate: null,
            endDate: null,
            prevArrow: '\u25c4',
            nextArrow: '\u25ba',
            theme: 'default',
            alwaysShow: !1,
            selectableYears: null,
            selectableMonths: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
            cellWidth: 25, // by px
            cellHeight: 20, // by px
            fontSize: 13, // by px
            isRTL: !1,
            calendarPosition: {
                x: 0,
                y: 0,
            },
            onShow: function () {
            },
            onHide: function () {
            },
            onSelect: function () {
            },
            onRender: function () {
            }
        });
    </script>
    <script>
        function ShowChanges() {
            // let stockid = $('#stockid').text();
            $('#tbody td').remove().finish();
            let date = $('#date0').val();
            console.log(date);
            $('input').attr('disabled', 'disabled');
            $.ajax({
                method: 'get',
                url: '/price/priceChange/',
                data: {date: date},
                success: function (res) {
                    $('input').removeAttr('disabled');
                    var el = $('#tbody tr:first');
                    if (el.length) {
                        $('.trLast').css('background-color', '');
                        el.before(res);
                    }
                    else {
                        // $('.trLast').css('background-color', '');
                        $("#tbody").append(res);
                    }
                    $('#barcode0').focus();
                    // countSum();
                },
                error: function (e) {
                    $('input').removeAttr('disabled');
                    $('#barcode0').focus();
                    alert(e);
                }
            })
        };
    </script>

</head>

<body>
<form method="post" class="" autocomplete="off">
    {{--@if(auth()->check() && auth()->user()->hasAnyRole('admin|b'.$stockid.'_members'))--}}
    @if(auth()->check() && auth()->user()->hasAnyRole('admin|all_principals'))
        <div style="width: 100%;text-align: center;margin:0 auto;">
            {{--        <span style="color: red;" id="stockid">{{$stockid}}</span>--}}
            <div>
                <label for="date0">تاریخ :</label>
                <input type="text" id="date0" class="form-control" autocomplete="off"
                       style="width: 150px;margin: auto">
                <span id="span1"></span>
            </div>


            <input type="button" class="btn btn-primary" onclick="ShowChanges()" value="get Prices Changes">

            <div>
                {{--<input type="text" class="example1" style="width: 250px;margin: auto"/>--}}
                {{--<input type="text" id="elementId" style="width: 250px;margin: auto"/>--}}
                {{--<input type="text" id="input1"/>--}}
            </div>
            {{--</div>--}}
            <div style="display: inline-block">
                <table class="table-bordered table-striped table-hover table-responsive header-fixed">
                    <thead>
                    <tr>
                        <td> کد کالا</td>
                        <td> نام کالا</td>
                        <td> قیمت روز</td>
                        <td> قیمت قبلی</td>
                        <td> تاریخ</td>
                        <td> گروه کالا</td>
                        <td> B1</td>
                        <td> B2</td>
                        <td> B3</td>
                        <td> B4</td>
                    </tr>
                    </thead>
                    <tbody id="tbody">
                    {{--<tr id="trData">--}}

                    {{--</tr>--}}
                    </tbody>
                </table>
            </div>
        </div>
        {{--</div>--}}
    @endif
</form>
</body>
</html>
{{--< body >--}}


{{--< /body>--}}
{{--< /html>--}}
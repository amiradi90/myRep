<!doctype html >
<html lang="en" dir="">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="{{asset(url('js/jquery.min.js'))}}"></script>
    <link rel="stylesheet" href={{asset(url('css/bootstrap.min.css'))}}/>
    <link rel="stylesheet" href={{asset(url('css/jquery-confirm.min.css'))}}/>
    <script src='{{asset(url('js/jquery-confirm.min.js'))}}'></script>

    <script>
        function getList() {
            let stock = $('#branches option:selected').val();
            $.ajax({
                method: 'get',
                url: '/placement/listShow',
                data: {stock: stock},
                success: function (res) {
                    $("#tbody").html(res);
                },
                error: function (e) {
                    alert(e);
                }
            })
        }
    </script>
    <style>
        @font-face {
            font-family: amm;
            src: url({{url('/font/iranSans/woff2/iransansweb.woff2')}});
        }

        body {
            /*float: right;*/
            background-color: #ffffd2;
            margin: 0;
            padding: 10px;
            font-family: amm, Tahoma;
            /*font-size: medium;*/
            tabindex: "-1";
            direction: rtl;

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

</head>
<body>
<div id="container">

    <div>
        <select name="branches" id="branches">
            <option value="1">شعبه 1</option>
            <option value="2">شعبه 2</option>
            <option value="3">شعبه 3</option>
            <option value="4">شعبه 4</option>
            <option value="0">انبار البرز</option>
        </select>
    </div>
    <input type="button" class="btn btn-primary btn-sm" value="get" onclick="getList()">
    <input type="text" class="input-group-sm "placeholder="search partcode...">
    <div id="result" style="width: 100%;text-align: center;margin:0 auto;">
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
                        <input type="text" id="partcode0" style="display: block;min-width:150px"
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

</div>
</body>
</html>
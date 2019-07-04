<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/persian-datepicker.min.css"/>
    <script src="js/jquery.min.js"></script>
    <script src="js/persian-date.min.js"></script>
    <script src="js/persian-datepicker.min.js"></script>
{{--{{//this for conveting date time--}}
    <script src="js/jalali-moment.browser.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".example1").pDatepicker({
                initialValue: false,
                observer: true,
                format: 'YYYY-MM-DD HH:mm:ss',
                altField: '.observer-example-alt',
                autoClose: true
                , calendar: {
                    persian: {
                        locale: 'en'
                    }
                }
            });
        });

    </script>
</head>
<style>
    body {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji"
    }
</style>
<body>
<p>persian date time picker</p>
<div style="text-align: center" id="%%">
    <input id="example1" type="text" class="example1"/>
    <button onclick="fn2()">Convert to gregorian</button>

</div >
<hr/>
<span id="time"></span>
<span id="gregorianOutput"></span>
</body>
</html>

<script>
    $('#example1').change(function () {
        alert("Handler for .change() called.");
    });

    function fn2() {
        var input = $('#example1').val();
        var output = moment.from(input, 'fa', 'YYYY-MM-DD HH:mm:ss').locale('en').format('YYYY-MM-DD HH:mm:ss');
        $('#gregorianOutput').text(output);
        return false;
    }
</script>
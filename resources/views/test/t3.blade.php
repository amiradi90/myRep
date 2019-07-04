<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Jalali Moment demo</title>
    <meta name="author" content="Mojtaba Zarei(Fingerpich)">
    <meta name="keywords" content="shamsi,miladi,convert,validate">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="it consits some of jalali-moment library usages">
    <style>
        body {
            text-align: center;
            color: #333;
        }

        p {
            direction: rtl;
        }

        a {
            color: #07f;
            text-decoration: none;
        }

        button, input {
            padding: 15px;
            text-align: center;
            background: #fff;
            border: 1px solid #bbb;
        }

        button {
            border-top-right-radius: 5px;
            border-bottom-right-radius: 5px;
            border-color: #333;
        }

        section {
            padding: 20px 0;
        }

        code {
            margin: 15px;
            display: block;
            color: #777777;
        }
    </style>
    <script src="https://unpkg.com/jalali-moment/dist/jalali-moment.browser.js"></script>
    <!--<script src="../dist/jalali-moment.browser.js"></script>-->
</head>
<body>
<h1 class="center"><a href="https://github.com/fingerpich/jalali-moment">Jalali Moment</a> Demo</h1>
<p class="center">
    این پلاگین برای سهولت هرچه بیشتر در کار با تاریخ شمسی ایجاد شده است.
</p>

<section>
    <h3>Miladi <a href="https://github.com/fingerpich/jalali-moment#convert-gregorian-miladi-to-jalali-shamsi-persian">to
            Shamsi</a>(تبدیل تاریخ میلادی به شمسی)</h3>
    <p>این کتابخانه میتواند برای تبدیل تاریخ میلادی به شمسی استفاده شود.</p>
    <form id="convertToJalaliForm">
        <input id="gregorianInput" placeHolder="YYYY/MM/DD" value="1989/01/24">
        <button type="submit">to Jalali</button>
        <span id="jalaliOutput"></span>
    </form>
    <code>moment(input, 'YYYY/MM/DD').locale('fa').format('YYYY/MM/DD');</code>

</section>

<section>
    <h3>Shamsi <a
                href="https://github.com/fingerpich/jalali-moment#convert-persianjalali--shamsi-khorshidi-to-gregorian-miladi-calendar-system">to
            Miladi</a> (تبدیل تاریخ شمسی به میلادی)</h3>
    <p>این کتابخانه میتواند برای تبدیل تاریخ شمسی به میلادی استفاده شود.</p>
    <form id="convertToGregorianForm">
        <input id="jalaliInput" placeHolder="YYYY/MM/DD" value="1370/03/16">
        <button id="convertToGregorian">to Gregorian</button>
        <span id="gregorianOutput"></span>
    </form>
    <code>moment.from(input, 'fa', 'YYYY/MM/DD').locale('en').format('YYYY/MM/DD');</code>
</section>

<section>
    <h3><a href="https://github.com/fingerpich/jalali-moment#validate">Validate</a> shamsi date(تعیین صحت تاریخ شمسی)
    </h3>
    <p>این کتابخانه برای تشخیص صحت یک تاریخ شمسی یا میلادی و همچنین مقایسه بین تاریخ ها کمک میکند.</p>
    <form id="validateShamsiForm">
        <input id="validatingDate" placeHolder="YYYY/MM/DD" value="1370/03/16">
        <button type="submit">validate</button>
        <span id="ValidationOutput"></span>
    </form>
    <code>moment(input, 'YYYY/MM/DD').isValid();</code>
</section>


<script>
    // (function (i, s, o, g, r, a, m) {
    //     i['GoogleAnalyticsObject'] = r;
    //     i[r] = i[r] || function () {
    //         (i[r].q = i[r].q || []).push(arguments)
    //     }, i[r].l = 1 * new Date();
    //     a = s.createElement(o),
    //         m = s.getElementsByTagName(o)[0];
    //     a.async = 1;
    //     a.src = g;
    //     m.parentNode.insertBefore(a, m)
    // })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
    //
    // ga('create', 'UA-98265042-4', 'auto');
    // ga('send', 'pageview');

    // document.getElementById("convertToJalaliForm").onsubmit = function () {
    //     var input = document.getElementById("gregorianInput").value;
    //     var output = moment(input, 'YYYY/MM/DD').locale('fa').format('YYYY/MM/DD');
    //     document.getElementById("jalaliOutput").innerText = output;
    //     return false;
    // };

    document.getElementById("convertToGregorianForm").onsubmit = function () {
        var input = document.getElementById("jalaliInput").value;
        var output = moment.from(input, 'fa', 'YYYY/MM/DD').locale('en').format('YYYY/MM/DD');
        document.getElementById("gregorianOutput").innerText = output;
        return false;
    };

    // document.getElementById("validateShamsiForm").onsubmit = function () {
    //     var output = "";
    //     try {
    //         var input = document.getElementById("validatingDate").value;
    //         var m = moment(input, 'YYYY/MM/DD');
    //         if (m.isValid()) {
    //             output = "معتبر است";
    //         } else {
    //             output = "معتبر نیست";
    //         }
    //     }
    //     catch (e) {
    //         output = "معتبر نیست";
    //     }
    //     document.getElementById("ValidationOutput").innerText = output;
    //     return false;
    // };
</script>

</body>
</html>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="chrome=1">
    <title>QuaggaJS, an advanced barcode-reader written in JavaScript</title>

    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="copyright" content="This project is maintained by Christoph Oberhofer"/>
    <meta name="description" content="QuaggaJS is an advanced barcode-reader written in JavaScript"/>
    <meta name="keywords" content="barcode, javascript, canvas, computer vision, image processing, ean, code128"/>
    <meta name="robots" content="index,follow"/>

    <link rel="canonical" href="https://serratus.github.io/examples/live_w_locator.html"/>
    <link rel="stylesheet" href="https://serratus.github.io/quaggaJS/stylesheets/styles.css">
    <link rel="stylesheet" href="https://serratus.github.io/quaggaJS/stylesheets/example.css">
    <link rel="stylesheet" href="https://serratus.github.io/quaggaJS/stylesheets/pygment_trac.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <!--[if lt IE 9]>
    <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
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
</head>
<body>
<div class="wrapper">
    <div>
        <span id="insertCode">1</span>
    </div>
    <div id="interactive" class="viewport"></div>
    <section>


        <section id="container" class="container">

            <div class="controls">
                <fieldset class="input-group">
                    <button class="stop">Stop</button>
                </fieldset>
                <fieldset class="reader-config-group">
                    <label>
                        <span>Barcode-Type</span>
                        <select name="decoder_readers">
                            <option value="code_128" selected="selected">Code 128</option>
                            <option value="code_39">Code 39</option>
                            <option value="code_39_vin">Code 39 VIN</option>
                            <option value="ean">EAN</option>
                            <option value="ean_extended">EAN-extended</option>
                            <option value="ean_8">EAN-8</option>
                            <option value="upc">UPC</option>
                            <option value="upc_e">UPC-E</option>
                            <option value="codabar">Codabar</option>
                            <option value="i2of5">I2of5</option>
                            <option value="2of5">Standard 2 of 5</option>
                            <option value="code_93">Code 93</option>
                        </select>
                    </label>
                    <label>
                        <span>Resolution (long side)</span>
                        <select name="input-stream_constraints">
                            <option value="320x240">320px</option>
                            <option selected="selected" value="640x480">640px</option>
                            <option value="800x600">800px</option>
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
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option selected="selected" value="4">4</option>
                            <option value="8">8</option>
                        </select>
                    </label>
                    <label>
                        <span>Camera</span>
                        <select name="input-stream_constraints" id="deviceSelection">
                        </select>
                    </label>
                    <label style="display: none">
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

        <script src="{{asset(url('js/jquery.min.js'))}}"></script>
        <script src="{{asset(url('js/barcode/quagga/adapter-latest.js'))}}" type="text/javascript"></script>
        {{--<script src="//webrtc.github.io/adapter/adapter-latest.js" type="text/javascript"></script>--}}
        <script src='{{asset(url('js/barcode/quagga/quagga.min.js'))}}'></script>
        <script src='{{asset(url('js/barcode/quagga/live_w_locator.js'))}}'></script>

    </section>

</div>
<script src="https://serratus.github.io/quaggaJS/javascripts/scale.fix.js"></script>
</body>
</html>




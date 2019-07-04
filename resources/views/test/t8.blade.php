<!DOCTYPE html>
<html lang="en">

<head>
    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        /* In order to place the tracking correctly */
        canvas.drawing, canvas.drawingBuffer {
            position: absolute;
            left: 0;
            top: 0;
        }
    </style>
</head>

<body>
<!-- Div to show the scanner -->
<div id="scanner-container"></div>
<input type="button" id="btn" value="Start"/>
<input type="button" id="btnStop" value="Stop"/>
<span id="show">here</span>

<!-- Include the image-diff library -->
<script src='{{asset(url('js/barcode/quagga/quagga.js'))}}'></script>

{{--<script src="quagga.min.js"></script>--}}

<script>
    var _scannerIsRunning = false;

    function startScanner() {
        Quagga.init({
            inputStream: {
                name: "Live",
                type: "LiveStream",
                target: document.querySelector('#scanner-container'),
                constraints: {
                    width: 500,
                    // width: 480,
                    // height: 320,
                    height: 200,
                    facingMode: "environment"
                },
            },
            decoder: {
                readers: [
                    // "code_128_reader",
                    "ean_reader"
                    // ,
                    // "ean_8_reader",
                    // "code_39_reader",
                    // "code_39_vin_reader",
                    // "codabar_reader",
                    // "upc_reader",
                    // "upc_e_reader",
                    // "i2of5_reader"
                ],
                debug: {
                    showCanvas: true,
                    showPatches: true,
                    showFoundPatches: true,
                    showSkeleton: true,
                    showLabels: true,
                    showPatchLabels: true,
                    showRemainingPatchLabels: true,
                    boxFromPatches: {
                        showTransformed: true,
                        showTransformedBox: true,
                        showBB: true
                    }
                }
            },

        }, function (err) {
            if (err) {
                console.log(err);
                document.getElementById("show").innerHTML = err;

                return
            }

            console.log("Initialization finished. Ready to start");
            Quagga.start();

            // Set flag to is running
            _scannerIsRunning = true;
        });

        Quagga.onProcessed(function (result) {
            var drawingCtx = Quagga.canvas.ctx.overlay,
                drawingCanvas = Quagga.canvas.dom.overlay;

            if (result) {
                if (result.boxes) {
                    drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                    result.boxes.filter(function (box) {
                        return box !== result.box;
                    }).forEach(function (box) {
                        Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
                    });
                }

                if (result.box) {
                    Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
                }

                if (result.codeResult && result.codeResult.code) {
                    Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
                }
            }
        });


        Quagga.onDetected(function (result) {
            console.log("Barcode detected and processed : [" + result.codeResult.code + "]", result);
            // $('#show').html(result.codeResult.code);
            // $('#show').html('hello');
            document.getElementById("show").innerHTML = result.codeResult.code;

        });
    }


    // Start/stop scanner
    document.getElementById("btn").addEventListener("click", function () {
        document.getElementById('scanner-container').style.display = 'block';
        // if (_scannerIsRunning) {
        //     Quagga.stop();
        // } else {
        startScanner();
        Quagga.start();
        // }
    }, false);

    document.getElementById("btnStop").addEventListener("click", function () {
        Quagga.stop();
        document.getElementById('scanner-container').style.display = 'none';
    }, false);
</script>
</body>

</html>
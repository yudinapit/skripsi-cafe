<html>
    <head>
        <style>
            #app .app{
                max-width: 600px;
                width: 100%;
                /* border: 1px solid; */
                height: 100%;
                padding: 20px 20px 80px 20px;
            }
            .table {
                border-collapse: collapse;
            }

            .table tr td {
                padding: 6px 0px
            }

        </style>
    </head>
    <body onload="onload()">
        <div id="app" style="display: flex; align-items: center; justify-content: center; text-align: center">
            <div class="app">
                <h1 style="text-align: center">
                    {{ $data->name }}
                </h1>
                <div id="barcode" style="margin-top: 40px display: flex; justify-content: center">
                    {!! DNS2D::getBarcodeHTML(url('/menu/list').'/'.$data->barcode, 'QRCODE', 15, 15) !!}
                </div>
            </div>
        </div>
    </body>
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
       $(function() {
            const element = $('#barcode');
            html2canvas(element[0], {
                quality: 1,
                pixelRatio: 1,
                backgroundColor: 'white',
                width: 460
            }).then(function(canvas) {
               element.html(canvas)
               window.print();
            });
       });
    </script>
</html>

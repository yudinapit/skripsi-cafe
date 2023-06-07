<html>
    <head>
        <style>
            #app .app{
                max-width: 400px;
                width: 100%;
                border: 1px solid;
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
                <diV>
                    <div>
                        <img
                            src="{{ asset('assets/frontend/img/logo c-code coffee.svg') }}"
                            style="height: 40px" />
                    </div>
                    <div style="margin-top: 10px">
                        Jalan Gelong Baru Utara.1A,Tomang Jakarta Barat, RT08/RW03, Tomang, Kec. Grogol petamburan, Daerah Khusus Ibukota Jakarta 11440
                    </div>
                </diV>
                <div style="margin-top: 40px">
                    <table class="table" style="width: 100%">
                        <tr>
                            <td style="width: 50%">{{ date('d F Y', strtotime($data->created_at)) }}</td>
                            <td style="width: 50%; text-align: right">{{ date('H:i:s', strtotime($data->created_at)) }}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Table Number</td>
                            <td style="width: 50%; text-align: right">{{$data->tables->name ?? '-'}}</td>
                        </tr>
                        <tr>
                            <td style="width: 50%">Order ID</td>
                            <td style="width: 50%; text-align: right">{{$data->order_Id ?? '-'}}</td>
                        </tr>
                    </table>
                </div>
                <div style="border-bottom: 1px dashed; margin-top: 10px"></div>
                <div style="margin-top: 10px">
                    <table class="table" style="width: 100%">
                       @foreach ($data->menuOrderDetail ?? [] as $item)
                        <tr>
                            <td style="width: 100%"><b>{{$item->menu->title ?? '-' }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 20%">{{ $item->qty }}x</td>
                            <td style="width: 80%; text-align: right; white-space: nowrap"><b>Rp {{ number_format($item->price_total * $item->qty, 0, ',', '.') }}</b></td>
                        </tr>
                       @endforeach
                    </table>
                </div>
                <div style="border-bottom: 1px dashed; margin-top: 10px"></div>
                <div style="margin-top: 10px">
                    <table class="table-detail" style="width: 100%">
                        <tr>
                            <td style="width: 20%">Sub Total</td>
                            <td style="width: 80%; text-align: right; white-space: nowrap"><b>Rp {{ number_format($data->price_total, 0, ',', '.') }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 40%">service charge(5%)</td>
                            <td style="width: 60%; text-align: right; white-space: nowrap"><b>Rp {{ number_format($data->total_service_charge, 0, ',', '.') }}</b></td>
                        </tr>
                        <tr>
                            <td style="width: 20%">Pb1(10%)</td>
                            <td style="width: 80%; text-align: right; white-space: nowrap"><b>Rp {{ number_format($data->total_pb1, 0, ',', '.') }}</b></td>
                        </tr>
                    </table>
                </div>
                <div style="border-bottom: 1px dashed; margin-top: 10px"></div>
                <div style="margin-top: 10px">
                    <table class="table-detail" style="width: 100%">
                        <tr>
                            <td style="width: 20%">Total</td>
                            <td style="width: 80%; text-align: right; white-space: nowrap"><b>Rp {{ number_format($data->price_total + $data->total_service_charge + $data->total_pb1, 0, ',', '.') }}</b></td>
                        </tr>
                    </table>
                </div>
                <div style="border-bottom: 1px dashed; margin-top: 10px;"></div>
                <div>
                    <img style="height: 30px; margin-top: 10px" src="{{ asset('assets/frontend/img/logo-with-text.svg') }}" />
                </div>
                <div style="border-bottom: 1px dashed; margin-top: 10px"></div>
                <div style="text-align: left; margin-top: 10px">
                    <b>Notes</b><br/>
                    Please help us grow by providing feedback or a review on Google
                    (C - CODE COFFEE) Thank you
                </div>
            </div>
        </div>
    </body>
    <script>
        function onload() {
            window.print()
        }
    </script>
</html>

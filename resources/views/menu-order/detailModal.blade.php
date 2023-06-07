<style>
    .table-detail {
        border-collapse: collapse;
    }

    .table-detail tr td {
        padding: 6px 0px !important
    }
</style>
<div style="margin-top: 40px">
    <table class="table-detail" style="width: 100%">
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
    <table class="table-detail" style="width: 100%">
       @foreach ($data->menuOrderDetail ?? [] as $item)
        <tr>
            <td style="width: 100%"><b>{{$item->menu->title ?? '-' }}</b></td>
        </tr>
        <tr>
            <td style="width: 20%">{{ $item->qty }}x</td>
            <td style="width: 80%; text-align: right; white-space: nowrap"><b>Rp {{ number_format($item->price_total * $item->qty, 0, ',', '.') }}</b></td>
        </tr>
        <tr>
            <td style="width: 100%; font-size: 12px"><b>Notes</b>: {{ $item->notes }}</td>
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


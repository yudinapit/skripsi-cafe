@extends('layouts.backend')
@section('title', 'Table List')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $page_title }}</h4>
                </div>
                <div class="card-body">
                   <div  style="overflow: auto">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Order ID</th>
                                <th>Tables</th>
                                <th>Date Time Order</th>
                                <th>Total Qty</th>
                                <th>service charge(5%)</th>
                                <th>Pb1(10%)</th>
                                <th>Total Price</th>
                                <th>Payment Method</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if(count($data) > 0)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->order_id }}</td>
                                        <td>{{ $item->tables->name ?? '-' }}</td>
                                        <td class="text-nowrap">{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }} ({{ $item->created_at->diffForHumans(); }})</td>
                                        <td>{{ $item->qty_total }}</td>
                                        <td>Rp {{ number_format($item->total_service_charge, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->total_pb1, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($item->price_total, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center status-change" style="gap: 5px">
                                                <div class="status-order">
                                                    {{ $item->payment_method }}
                                                </div>
                                                <div class="status-input" style="display: none">
                                                    <form action="{{ route('order-menu.update', $item->id) }}" id="payment_method-{{ $item->id }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <input class="form-control" style="min-width: 130px" name="payment_method" value="{{ $item->payment_method }}" />
                                                    </form>
                                                </div>
                                                <div data-id="{{ $item->id }}" class="p-2 change-status show" data-type="true" style="cursor: pointer;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <div class="process-status" style="display: none">
                                                    <div class="d-flex align-items-center" style="gap: 5px">
                                                        <div class="btn btn-primary btn-sm save-status" data-type="true" data-id="{{ $item->id }}">
                                                            <i class="fas fa-save"></i>
                                                        </div>
                                                        <div class="btn btn-danger btn-sm cancel-status">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center status-change" style="gap: 5px">
                                                <div class="status-order">
                                                    {!! getStatusOrder($item->status) !!}
                                                </div>
                                                <div class="status-input" style="display: none">
                                                    @php
                                                        $statusList = [
                                                            1 => 'Belum Diproses',
                                                            2 => 'Sudah Diproses',
                                                            3 => 'Dibayar',
                                                            4 => 'Selesai',
                                                            5 => 'Cancel'
                                                        ];
                                                    @endphp
                                                    <form action="{{ route('order-menu.update', $item->id) }}" id="status-{{ $item->id }}" method="post">
                                                        @csrf
                                                        @method('put')
                                                        <select class="form-control" name="selectInput">
                                                            <option value="">Pilih Status</option>
                                                            @foreach ($statusList as $key => $st)
                                                                <option value="{{ $key }}" {{ $item->status == $key ? 'selected' : '' }}>{{ $st }}</option>
                                                            @endforeach
                                                        </select>
                                                    </form>
                                                </div>
                                                <div data-id="{{ $item->id }}" class="p-2 change-status show" style="cursor: pointer;">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </div>
                                                <div class="process-status" style="display: none">
                                                    <div class="d-flex align-items-center" style="gap: 5px">
                                                        <div class="btn btn-primary btn-sm save-status" data-id="{{ $item->id }}">
                                                            <i class="fas fa-save"></i>
                                                        </div>
                                                        <div class="btn btn-danger btn-sm cancel-status">
                                                            <i class="fas fa-times"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="d-flex align-items-center" style="gap: 10px">
                                            <a target="_black" href="{{ route('order-menu.print', $item->id) }}" class="btn btn-primary text-white" ><i class="fas fa-print"></i></a>
                                            <div role="button" data-toggle="modal" data-name="{{ $item->order_id }}" data-target="#modalDetail" class="btn btn-success text-white detail-data" data-id="{{ $item->id }}">Detail</div>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                            <tr class="text-center">
                                <td colspan="4">Data tidak ditemukan</td>
                            </tr>
                           @endif
                        </tbody>
                    </table>
                   </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalDetail" aria-hidden="true">
        <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fs-5" id="staticBackdropLabel">Detail Order <span class="name-order"></span></h5>
              <button class="btn btn-primary" type="button" class="btn-close" data-dismiss="modal" aria-label="Close">
                <i class="fas fa-times"></i>
              </button>
            </div>
            <div class="modal-body" id="detailModal">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        const modalDetail = $('#modalDetail');
        $('.delete').on('click', function () {
            const id = this.id;
            $('#deleteModal').attr('action', "{{ route('tables.destroy', '') }}" + '/' + id);
        });

        $(function() {
            $('.barcode').on('click', function() {
                let name = $(this).data('name');
                generatePNG(this, name);
            });

            $('.change-status').on('click', function() {
                $(this).parent().find('.status-order').slideUp();
                $(this).parent().find('.status-input').slideDown();
                $(this).parent().find('.process-status').slideDown();
                $(this).slideUp()
            });

            $('.cancel-status').on('click', function() {
                $(this).parents('.status-change').find('.status-order').slideDown();
                $(this).parents('.status-change').find('.status-input').slideUp();
                $(this).parents('.status-change').find('.process-status').slideUp();
                $(this).parents('.status-change').find('.change-status').slideDown();
            });

            $('.save-status').on('click', function() {
                const id = $(this).data('id');
                const type = $(this).data('type');
                if(type)
                    $(`#payment_method-${id}`).trigger('submit');
                else
                    $(`#status-${id}`).trigger('submit');
            });

            $('.detail-data').on('click', function() {
                const id = $(this).data('id');
                const name = $(this).data('name');
                let url = "{{ route('order-menu.show', 'id') }}";
                url = url.replace('id', id);
                let element = `<div style="z-index: 1001; position: fixed; padding: 0px; margin: 0px; width: 30%; top: 40%; left: 35%; text-align: center; background-color: transparant; cursor: wait;" class="blockUI blockMsg blockPage bg-p-white radius-16 p-5 d-none">
                                    <div class="spinner-border text-info" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>`
                $('#detailModal').html(element);
                $('.name-order').text(name);
                $.ajax({
                    url: url,
                    type: 'GET',
                    success: function(data) {
                        $('#detailModal').html(data);
                    }
                })
            });

        });

        function generatePNG(element, name) {
            var element = $(element);
            html2canvas(element[0], {
                quality: 1,
                pixelRatio: 1,
                backgroundColor: 'white'
            }).then(function(canvas) {
                var link = document.createElement("a");
                link.download = `barcode-table-${name}.png`;
                link.href = canvas.toDataURL("image/png");
                link.click();
            });
        }
    </script>
@endsection

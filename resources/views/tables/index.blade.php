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
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Table Number</th>
                                <th>QR Code</th>
                                <!-- <th>Status</th> -->
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                           @if(count($data) > 0)
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td class="position-relative">
                                            <div style="cursor: pointer;" class="barcode m-4" data-name="{{ $item->name }}">
                                                {!! DNS2D::getBarcodeHTML(url('/menu/list').'/'.$item->barcode, 'QRCODE', 5, 5) !!}
                                            </div>
                                        </td>
                                        <!-- <td>
                                            <span class="badge badge-{{ $item->status == 'available' ? 'dark' : 'danger' }}">
                                                {{ $item->status }}
                                            </span>
                                        </td> -->
                                        <td>
                                            <a class="btn btn-dark" href="{{ route('tables.printBarcode', $item->id) }}">Print</a>
                                            <!-- <a class="btn btn-primary" href="{{ route('tables.edit', $item->id) }}">Edit</a> -->
                                            <button class="btn btn-danger delete" type="button" id="{{ $item->id }}" class="btn btn-primary"
                                                data-toggle="modal" data-target="#exampleModal">Delete</button>
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
                </form>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="deleteModal" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure want to delete this item?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <script>
        $('.delete').on('click', function () {
            const id = this.id;
            $('#deleteModal').attr('action', "{{ route('tables.destroy', '') }}" + '/' + id);
        });

        $(function() {
            $('.barcode').on('click', function() {
                let name = $(this).data('name');
                generatePNG(this, name);
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

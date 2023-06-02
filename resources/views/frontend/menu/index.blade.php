@extends('frontend.menu.layout_clean')
@section('content')
@push('css')
<style>
    #app {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        background: black;
    }

    #app .page {
        background-color: rgba(0, 0, 0, 0.48);
    }
</style>
@endpush
{{-- Loading --}}
<div style="z-index: 1000; border: medium none; margin: 0pt; padding: 0pt; width: 100%; height: 100%; top: 0pt; left: 0pt; background-color: rgb(0, 0, 0); opacity: 0.8; cursor: wait; position: fixed;" class="blockUI blockOverlay d-none"></div>
<div style="z-index: 1001; position: fixed; padding: 0px; margin: 0px; width: 30%; top: 40%; left: 35%; text-align: center; background-color: transparant; cursor: wait;" class="blockUI blockMsg blockPage bg-p-white radius-16 p-5 d-none">
    <div class="spinner-border text-info" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>
<div class="positon-relative" style="padding: 100px 0px">
    <div class="position-absolute" style="top: 25px; max-width: 600px; width: 100%">
        <div>
            <div class="d-flex align-items-center justify-content-center">
                <div class="ps-3">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset('assets/img/fill-white.svg') }}" alt="">
                    </a>
                </div>
                <div class="mx-auto text-start pe-4">
                    <div class="font-weight-500 font-size-15 text-p-white text-center">
                        Scan QR Code
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="check-in" id="reader">
    </div>
</div>
@push('js')
<script src="{{ asset('assets/frontend/js/html5-barcode.min.js') }}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(function() {
    })
    Html5Qrcode.getCameras().then(devices => {
    if (devices && devices.length) {
        var cameraId = devices[0].id;
        const html5QrCode = new Html5Qrcode("reader");
    html5QrCode.start(
    cameraId,
    {
        fps: 50,
        qrbox: 250,
        videoConstraints: { facingMode: { exact: "environment" } }
    },
    (decodedText) => {
        html5QrCode.pause();
        $('.blockUI').removeClass('d-none');
        $.ajax({
            url: "{{ route('scanMenu') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                qr_code: decodedText
            },
            success(res) {
                if (res.status)
                    window.location.href = res.redirect;
            },
            error(res) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Qr Code tidak di valid, silahkan scan Qr yang valid',
                }).then((result) => {
                    if(result.isConfirmed) {
                        $('.blockUI').addClass('d-none');
                        html5QrCode.play();
                    }

                })
            }
        })
    },
    errorMessage => {
        // parse error, ideally ignore it. For example:
        console.log(`QR Code no longer in front of camera.`);
    })
    .catch(err => {
        // Start failed, handle it. For example,
        console.log(`Unable to start scanning, error: ${err}`);
    });
    }
    }).catch(err => {
        console.log(err);
    });
</script>
@endpush
@endsection

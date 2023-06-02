@extends('frontend.menu.layout')
@section('content')
@push('css')
<style>
    #app .app {
        background: #E1E1E1 !important;
    }
</style>
@endpush
<div class="py-5" id="listMenu">
    <div class="d-flex align-items-center justify-content-center" style="min-height: 50vh">
        <div class="text-center">
            <div>
                <img src="{{ asset('assets/frontend/img/logo c-code coffee.svg') }}" />
            </div>
            <div class="font-weight-700 mt-4 text-dark" style="font-size: 48px">
                Thank You
            </div>
            <div class="font-size-16 font-weight-700 my-4">
                Your order has been placed.
            </div>
            <div class="mt-3 font-weight-600 text-dark" style="font-size: 24px">
                Your table number is {{ $name_table }}.
            </div>
        </div>
    </div>
</div>
<div class="fixed-bottom d-flex justify-content-center">
    <div class="bg-body border-top border-grey" style="width: 100%; max-width: 600px">
        <div class="p-4 vstack">
            <a href="{{ route('menu') }}" class="btn btn-secondary text-nowrap px-5 w-100 py-2 font-weight-700 radius-10 rounded-10 border-0 done-menu" style="background: #513819">
                Order Again
            </a>
        </div>
    </div>
</div>
@endsection


@extends('frontend.menu.layout')
@section('content')
@section('navbar')
<div>
    <div class="d-flex align-items-center gap-3 pb-3 w-100">
        <div class="pe-2">
            <img
                src="{{ asset('assets/frontend/img/logo c-code coffee.svg') }}"
                style="height: 40px" />
        </div>
        <div class="w-100">
            <input class="form-control w-100 custom-search-top" id="searchMenu" placeholder="Search" />
        </div>
    </div>
    <div class="overflow-auto parent-nav-category ps-2">
        <ul class="nav nav-pills nav-category gap-3 flex-nowrap">
            <li class="nav-item pe-3" style="border-right: 2px solid #CDCECE">
              <div class="nav-link category-item active" data-filter="" aria-current="page" style="cursor: pointer">All</div>
            </li>
            @foreach ($category as $ctg)
            <li class="nav-item">
                <div class="nav-link category-item" data-filter="{{ $ctg->id }}" style="cursor: pointer">{{ $ctg->name }}</div>
            </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
<div class="py-5 mt-5" id="listMenu">
</div>
<div class="fixed-bottom d-flex justify-content-center">
    <div class="bg-body border-top border-grey" style="width: 100%; max-width: 600px">
        <div class="p-4 vstack gap-2">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    Items
                </div>
                <h6>
                    <b class="qty-item">0</b>
                </h6>
            </div>
            <div class="border-top border-grey"></div>
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    Total
                </div>
                <h6>
                    <b class="price-total">Rp 0</b>
                </h6>
            </div>
            <button  class="btn btn-secondary text-nowrap px-5 w-100 py-2 font-weight-700 radius-10 rounded-10 border-0 mt-3 done-menu" style="background: #513819">
                Done
            </button>
        </div>
    </div>
</div>

@push('modals')
<div class="modal" id="modalDetailMenu" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content border-0" style="border-radius: 20px">
        <div class="modal-body p-4">
          <div class="font-size-18">
            Add <span class="font-weight-700 name-menu-detail">lorem ipsum</span>
          </div>
          <div class="py-5">
            <div class="row align-items-center justify-content-center">
                <div class="col-2">
                    <div class="d-flex align-items-center rounded-circle justify-content-center min-qty-detail" style="background: #513819; height: 40px; width: 40px; cursor: pointer">
                        <i class="fas fa-minus" style="color: white"></i>
                    </div>
                </div>
                <div class="col-8">
                    <input class="form-control border-0 border-bottom qty-menu-input text-center py-4" value="1" style="border-radius: 0px; font-size: 30px"/>
                </div>
                <div class="col-2">
                    <div class="d-flex align-items-center rounded-circle justify-content-center add-qty-detail" style="background: #513819; height: 40px; width: 40px; cursor: pointer">
                        <i class="fas fa-plus" style="color: white"></i>
                    </div>
                </div>
            </div>
          </div>
          <div class="vstack gap-sm-0 gap-2">
            <div class="w-100">
               <form id="formAddToCart">
                    <input type="hidden" name="id" />
                    <input type="hidden" name="price" />
                    <button  class="btn btn-secondary text-nowrap px-5 w-100 py-2 font-weight-700 radius-10 rounded-10 border-0 add-to-cart" style="background: #513819">
                        Add to cart
                    </button>
               </form>
            </div>
            <div class="mt-2 w-100">
                <button class="btn btn-white text-nowrap px-5 w-100 py-2 font-weight-700 radius-10 rounded-10 border-0 cancel-qty" style="background: #E4E4E4; color: #513819">
                    Cancel
                </button>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endpush
@include('frontend.menu.skeletonMenu')

@push('js')
<script>
    const code_table = "{{ $code_table }}";
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('assets/frontend/js/menu.js') }}"></script>
@endpush
@endsection


@if(count($menus) > 0)
<div class="row g-sm-4 g-3 pt-3 pb-5 mb-4">
    @foreach ($menus as $item)
    <div class="col-6">
        <div class="card radius-10 rounded-10 menu-item shadow-sm border-0" data-id="{{ $item->id }}" style="cursor: pointer">
            <div>
                <img src="{{ asset($item->thumbnail) }}"
                        class="radius-top-left"
                        style="height: 164px; width: 100%; object-cover: center">
            </div>
            <div class="card-body">
                <div class="vstack justify-content-between gap-4 item-menu-bottom">
                    <div>
                        <div class="font-size-16 font-weight-500">{{ $item->title }}</div>
                        <div class="font-size-12 font-weight-400" style="color: #848484">
                            {{ substr(strip_tags($item->description), 0, 80) }}...
                        </div>
                    </div>
                    <div class="d-flex flex-wrap gap-2 align-items-center justify-content-between">
                        <div class="font-size-16 font-weight-700 text-nowrap">
                            Rp {{ number_format($item->price, 0, ',', '.' ) }}
                        </div>
                        <div class="font-weight-700 text-success text-nowrap">
                            <span class="qty-selected" data-id="{{ $item->id }}" id="qty-selected-{{ $item->id }}">0</span> Terpilih
                        </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="d-flex align-items-center justify-content-center" style="height: 60vh">
    <div class="text-center">
        <div>
            <img style="height: 300px" src="{{ asset('/assets/frontend/img/empty-menu.svg') }}" />
        </div>
        <div>
            <h5>Menu tidak ditemukan</h5>
        </div>
    </div>
</div>
@endif


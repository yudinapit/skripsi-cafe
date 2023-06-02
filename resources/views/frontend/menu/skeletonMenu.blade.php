<div id="skeletonMenu" class="row g-sm-4 g-3 py-3">
    @for ($i = 0; $i < 4; $i++)
    <div class="col-6">
        <div class="card radius-10 rounded-10 menu-item shadow-sm border-0" style="cursor: pointer">
            <div>
                <div class="skeleton-box radius-top-left" style="height: 164px; width: 100%;"></div>
            </div>
            <div class="card-body">
                <div class="vstack justify-content-between gap-4">
                    <div>
                        <div class="font-size-16 font-weight-500">
                            <div class="skeleton-box" style="height: 15px; width: 60%; border-radius: 6px"></div>
                        </div>
                        <div class="font-size-12 font-weight-400" style="color: #848484">
                            <div class="skeleton-box" style="height: 15px; width: 90%; border-radius: 6px"></div>
                        </div>
                    </div>
                    <div class="font-size-16 font-weight-700">
                        <div class="skeleton-box" style="height: 15px; width: 50%; border-radius: 6px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endfor
</div>

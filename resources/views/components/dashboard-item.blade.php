<div class="col-md-3">
    <div class="dashboard-item">
        <div class="stats">
            <span class="qty text-extra">{{ $count }}</span>
            <div class="icon-box">
                <img src="{{ asset($icon) }}">
            </div>
        </div>

        <div class="d-flex align-items-center justify-content-between bottom-stats mx-3">
            <span class="title">{{ $title }}</span>
            <span>
                <a href="{{ route($routeName) }}" class="act text-link">
                    manage
                    <img style="height: 1.5rem; width: 1.5rem;"
                         src="{{ asset('assets/admin/icons/icon-arrow-right.svg') }}">
                </a>
            </span>
        </div>
    </div>
</div>
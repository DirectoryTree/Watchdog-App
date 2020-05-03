@if(count(\Illuminate\Support\Arr::except(request()->query(), ['page'])) > 0)
    <li>
        <a class="nav-link" href="{{ request()->url() }}">
            <i class="fa fa-times-circle"></i>
            Clear Filters & Sort
        </a>
    </li>
@endif

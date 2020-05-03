<nav {{ $attributes->merge(['class' => 'navbar navbar-expand-md navbar-light']) }}>
    @isset($title)
        <!-- Title -->
        <span class="navbar-text text-muted">
            {{ $title }}
        </span>
    @endisset

    @isset($brand)
        <!-- Brand -->
        <div class="navbar-brand">{{ $brand }}</div>
    @endisset

    <!-- Mobile Expand Toggle -->
    <div class="ml-auto">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#{{ $id }}" aria-controls="{{ $id }}" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>

    <!-- Navbar -->
    <div class="collapse navbar-collapse" id="{{ $id }}">
        {{ $slot }}
    </div>
</nav>

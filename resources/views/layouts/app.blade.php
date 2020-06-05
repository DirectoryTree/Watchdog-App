@extends('layouts.base')

@inject('cache', 'App\Cache\CountCache')

@section('body')
    <div class="container-fluid">
        <div class="row">
            @php($watchers = app(\DirectoryTree\Watchdog\WatcherRepository::class)->all())

            @include('layouts.nav.sidebar')

            <main role="main" class="col-md-8 ml-sm-auto col-lg-9 py-2 py-md-4 px-md-4">
                <div class="d-block d-md-none mb-2">
                    @include('layouts.nav.mobile')
                </div>

                @yield('content')
            </main>
        </div>
    </div>

{{--    @foreach (session('flash_notification', collect())->toArray() as $message)--}}
{{--        <script>--}}
{{--            Swal.fire({--}}
{{--                type: "{{ $message['level'] }}",--}}
{{--                title: "{{ $message['message'] }}",--}}
{{--            });--}}
{{--        </script>--}}
{{--    @endforeach--}}

{{--    {{ session()->forget('flash_notification') }}--}}

{{--    <script>--}}
{{--        window.livewire.on('notification', (notification) => {--}}
{{--            Swal.fire({--}}
{{--                type: notification.type,--}}
{{--                title: notification.title,--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
@endsection

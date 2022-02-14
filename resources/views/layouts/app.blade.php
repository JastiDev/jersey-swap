@include('../frontend/components.header')
@include('../frontend/components.navbar')
    <main style="margin-top: 66px; min-height: calc(100vh - 498px)">
        @yield('content')
    </main>

@include('../frontend/components.footer')

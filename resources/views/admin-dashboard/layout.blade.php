@include('admin-dashboard.partials._header')

@include('admin-dashboard.partials._side-menu')

<main class="dashboard-main">
<!-- include main navbar -->
    @include('admin-dashboard.components.main-navbar')

    <div class="dashboard-main-body">

        {{$slot}}

    </div>

    <!-- include copyright footer -->
    @include('admin-dashboard.components.copyright-footer')
</main>

@include('admin-dashboard.partials._footer')
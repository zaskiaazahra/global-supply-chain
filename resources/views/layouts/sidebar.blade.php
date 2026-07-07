<div class="sidebar">

    <div class="text-center mb-5">

        <h2 class="fw-bold mb-0">
            🌍
        </h2>

        <h5 class="fw-bold mt-2">
            Global Supply Chain
        </h5>

        <small class="text-white-50">
            Risk Intelligence
        </small>

    </div>

    <a href="/" class="{{ request()->is('/') ? 'active-menu' : '' }}">
        <i class="bi bi-speedometer2 me-2"></i>
        Dashboard
    </a>

    <a href="/countries" class="{{ request()->is('countries') ? 'active-menu' : '' }}">
        <i class="bi bi-globe2 me-2"></i>
        Countries
    </a>

    <a href="/shipment" class="{{ request()->is('shipment') ? 'active-menu' : '' }}">
        <i class="bi bi-box-seam me-2"></i>
         Shipment
    </a>

    <a href="{{ url('/currency') }}">
        <i class="bi bi-currency-dollar me-2"></i>
        Currency
    </a>

    <a href="{{ route('weather') }}"
class="{{ request()->is('weather') ? 'active-menu' : '' }}">

    <i class="bi bi-cloud-sun me-2"></i>

    Weather

</a>

    <a href="#">
        <i class="bi bi-graph-up me-2"></i>
        Economy
    </a>

    <a href="#">
        <i class="bi bi-newspaper me-2"></i>
        News
    </a>

    <a href="#">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Risk Analysis
    </a>

    <a href="#">
        <i class="bi bi-bookmark-star me-2"></i>
        Watchlist
    </a>

</div>
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
    
    <a href="{{ route('risk.index') }}"
class="{{ request()->is('risk-analysis') ? 'active-menu' : '' }}">

    <i class="bi bi-exclamation-triangle me-2"></i>

    Risk Analysis

</a>
    <a href="{{ route('weather') }}"
class="{{ request()->is('weather') ? 'active-menu' : '' }}">

    <i class="bi bi-cloud-sun me-2"></i>

    Weather

</a>

    <a href="{{ url('/currency') }}">
        <i class="bi bi-currency-dollar me-2"></i>
        Currency
    </a>

    <a href="{{ route('news') }}" class="nav-link">
    <i class="bi bi-newspaper"></i>
    <span>News</span>
</a>

    <a href="/port-location" class="{{ request()->is('port-location') ? 'active-menu' : '' }}">
        <i class="bi bi-geo-alt-fill"></i>
          Port Location
    </a>

    <li>

<a
href="{{ route('comparison') }}"
class="{{ request()->is('comparison')?'active-menu':'' }}">

<i class="bi bi-bar-chart-fill me-2"></i>

Country Comparison

</a>

</li>

    <a href="{{ route('watchlist.index') }}"
class="{{ request()->is('watchlist') ? 'active-menu' : '' }}">

    <i class="bi bi-star-fill me-2"></i>

    Watchlist

</a>

<li class="nav-item">

    <a href="{{ route('visualization.index') }}"
       class="nav-link {{ request()->is('visualization*') ? 'active' : '' }}">

        <i class="bi bi-graph-up-arrow me-2"></i>
        Data Visualization

    </a>

</li>

</div>
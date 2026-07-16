<div class="d-flex flex-column text-white p-3"
style="
width:250px;
height:100vh;
background:#6F4E37;
position:sticky;
top:0;
">

    <h3 class="fw-bold text-center mb-4">

        🛠 Admin Panel

    </h3>

    <hr>

    <ul class="nav nav-pills flex-column flex-grow-1">

        <li class="nav-item mb-2">

            <a href="{{ route('admin.dashboard') }}"
            class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active bg-light text-dark' : 'text-white' }}">

                📊 Dashboard

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="{{ route('admin.users') }}"
            class="nav-link {{ request()->routeIs('admin.users') ? 'active bg-light text-dark' : 'text-white' }}">

                👤 Users

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="{{ route('admin.ports') }}"
            class="nav-link {{ request()->routeIs('admin.ports') ? 'active bg-light text-dark' : 'text-white' }}">

                ⚓ Ports

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="{{ route('admin.news') }}"
            class="nav-link {{ request()->routeIs('admin.news') ? 'active bg-light text-dark' : 'text-white' }}">

                📰 News

            </a>

        </li>

    </ul>

    <div>

        <hr>

        <div class="text-center mb-3">

            <div style="font-size:48px;">

                👨🏻‍💼

            </div>

            <h5 class="fw-bold mb-1">

                Admin

            </h5>

        </div>

        <form method="POST"
        action="{{ route('logout') }}">

            @csrf

            <button
            class="btn btn-danger w-100">

                🚪 Logout

            </button>

        </form>

    </div>

</div>
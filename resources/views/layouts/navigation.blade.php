<nav class="nav-container">
    <style>
        .nav-container {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 200px;
            background-color: #b2e400;
            border-right: 1px solid #e2e8f0;
            padding: 16px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .nav-link {
            color: #0a0a0a;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: color 0.2s, background-color 0.2s;
        }

        .nav-link:hover {
            color: #000000;
            background-color: #6e8d00;
        }

        .nav-link.active {
            color: #2d3748;
            background-color: #ffffff;
        }

        .logout-form {
            display: inline;
        }
    </style>

    <!-- Navigation Menu -->
    <div class="nav-links">
        
        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            {{ __('Profile') }}
        </a>

        <!-- Dashboard -->
        {{-- <a href="{{ route('patient.dashboard') }}" class="nav-link {{ request()->routeIs('rider.dashboard') ? 'active' : '' }}">
            {{ __('Dashboard') }}
        </a> --}}

        <!-- Appointment -->
        <a href="{{ route('equipment') }}" class="nav-link {{ request()->routeIs('equipment') ? 'active' : '' }}">
            {{ __('Equipments') }}
        </a>

        <!-- Borrowed Equipments -->
        <a href="{{ route('borrowed') }}" class="nav-link {{ request()->routeIs('borrowed') ? 'active' : '' }}">
            {{ __('Borrowed') }}
        </a>

        <!-- Students -->
        <a href="{{ route('students') }}" class="nav-link {{ request()->routeIs('students') ? 'active' : '' }}">
            {{ __('Students') }}
        </a>

        <!-- History -->
        <a href="{{ route('history') }}" class="nav-link {{ request()->routeIs('history') ? 'active' : '' }}">
            {{ __('History') }}
        </a>

        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                {{ __('Log Out') }}
            </a>
        </form>
    </div>
</nav>

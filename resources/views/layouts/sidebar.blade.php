<aside class="sidebar" id="sidebar">
    <div class="sidebar-header" style="padding-bottom: 5px; overflow: hidden; white-space: nowrap;">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; display: flex; align-items: center; color: inherit;">
            <div class="sidebar-logo-box" style="margin-left: 10px; flex-shrink: 0;">
                <img src="{{ secure_asset('assets/img/full-logo.png') }}" 
                     alt="Icon" 
                     style="width: auto; height: 40px; object-fit: contain; padding-left: 5px; padding-bottom: 5px;">
            </div>
        </a>
    </div>

    {{-- Tombol Toggle Desktop --}}
    <button class="sidebar-toggle" id="sidebarToggle">
        <span id="toggleIcon">⮜</span>
    </button>

    <nav>
        <ul>
            <li>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span class="icon"><i data-lucide="layout-dashboard"></i></span>
                    <span class="label">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('journal') }}" class="{{ request()->routeIs('journal') ? 'active' : '' }}">
                    <span class="icon"><i data-lucide="book-open"></i></span>
                    <span class="label">Journal</span>
                </a>
            </li>
            <li>
                <a href="{{ route('bmi') }}" class="{{ request()->routeIs('bmi') ? 'active' : '' }}">
                    <span class="icon"><i data-lucide="activity"></i></span>
                    <span class="label">BMI Calculator</span>
                </a>
            </li>
            <li>
                <a href="{{ route('input.data') }}" class="{{ request()->routeIs('input.data') ? 'active' : '' }}">
                    <span class="icon"><i data-lucide="plus-circle"></i></span>
                    <span class="label">Input Data</span>
                </a>
            </li>
            <li>
                <a href="{{ route('tips') }}" class="{{ request()->routeIs('tips') ? 'active' : '' }}">
                    <span class="icon"><i data-lucide="lightbulb"></i></span>
                    <span class="label">Wellness Tips</span>
                </a>
            </li>
        </ul>
    </nav>
</aside>

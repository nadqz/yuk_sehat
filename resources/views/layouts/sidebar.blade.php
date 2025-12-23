<aside class="sidebar" id="sidebar">
    <div class="sidebar-header" style="padding-bottom: 10px; overflow: hidden; white-space: nowrap; border-bottom: 1px solid var(--platinum-line); margin-bottom: 20px;">
        <a href="{{ route('dashboard') }}" style="text-decoration: none; display: flex; align-items: center; color: inherit;">
            <div class="sidebar-logo-box" style="margin-left: 5px; flex-shrink: 0;">
                {{-- Ukuran logo diperkecil dari 50px ke 38px --}}
                <img src="{{ secure_asset('assets/img/full-logo.png') }}" 
                     alt="Icon" 
                     style="width: auto; height: 38px; object-fit: contain;">
            </div>
        </a>
    </div>

    {{-- Tombol Toggle Desktop --}}
    <button class="sidebar-toggle" id="sidebarToggle">
        <span id="toggleIcon" style="font-size: 10px;">⮜</span>
    </button>

    <nav>
        <ul style="list-style: none; padding: 0; margin: 0;">
            @php
                $menus = [
                    ['route' => 'dashboard', 'icon' => 'layout-dashboard', 'label' => 'Dashboard'],
                    ['route' => 'journal', 'icon' => 'book-open', 'label' => 'Journal'],
                    ['route' => 'bmi', 'icon' => 'activity', 'label' => 'BMI Calculator'],
                    ['route' => 'input.data', 'icon' => 'plus-circle', 'label' => 'Input Data'],
                    ['route' => 'tips', 'icon' => 'lightbulb', 'label' => 'Wellness Tips'],
                ];
            @endphp

            @foreach($menus as $menu)
            <li style="margin-bottom: 5px;">
                <a href="{{ route($menu['route']) }}" 
                   class="{{ request()->routeIs($menu['route']) ? 'active' : '' }}"
                   style="display: flex; align-items: center; gap: 12px; padding: 10px 14px; text-decoration: none; border-radius: 10px; font-size: 0.9rem;">
                    <span class="icon" style="display: flex; align-items: center;">
                        {{-- Ukuran icon lucide disesuaikan --}}
                        <i data-lucide="{{ $menu['icon'] }}" style="width: 18px; height: 18px;"></i>
                    </span>
                    <span class="label">{{ $menu['label'] }}</span>
                </a>
            </li>
            @endforeach
        </ul>
    </nav>
</aside>

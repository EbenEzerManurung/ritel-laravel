@php
    $userRole = session('user_role');
    $currentUrl = request()->path();
    
    $menus = [
        ['url' => '/dashboard', 'name' => 'Dashboard', 'icon' => 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6', 'roles' => ['admin', 'kasir']],
        ['url' => '/customers', 'name' => 'Customer', 'icon' => 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z', 'roles' => ['admin', 'kasir']],
        ['url' => '/products', 'name' => 'Produk', 'icon' => 'M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z', 'roles' => ['admin']],
        ['url' => '/transaction', 'name' => 'Transaksi Baru', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2', 'roles' => ['admin', 'kasir']],
        ['url' => '/history', 'name' => 'Riwayat', 'icon' => 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01', 'roles' => ['admin', 'kasir']],
    ];
    
    $filteredMenus = array_filter($menus, function($menu) use ($userRole) {
        return in_array($userRole, $menu['roles']);
    });
@endphp

<aside class="w-64 bg-white shadow-lg">
    <div class="p-6 border-b text-center">

        <div class="flex justify-center mb-4">
            <img
                src="{{ asset('favicon.png') }}"
                alt="Logo Ritel Laravel"
            class="w-12 h-12 object-contain"
            >
        </div>

        <h1 class="text-2xl font-bold text-gray-800">
            Ritel Laravel
        </h1>
        <p class="text-sm text-gray-600 mt-1">Role: {{ ucfirst($userRole) }}</p>
    </div>
    
    <nav class="p-4 space-y-2">
        @foreach($filteredMenus as $menu)
            <a href="{{ $menu['url'] }}" 
               class="flex items-center space-x-3 px-4 py-3 rounded-lg transition-colors {{ $currentUrl == ltrim($menu['url'], '/') ? 'bg-blue-600 text-white' : 'text-gray-700 hover:bg-gray-100' }}">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $menu['icon'] }}"></path>
                </svg>
                <span>{{ $menu['name'] }}</span>
            </a>
        @endforeach
        
        <form action="{{ url('/logout') }}" method="POST" class="mt-4">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-red-600 hover:bg-red-50 transition-colors">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
            </button>
        </form>
    </nav>
</aside>

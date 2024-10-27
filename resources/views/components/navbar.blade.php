<nav class="bg-gray-800 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo or Brand Name -->
            <div class="flex-shrink-0">
                <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                    I-Commerce
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden md:block">
                <div class="ml-10 flex space-x-4 align-middle">
                    <a href="{{ route('home') }}"
                       class="{{ request()->routeIs('home') ? 'text-blue-400' : 'text-gray-300' }} hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                        Home
                    </a>
                    <a href="{{ route('cart') }}"
                       class="{{ request()->routeIs('services') ? 'text-blue-400' : 'text-gray-300' }} hover:text-white px-3 py-2 rounded-md text-sm font-medium">
                       Cart
                    </a>
                    <a href="{{ route('xd') }}">
                        <img src="https://i.pinimg.com/736x/95/d2/ca/95d2caa85fd7870a892638d995630396.jpg" alt="" class="w-10 h-10 rounded-full">
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>

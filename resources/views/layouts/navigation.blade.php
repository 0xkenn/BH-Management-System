<nav x-data="{ open: false, modalOpen: false }" class="bg-white border-b border-gray-100 z-10">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Search Form -->
            <form method="post" action="#" role="search" class="form-control flex-1 mx-4">
                <input type="text" placeholder="Search" class="input input-bordered w-full md:w-auto mt-2" />
            </form>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('user.dashboard')" :active="request()->routeIs('user.dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
    </div>

</nav>

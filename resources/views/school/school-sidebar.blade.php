<aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-slate-100 dark:bg-gray-800 md:block">
    <div class="py-4 text-gray-500 dark:text-gray-400">

        <ul class="mt-6">
            <li class="relative px-6 py-3 {{ request()->routeIs('school.dashboard') ? 'text-green-500' : '' }}">
                <a class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200" href="{{route('school.dashboard')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 {{ request()->routeIs('school.dashboard') ? 'text-green-500' : '' }}">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                    </svg>
                    <span class="ml-4">Dashboard</span>
                </a>
            </li>
        </ul>
        <div class="px-6 my-6">
            <form method="post" action="{{ route('school.logout') }}">
                @csrf
                <button class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green" onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</aside>

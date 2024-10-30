<aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-slate-100 dark:bg-gray-800 md:block ">

  <div class="py-4 text-gray-500 dark:text-gray-400">
      <ul class="mt-6">

      <li class="relative px-6 py-3">
              <a
                  class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                  @if(request()->routeIs('useredit')) text-green-500 @endif"
                  href="{{ route('useredit', $user) }}"
              >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                      class="size-6 @if(request()->routeIs('useredit')) text-green-500 @endif">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                  </svg>
                  <span class="ml-4">Profile</span>
              </a>
          </li>
        

          <li class="relative px-6 py-3">
              <a
                  class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                  @if(request()->routeIs('room.list')) text-green-500 @endif"
                  href="{{ route('room.list') }}"
              >
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                      class="size-6 @if(request()->routeIs('user.dashboard')) text-green-500 @endif">
                      <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                  </svg>
                  <span class="ml-4">Dashboard</span>
              </a>
          </li>
      </ul>

      <ul>
          <li class="relative px-6 py-3">
              <a
                  class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                  @if(request()->routeIs('notifications')) text-green-500 @endif"
                  href="{{ route('notifications') }}"
              >
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                      class="size-6 @if(request()->routeIs('notifications')) text-green-500 @endif">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
                  </svg>
                  <span class="ml-4">Notification</span>
              </a>
          </li>

          <li class="relative px-6 py-3">
            <a
                class="inline-flex items-center w-full text-sm font-semibold transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200
                @if(request()->routeIs('reservation.list')) text-green-500 @endif"
                href="{{ route('reservation.list') }}"
            >
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
              </svg>
              
                <span class="ml-4">Reservation List</span>
            </a>
        </li>

          
      </ul>

      <div class="px-6 my-6">
          <form method="post" action="{{ route('logout') }}">
              @csrf
              <button
                  class="flex items-center justify-center w-full px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-green-600 border border-transparent rounded-lg active:bg-green-600 hover:bg-green-700 focus:outline-none focus:shadow-outline-green"
                  onclick="event.preventDefault(); this.closest('form').submit();"
              >
                  {{ __('Log Out') }}
              </button>
          </form>
      </div>
  </div>
</aside>


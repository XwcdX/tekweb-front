<nav class="bg-white border-gray-200 z-50">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <!-- Logo Section -->
        <a href="{{ route('home') }}" class="flex items-center space-x-3 rtl:space-x-reverse">
            <span class="self-center text-2xl font-semibold whitespace-nowrap text-gray-900">INFORMATICS CONNECT</span>
        </a>

        <!-- Navbar Links -->
         <!-- Ganti route -->
        <div class="hidden md:flex items-center space-x-8 rtl:space-x-reverse">
            <a href="{{route('home')}}" class="text-gray-900 hover:text-gray-700">Home</a>
            <a href="{{route('popular')}}" class="text-gray-900 hover:text-gray-700">Popular</a>
            <a href="{{route('askPage')}}" class="text-gray-900 hover:text-gray-700">Ask a Question</a>
        </div>


        <!-- Search Input  -->
        <div class="hidden md:flex items-center">
            <input type="text" placeholder="Search..."
                class="px-4 py-2 rounded-s-lg border border-gray-300 focus:outline-none focus:ring-1 focus:ring-[#485d93]-500 text-sm">
            <button type="submit"
                class="text-gray-900 bg-gray-100 hover:bg-gray-200  px-3 py-2 rounded-e-lg focus:outline-none">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </div>

        @if (!session()->has('email'))
            <!-- Sign Up Button -->
            <a href="{{ route('loginOrRegist') }}"
                class="text-white hover:text-[#485d93] hover:bg-[#a8bcf3] bg-[#7494ec] font-medium rounded-lg text-sm px-4 py-2">
                Sign Up
            </a>
        @else

            <!-- User Action -->
            <div class="relative ml-3">
                <div>
                    <button type="button"
                        class="relative flex rounded-full bg-gray-800 text-sm focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800"
                        id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                        <span class="sr-only">Open user menu</span>
                        <img class="size-8 rounded-full" src="{{asset('san.jpeg')}}" alt="User avatar">
                    </button>
                </div>

                <!-- Dropdown Menu -->
                <div class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5"
                    id="user-menu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button">
                    <div class="py-1" role="none">
                        <!-- Ganti route -->
                        <a href="#profile" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem">Profile</a>
                        <a href="#" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem">Settings</a>
                        <a href="{{route('logout')}}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem">Sign
                            out</a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</nav>

<script>
    const userMenuButton = document.getElementById('user-menu-button');
    const userMenu = document.getElementById('user-menu');

    userMenuButton.addEventListener('mouseenter', () => {
        userMenu.classList.remove('hidden');
    });
    userMenu.addEventListener('mouseleave', () => {
        userMenu.classList.add('hidden');
    });

</script>
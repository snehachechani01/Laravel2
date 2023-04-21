<nav class="flex items-center justify-between flex-wrap bg-gray-100 p-6">
    <div class="flex items-center flex-shrink-0 text-gray-800 mx-auto">
        <span class="font-extrabold text-4xl tracking-tight">BOOK STORE</span>
    </div>
    <div class="navbar-menu hidden lg:flex lg:items-center lg:w-auto">
        <div class="text-sm lg:flex-grow">
            <a href="{{ route('login') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-gray-900 mr-4 py-3 px-4 rounded-md bg-gray-200 hover:bg-gray-300">
                Login
            </a>
            <a href="{{ route('register') }}" class="block mt-4 lg:inline-block lg:mt-0 text-gray-700 hover:text-gray-900 mr-4 py-3 px-4 rounded-md bg-gray-200 hover:bg-gray-300">
                Register
            </a>
        </div>
    </div>
</nav>

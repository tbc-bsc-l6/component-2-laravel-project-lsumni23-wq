<div class="flex justify-center mt-6">
    @if (Route::has('login'))
        <nav class="flex items-center gap-4">
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="inline-block px-5 py-1.5 text-[#1b1b18] border 
                        border-transparent hover:border-[#19140035] 
                        rounded-sm text-sm leading-normal cursor-pointer">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block px-5 py-1.5 text-[#1b1b18] border 
                    border-transparent hover:border-[#19140035] 
                    rounded-sm text-sm leading-normal">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="inline-block px-5 py-1.5 text-[#1b1b18] border 
                    border-transparent hover:border-[#19140035] 
                    rounded-sm text-sm leading-normal">
                    Register
                </a>
            @endauth
        </nav>
    @endif
</div>

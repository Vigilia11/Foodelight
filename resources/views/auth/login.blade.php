<x-guest-layout>
    <div class="w-full md:min-h-screen md:flex md:items-center md:justify-center bg-white">
        <div class="px-4 md:px-7 py-4 bg-white md:border md:border-gray-100  md:shadow-lg relative">
            <div class=" w-full flex justify-center">
                <div class="h-28 w-28 rounded-full  bg-white text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-full h-full   ">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
            
            <form method="POST" action="{{ route('login') }}" class="h-full flex flex-wrap">
                @csrf
                <div class="items-start block w-full">
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4" :status="session('status')" />
                    <!-- Email Address -->
                    <div class="mb-5 space-y-2">
                        <label for="email" class="font-medium text-gray-500">Email</label>
                        <input type="email" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                        @error('email')
                            <span class="block text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-10 space-y-2">
                        <label for="password" class="font-medium text-gray-500  ">Password</label>
                        <input type="password" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded" id="password" name="password" :value="old('password')" required autofocus autocomplete="password" />
                        @error('password')
                            <span class="block text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                                
                <div class="items-end block w-full">
                    <div class="block mb-3 text-center">                    
                        @if (Route::has('password.request'))
                            <a class="block hover:underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 rounded-md" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                    <div class="w-full mb-3">
                        <button type="submit" class="w-full py-1 font-medium text-center text-white bg-lime-600 hover:bg-lime-500">Login</button>
                    </div>
                    <div class="block text-center">
                        <a class="block hover:underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 rounded-md" href="{{ route('register') }}">
                            Don't have account?Register
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
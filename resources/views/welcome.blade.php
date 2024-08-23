<x-guest-layout>
    <style>
        .border-gradient{
            border-image: linear-gradient(#f6b73c, black) 30;
            border-width: 1px;
            border-style: solid;
        }
    </style>
    <div class="max-w-6xl mx-auto flex items-center min-h-screen">
                <div class="w-full">
                <div class="grid grid-cols-2">                    
                    <div class="col-span-1">
                        <div class="w-full h-full flex justify-center items-center">
                            <div class="text-center space-y-2">
                                <span class="text-md text-gray-400 block tracking-widest">TASTE & DELIGHT</span>
                                <div class="text-center">
                                    <h1 class="inline text-7xl font-thin text-black">Gourmet</h1>
                                    <h1 class="inline text-7xl font-thin text-lime-600">Cuisine</h1>
                                </div>
                                <span class="block text-md text-gray-800">Smiles are always in passion</span>
                                <div class="pt-4">
                                    <a href="{{ route('login') }}" class="px-4 py-2 text-xs bg-black text-white tracking-widest font-medium" >SHOP NOW</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-1">
                        <div class="w-3/4 mx-auto border-gradient px-7 py-12 rounded-lg">
                            <form method="POST" action="{{ route('login') }}" class="h-full flex flex-wrap">
                                @csrf
                                <div class="items-start block w-full">
                                    <!-- Session Status -->
                                    <x-auth-session-status class="mb-4" :status="session('status')" />
                                    <!-- Email Address -->
                                    <div class="mb-5 space-y-2">
                                        <label for="email" class="text-gray-600">Email</label>
                                        <input type="email" class="block w-full border border-gray-300 focus:ring-blue-300 focus:border-blue-300 py-1.5 rounded" id="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                        @error('email')
                                            <span class="block text-red-500">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <!-- Password -->
                                    <div class="mb-10 space-y-2">
                                        <label for="password" class="text-gray-600  ">Password</label>
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
                                        <button type="submit" class="w-full py-1 font-medium text-center text-white bg-gradient-to-r from-lime-950 to-lime-600 hover:bg-lime-500">Login</button>
                                    </div>
                                    <div class="block text-center">
                                        <a class="block hover:underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-100 rounded-md" href="{{ route('register') }}">
                                            Don't have account?Register
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!--<img src="{{ asset('images/dessert.jpg') }}" class="w-full h-96" alt="">-->
                    </div>
                </div>
                </div>
            </div>
</x-guest-layout>
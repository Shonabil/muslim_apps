<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/3 flex flex-col items-center justify-center px-4 pb-6 md:pb-0">
                <div class="bg-gradient-to-r from-[#31B7C2] to-[#2aa8b2] p-1 rounded-lg mb-4 w-full">
                    <h2 class="text-3xl font-bold text-white px-6 py-3 text-center">أهلاً وسهلاً</h2>
                    <p class="text-white text-center text-sm pb-1">Welcome Back</p>
                </div>

                <div class="mt-6 hidden md:block">
                    <svg width="120" height="120" viewBox="0 0 120 120" class="text-[#31B7C2]">
                        <circle cx="60" cy="60" r="50" fill="none" stroke="currentColor" stroke-width="2"/>
                        <path d="M60 10 L60 110 M10 60 L110 60" stroke="currentColor" stroke-width="2"/>
                        <path d="M26 26 L94 94 M26 94 L94 26" stroke="currentColor" stroke-width="2"/>
                        <circle cx="60" cy="60" r="20" fill="none" stroke="currentColor" stroke-width="2"/>
                        <circle cx="60" cy="60" r="10" fill="currentColor"/>
                    </svg>
                </div>

                <!-- Additional info text -->
                <p class="text-[#31B7C2] text-center mt-6 font-medium hidden md:block">Secure access to your account</p>
            </div>

            <!-- Right side with login form -->
            <div class="md:w-2/3 md:pl-8 border-t md:border-t-0 md:border-l border-[#a8e4e9] md:pl-10 pt-6 md:pt-0">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" class="text-[#2a9ba5] font-semibold text-base" />
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#31B7C2]" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                </svg>
                            </div>
                            <x-text-input id="email" class="block mt-1 w-full pl-10 pr-3 py-3 border border-[#a8e4e9] rounded-lg shadow-sm placeholder-[#7accd3] focus:outline-none focus:ring-[#31B7C2] focus:border-[#31B7C2] bg-white bg-opacity-90" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="you@example.com" />
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div class="mt-5">
                        <x-input-label for="password" :value="__('Password')" class="text-[#2a9ba5] font-semibold text-base" />
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#31B7C2]" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <x-text-input id="password" class="block mt-1 w-full pl-10 pr-3 py-3 border border-[#a8e4e9] rounded-lg shadow-sm placeholder-[#7accd3] focus:outline-none focus:ring-[#31B7C2] focus:border-[#31B7C2] bg-white bg-opacity-90" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mt-5">
                        <div class="flex items-center">
                            <input id="remember_me" type="checkbox" class="h-5 w-5 rounded border-[#a8e4e9] text-[#31B7C2] focus:ring-[#31B7C2]" name="remember">
                            <label for="remember_me" class="ml-2 block text-sm text-[#2a9ba5] font-medium">{{ __('Remember me') }}</label>
                        </div>

                        <!-- Create new account -->
                        <div>
                            <a href="{{ route('register') }}" class="text-sm font-bold text-[#31B7C2] hover:text-[#2aa8b2] underline">
                                Create account
                            </a>
                        </div>
                    </div>



                    <!-- Login Button -->
                    <div class="mt-6">
                        <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-md text-base font-medium text-white bg-[#31B7C2] hover:bg-[#2aa8b2] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#31B7C2] transform transition hover:scale-105">
                            {{ __('Sign in') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
</x-guest-layout>

<x-guest-layout>
    <div class="bg-white p-8 rounded-lg shadow-md max-w-md w-full mx-auto">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">{{ __('Create an Account') }}</h1>
            <p class="text-gray-600 mt-2">{{ __('Join us to start your journey') }}</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Full Name')" class="text-gray-700 font-medium" />
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="name" class="block mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Enter your name" />
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email Address')" class="text-gray-700 font-medium" />
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                    </div>
                    <x-text-input id="email" class="block mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500" type="email" name="email" :value="old('email')" required autocomplete="username" placeholder="your.email@example.com" />
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-medium" />
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="password" class="block mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500" type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                <p class="text-xs text-gray-500 mt-1">{{ __('Password must be at least 8 characters') }}</p>
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-medium" />
                <div class="mt-1 relative rounded-md shadow-sm">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <x-text-input id="password_confirmation" class="block mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:ring-teal-500" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••" />
                </div>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div>
                <label class="inline-flex items-center">
                    <input type="checkbox" class="rounded border-gray-300 text-teal-500 shadow-sm focus:ring-teal-500" name="terms">
                    <span class="ml-2 text-sm text-gray-600">{{ __('I agree to the') }} <a href="#" class="text-teal-500 hover:text-teal-400">{{ __('Terms of Service') }}</a> {{ __('and') }} <a href="#" class="text-teal-500 hover:text-teal-400">{{ __('Privacy Policy') }}</a></span>
                </label>
            </div>

            <div>
                <x-primary-button class="w-full flex justify-center py-3 px-4" style="background-color: rgb(49, 183, 194); hover:background-color: rgb(44, 164, 175);">
                    {{ __('Create Account') }}
                </x-primary-button>
            </div>

            <div class="flex items-center justify-center mt-4">
                <span class="text-sm text-gray-600">{{ __('Already have an account?') }}</span>
                <a class="ml-2 text-sm font-medium text-teal-500 hover:text-teal-400" href="{{ route('login') }}">
                    {{ __('Sign in') }}
                </a>
            </div>


        </form>
    </div>
</x-guest-layout>

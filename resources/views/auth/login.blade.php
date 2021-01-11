<x-app-layout>
    <div class="my-16 flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="mb-6">
            <a href="{{ route('web.home.index') }}">
                <img class="block h-16" src="{{ asset('images/logo-text.svg') }}" alt="{{ config('app.name', 'PrivBin') }}">
            </a>
        </div>
        <div class="w-full sm:max-w-lg mt-6 px-6 py-1 bg-gray-100 shadow-md overflow-hidden sm:rounded-lg">
            @foreach ($errors->all() as $error)
                <div class="text-center py-4">
                    <div class="block w-full p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.error') }}</span>
                        <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                    </div>
                </div>
            @endforeach
            <div class="my-3">
                @if (session('status'))
                    <div class="text-center py-4">
                        <div class="block w-full p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.success') }}</span>
                            <span class="font-semibold mr-2 text-left flex-auto">{{ session('status') }}</span>
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2 text-gray-900 text-sm">{{ __('privbin.email') }}</span>
                            <input type="email" name="email" placeholder="{{ __('privbin.email') }}" value="{{ old('email') }}" required autofocus class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2 text-gray-900 text-sm">{{ __('privbin.password') }}</span>
                            <input type="password" name="password" placeholder="{{ __('privbin.password') }}" required autocomplete="current-password" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        </label>
                    </div>

                    <div class="block mt-4 select-none">
                        <label for="remember_me" class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-600">{{ __('privbin.remember') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-jet-button class="ml-4">
                            {{ __('privbin.login') }}
                        </x-jet-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

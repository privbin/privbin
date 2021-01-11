<x-app-layout>
    <div class="container">
        <div class="my-5">
            @foreach ($errors->all() as $error)
                <div class="text-center py-4">
                    <div class="block w-full p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                        <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.error') }}</span>
                        <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                    </div>
                </div>
            @endforeach
            @if (session()->has('success'))
                @foreach(session()->get('success') as $success)
                    <div class="text-center py-1">
                        <div class="block w-full p-2 bg-green-800 items-center text-green-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                            <span class="flex rounded-full bg-green-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.success') }}</span>
                            <span class="font-semibold mr-2 text-left flex-auto">{!! $success !!}</span>
                        </div>
                    </div>
                @endforeach
            @endif
            <form action="{{ route('web.entry.access', $entry) }}" method="post">
                @csrf
                <div class="block w-full relative mb-3">
                    <label>
                        <span class="block mx-1 py-2 text-sm">{{ __('privbin.password') }}</span>
                        <input type="password" name="password" placeholder="{{ __('privbin.password') }}" required autofocus class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                    </label>
                </div>
                <button type="submit" class="block w-full text-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                    {{ __('privbin.view') }}
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

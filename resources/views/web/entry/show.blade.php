<x-app-layout>
    <div class="container py-3">
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
        <div>
            @if (Auth::check() && $entry->user != null && $entry->user->id == Auth::id())
                <a href="{{ route("web.entry.edit", $entry) }}" class="block w-full text-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disable:opacity-25 transition ease-in-out duration-150">
                    {{ __("privbin.edit") }}
                </a>
            @endif
        </div>
        <iframe class="my-3 w-full" src="{{ route('web.entry.embed', $entry).'?theme=dark&'.http_build_query(request()->all()) }}" frameborder="0"></iframe>
        <div class="mt-4">
            <a href="#" onclick="event.preventDefault(); openModal('#delete_modal')" class="block w-full text-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('privbin.delete') }}
            </a>
            <div class="hidden modal fixed z-10 inset-0 overflow-y-auto" id="delete_modal">
                <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                        <div class="backdrop absolute inset-0 bg-gray-500 opacity-75 ease-out duration-200"></div>
                    </div>
                    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                    <form action="{{ route('web.entry.destroy', $entry) }}" method="post" class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                        @csrf
                        @method('delete')
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                    <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                    <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                                        {{ __('privbin.delete_entry_title') }}
                                    </h3>
                                    <div class="mt-2">
                                        <p class="text-sm text-gray-500 mb-2">
                                            {{ __('privbin.delete_entry_text') }}
                                        </p>
                                        <div class="block w-full relative">
                                            <input type="text" name="token" placeholder="{{ __('privbin.token') }}" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                            <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ __('privbin.delete') }}
                            </button>
                            <a href="#" onclick="event.preventDefault(); closeModal('#delete_modal')" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                {{ __('privbin.cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <form action="{{ route("web.entry.update", $entry) }}" method="post">
        @csrf
        @method("PUT")
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

            <div class="block w-full relative mb-3">
                <textarea id="editor_contents" name="content" class="hidden">{{ old("content") ?? $entry->content }}</textarea>
                <label>
                    <div id="editor" class="text-gray-200 bg-gray-800 border-gray-900 appearance-none border-2 rounded w-full py-2 px-4 leading-tight focus:outline-none focus:border-purple-500">{{ old("content") ?? $entry->content }}</div>
                </label>
            </div>

            <div class="block w-full relative">
                <label>
                    <span class="block mx-1 py-2">{{ __('privbin.format') }}</span>
                    <select name="format" class="text-gray-200 bg-gray-800 border-gray-900 focus:border-purple-500 block appearance-none w-full border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                        @foreach ($highlighters as $class => $highlighter)
                            <option value="{{ $highlighter->getName() }}" {{ $highlighter->getName() == $entry->format ? "selected" : null }}>
                                {{ __('highlighters.'.$highlighter->getName()) }}
                            </option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="block w-full relative">
                <label>
                    <span class="block mx-1 py-2">{{ __("privbin.title") }}</span>
                    <input name="title" type="text" placeholder="{{ __("privbin.title") }}" value="{{ old("title") ?? $entry->title }}" class="text-gray-200 bg-gray-800 border-gray-900 focus:border-purple-500 block appearance-none w-full border px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                </label>
            </div>

            <button type="submit" class="mt-7 block w-full text-center px-4 py-3 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-900 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                {{ __('privbin.save') }}
            </button>

        </div>
    </form>
</x-app-layout>

<x-app-layout>
    <div class="mx-auto flex flex-wrap overflow-hidden">
        <div class="w-full overflow-hidden lg:w-8/12 xl:w-9/12">
            <form action="{{ route('web.entry.store') }}" method="post">
                @csrf
                <div class="py-5">

                    @foreach($errors->all() as $error)
                        <div class="text-center py-4">
                            <div class="block w-full p-2 bg-red-800 items-center text-red-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                                <span class="flex rounded-full bg-red-500 uppercase px-2 py-1 text-xs font-bold mr-3">{{ __('privbin.error') }}</span>
                                <span class="font-semibold mr-2 text-left flex-auto">{{ $error }}</span>
                            </div>
                        </div>
                    @endforeach

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.format') }}</span>
                            <select name="format" class="text-gray-900 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach ($compilers as $compiler)
                                    <option value="{{ get_class($compiler) }}" {{ $compiler->compilerName == 'plain_text' ? 'selected' : '' }}>
                                        {{ __('privbin.'.$compiler->compilerName) }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.content') }}</span>
                            <textarea name="content" placeholder="{{ __('privbin.content') }}" style="min-height: 300px" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">{{ old('content') }}</textarea>
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.expires') }}</span>
                            <select name="expires" class="text-gray-900 block appearance-none w-full bg-white border border-gray-400 hover:border-gray-500 px-4 py-2 pr-8 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
                                @foreach(\App\Enums\Expire::asArray() as $expire)
                                    <option value="{{ $expire }}">
                                        {{ __('privbin.expire_after_'.$expire) }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>

                    <div class="block w-full relative">
                        <label>
                            <span class="block mx-1 py-2">{{ __('privbin.password') }}</span>
                            <input type="password" name="password" placeholder="{{ __('privbin.password') }}" class="appearance-none border-2 border-gray-200 rounded w-full py-2 px-4 text-gray-700 leading-tight focus:outline-none focus:bg-white focus:border-purple-500">
                        </label>
                    </div>

                    <div class="mt-6 w-full block">
                        <button type="submit" class="block w-full bg-purple-700 hover:bg-purple-600 text-gray-200 font-semibold py-2 px-4 border border-purple-500 rounded shadow transition">
                            {{ __('privbin.save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
        <div class="w-full overflow-hidden lg:w-4/12 xl:w-3/12 px-0 lg:px-8 py-10">
            <div class="card w-full my-4">
                <div class="card-body inline-block">
                    <div class="p-6">
                        <img src="{{ url("images/welcome.svg") }}" alt="" class="w-full">
                    </div>
                    <div class="text-xl mb-2 mx-2">Hi there!</div>
                    <div class="mb-4 mx-2 text-gray-200">
                        Please <a href="{{ route("login") }}">login</a> or <a href="{{ route("register") }}">register</a> to save your notes, long time store and more features.
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

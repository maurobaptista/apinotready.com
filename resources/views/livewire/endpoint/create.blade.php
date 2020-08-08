<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label for="email" class="text-sm">
                Email (not required)
            </label>
            <input wire:model="email" name="email" type="email"
                   class="
                        w-full py-2 px-3 text-gray-700 leading-tight
                        appearance-none border-b-2
                        focus:outline-none
                        @error('email') border-red-400
                        @else focus:border-purple-600
                        @enderror
                   ">
            @error('email')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 sm:inline-flex w-full">
            <div class="w-full sm:w-32 mb-4 sm:mb-0">
                <label for="method" class="text-sm">
                    Method
                </label>
                <div class="nline-block relative mr-4">
                    <select wire:model="method" name="method"
                        class="
                            block appearance-none w-full bg-white border-b-2
                            px-4 py-2 pr-8 leading-tight focus:outline-none focus:shadow-outline
                            @error('method') border-red-400
                            @else focus:border-purple-600
                            @endif
                        ">
                            @foreach ($methods as $method)
                                <option value="{{ $method }}">{{ $method }}</option>
                            @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                    </div>
                </div>
            </div>
            <div class="flex-grow">
                <label for="segments" class="text-sm">
                    Endpoint
                </label>
                <input wire:model="segments" name="segments" type="text"
                   class="
                        w-full py-2 px-3 text-gray-700 leading-tight
                        appearance-none border-b-2
                        focus:outline-none
                        @error('endpoint') border-red-400
                        @else focus:border-purple-600
                        @enderror
                   "
            >
            </div>
        </div>

        <div class="mb-4">
            <div class="flex justify-between">
                <div>
                    <label for="body" class="text-sm">Response</label>
                </div>
                <div>
                    <label for="body" class="font-sans">Code:</label>
                    <div class="inline-block w-20 relative">
                        <select wire:model="code" name="code"
                                class="
                                    block appearance-none w-full bg-white border-b-2
                                    px-2 py-1 pr-8 leading-tight focus:outline-none focus:shadow-outline
                                    @error('code') border-red-400
                                    @else focus:border-purple-600
                                    @enderror
                                ">
                            @foreach ($responses as $responseCode => $responseDescription)
                                <option value="{{ $responseCode }}">[{{ $responseCode }}] {{ $responseDescription }}</option>
                            @endforeach
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-1 text-white-700">
                            <svg class="fill-current h-4 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <textarea wire:model="body" name="body" rows="4"
                      class="
                        w-full py-2 px-3 text-gray-700 leading-tight
                        appearance-none border-b-2
                        focus:outline-none
                        @error('endpoint') border-red-400
                        @else focus:border-purple-600
                        @enderror
                      ">
            </textarea>
        </div>

        @error('method')
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2" role="alert">{{ $message }}</div>
        @enderror

        @error('segments')
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2" role="alert">{{ $message }}</div>
        @enderror

        @error('response')
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2" role="alert">{{ $message }}</div>
        @enderror

        @error('body')
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2" role="alert">{{ $message }}</div>
        @enderror

        <button type="submit"
                class="
                    bg-purple-600 text-white font-bold py-2 px-4 rounded mt-4
                    hover:bg-opacity-75
                ">
            Save Endpoint
        </button>
    </form>

    @if ($recentCreatedEndpoint && is_array($endpoint))
        <div>
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 my-6" role="alert">
                Endpoint Created
            </div>

            <div class="text-sm">
                Endpoint: <span class="inline-block {{ strtolower($endpoint['method']) }} rounded-full px-3 py-0 font-semibold text-gray-700 mr-2">
                    {{ $endpoint['method'] }}
                </span>
                <BR>
            </div>
            <div class="font-title text-xl text-purple-600 mt-2">
                <input id="endpointCopy" type="text" class="w-full inline-block focus:outline-none" value="{{ $endpoint['url'] }}" />
                <div class="inline-block relative">
                    <button onclick="copy('endpointCopy')"
                            class="
                                inline-block rounded px-1 py-1 ml-2
                                font-semibold text-white bg-purple-600 hover:bg-purple-800
                                focus:outline-none
                            ">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-4 h-4 fill-current">
                            <path d="M0 0h24v24H0z" fill="none"/>
                            <path d="M16 1H4c-1.1 0-2 .9-2 2v14h2V3h12V1zm3 4H8c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h11c1.1 0 2-.9 2-2V7c0-1.1-.9-2-2-2zm0 16H8V7h11v14z"/>
                        </svg>
                    </button>
                </div>
            </div>
            <div class="text-sm mt-6">
                Response:
                <span class="inline-block bg-gray-200 rounded-full px-3 py-0 font-semibold mr-2">
                    {{ $endpoint['code'] }}
                </span>
                <span>
                    {{ config('endpoint.responses.' . $endpoint['code']) }}
                </span>
                <BR>
            </div>
            {{ json_encode($endpoint['body']) }}
        </div>
    @endif
</div>

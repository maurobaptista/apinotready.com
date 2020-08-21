<div>
    <form wire:submit.prevent="store">
        <x-form.input
            label="Email (not required)"
            name="email"
            type="email"
        />

        <div class="my-4 sm:inline-flex w-full">
            <div class="w-full sm:w-32 sm:mb-0">
                <x-form.select
                    label="Method"
                    name="method"
                    :options="$methods"
                />
            </div>
            <div class="flex-grow">
                <x-form.input
                    label="Endpoint"
                    name="segments"
                />
            </div>
        </div>

        <div class="mb-4">
            <div class="relative">
                <div class="absolute right-0">
                    <x-form.select
                        label="Code:"
                        name="code"
                        display-pattern="[%key%] %value%"
                        :options="$responses"
                    />
                </div>

                <x-form.textarea
                    label="Response:"
                    name="body"
                />
            </div>
        </div>

        @error('email')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
        @enderror

        @error('segments')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
        @enderror

        @error('method')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
        @enderror

        @error('code')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
        @enderror

        @error('body')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
        @enderror

        <button type="submit"
                class="btn">
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
            <div class="font-title text-xl text-purple-600 mt-2 flex">
                <input id="endpointCopy" type="text" class="flex-grow inline-block focus:outline-none" value="{{ $endpoint['url'] }}" />
                <div class="relative">
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
            <div x-data="{body: JSON.stringify(@this.get('endpoint.body'), undefined, 4)}">
            <pre id="body" class="font-mono overflow-x-auto" x-text="body">
            </pre>
            </div>
        </div>
    @endif
</div>

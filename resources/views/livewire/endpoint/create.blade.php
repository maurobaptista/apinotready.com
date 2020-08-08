<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label for="email" class="font-sans text-sm text-gray-700">
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
                <label for="method" class="font-sans text-sm text-gray-700">
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
                <label for="segments" class="font-sans text-sm text-gray-700">
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
                    <label for="body" class="font-sans text-sm text-gray-700">Response</label>
                </div>
                <div>
                    <label for="body" class="font-sans text-sm text-gray-700">Code:</label>
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
                            <svg class="fill-current h-4 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
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

    @if ($recentCreatedEndpoint)
        <div>
            Endpoint Created
        </div>
    @endif
</div>

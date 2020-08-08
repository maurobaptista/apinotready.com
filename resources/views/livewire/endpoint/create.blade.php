<div>
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label for="email">
                Email (not required)
            </label>
            <input wire:model="email" name="email" type="email"
                   class="
                        w-full py-2 px-3 text-gray-700 border rounded leading-tight
                        shadow appearance-none
                        outline-none:focus shadow-outline:focus
                        @error('email') border-red-400 @enderror
                   ">
            @error('email')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4 inline-flex w-full">
            <select wire:model="method" name="method"
                    class="
                        flex flex-1
                        py-2 px-3 text-gray-700 border rounded-l leading-tight
                        shadow appearance-none
                        outline-none:focus shadow-outline:focus
                        @error('method') input-error @enderror
                    "
            >
                @foreach ($methods as $method)
                    <option value="{{ $method }}">{{ $method }}</option>
                @endforeach
            </select>

            <input wire:model="segments" name="segments" type="text"
                   class="
                        flex-grow w-full py-2 px-3 text-gray-700 border rounded-r leading-tight
                        shadow appearance-none
                        outline-none:focus shadow-outline:focus
                        @error('endpoint') input-error @enderror
                   "
            >
        </div>

        <div class="mb-4 relative">
            <label for="body">Response</label>
            <select wire:model="code" name="code"
                    class="
                        absolute
                        right-0
                        w-16
                        @error('response') input-error @enderror
                    ">
                @foreach ($responses as $responseCode => $responseDescription)
                    <option value="{{ $responseCode }}">[{{ $responseCode }}] {{ $responseDescription }}</option>
                @endforeach
            </select>

            <textarea wire:model="body" name="body" rows="4"
                      class="
                          w-full py-2 px-3 text-gray-700 border rounded leading-tight
                          shadow appearance-none
                          outline-none:focus shadow-outline:focus
                          @error('body') input-error @enderror
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

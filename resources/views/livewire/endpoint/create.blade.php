<div>
    <form wire:submit.prevent="store" class="bg-gray-300 p-2">
        <div class="mb-4">
            <label for="email">Email (not required)</label>
            <input wire:model="email" name="email" type="email" class="input @error('email') input-error @enderror">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4 inline-flex">
            <select wire:model="method" name="method"
                    class="
                        flex flex-1
                        rounded-l-md
                        bg-gray-400
                        p-3
                        @error('method') input-error @enderror
                    "
            >
                @foreach ($methods as $method)
                    <option value="{{ $method }}">{{ $method }}</option>
                @endforeach
            </select>

            <input wire:model="segments" name="segments" type="text"
                   class="
                        flex-grow-1 w-full
                        rounded-r-md
                        bg-gray-100
                        p-3
                        @error('endpoint') input-error @enderror
                   "
            >
        </div>

        <div class="mb-4 relative">
            <label for="response">Response</label>
            <select wire:model="response" name="response"
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
                          w-full
                          rounded-md
                          @error('body') input-error @enderror
                      ">
            </textarea>

        </div>

        @error('method')
            <span class="error">{{ $message }}</span>
        @enderror

        @error('segments')
            <span class="error">{{ $message }}</span>
        @enderror

        @error('response')
            <span class="error">{{ $message }}</span>
        @enderror

        @error('body')
            <span class="error">{{ $message }}</span>
        @enderror


        <button type="submit" class="btn">
            Save Endpoint
        </button>
    </form>

    @if ($recentCreatedEndpoint)
        <div>
            Endpoint Created
        </div>
    @endif


</div>

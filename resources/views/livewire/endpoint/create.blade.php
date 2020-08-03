<div>
    <form wire:submit.prevent="submit" class="bg-gray-300 p-2">
        <div class="mb-4">
            <label for="email">Email</label>
            <input wire:model="email" name="email" type="email" class="input @error('email') input-error @enderror">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="endpoint">Endpoint</label>
            <input wire:model="endpoint" name="endpoint" type="text" class="input @error('endpoint') input-error @enderror">
            @error('endpoint')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="method">Method</label>
            <select wire:model="method" name="method" class="input @error('method') input-error @enderror">
                @foreach ($methods as $method)
                    <option value="{{ $method }}">{{ $method }}</option>
                @endforeach
            </select>
            @error('method')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="response">Response</label>
            <select wire:model="response" name="response" class="input @error('response') input-error @enderror">
                @foreach ($responses as $responseCode => $responseDescription)
                    <option value="{{ $responseCode }}">[{{ $responseCode }}] {{ $responseDescription }}</option>
                @endforeach
            </select>
            @error('response')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="body">Body</label>
            <textarea wire:model="body" name="body" rows="4" class="input @error('body') input-error @enderror"></textarea>
            @error('body')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn">
            Save Endpoint
        </button>
    </form>

    @if ($recentCreatedEndpoint)
        <div >
            Endpoint Created
        </div>
    @endif
</div>

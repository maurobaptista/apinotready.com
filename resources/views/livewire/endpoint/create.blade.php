<div>
    <form wire:submit.prevent="submit">
        <label for="email">Email</label>
        <input wire:model="email" name="email" type="email">
        {{ $email }}
        @error('email') <span class="error">{{ $message }}</span> @enderror

        <HR>

        <label for="endpoint">Endpoint</label>
        <input wire:model="endpoint" name="endpoint" type="text">
        {{ $endpoint }}
        @error('endpoint') <span class="error">{{ $message }}</span> @enderror

        <HR>
        <label for="method">Method</label>
        <select wire:model="method" name="method">
            @foreach ($methods as $methodValue)
                <option value="{{ $methodValue }}">{{ $methodValue }}</option>
            @endforeach
        </select>
        {{ $method }}
        @error('method') <span class="error">{{ $message }}</span> @enderror

        <HR>
        <label for="response">Response</label>
        <select wire:model="response" name="response">
            @foreach ($responses as $responseCode => $responseDescription)
                <option value="{{ $responseCode }}">[{{ $responseCode }}] {{ $responseDescription }}</option>
            @endforeach
        </select>
        {{ $response }}
        @error('response') <span class="error">{{ $message }}</span> @enderror
        <HR>
        <label for="body">Body</label>
        <textarea wire:model="body" name="body"></textarea>
        {{ $body }}
        @error('body') <span class="error">{{ $message }}</span> @enderror

        <HR>

        <button type="submit">Save Endpoint</button>
    </form>
</div>

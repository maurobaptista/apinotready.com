<div class="mb-4">
    <label for="{{ $name }}">{{ ucfirst($name) }}</label>
    <input wire:model="{{ $name }}" name="{{ $name }}" type="{{ $type ?? 'text' }}" class="input @error((string) $name) input-error @enderror">
    @error((string) $name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>

<div class="mb-4">
    <label for="{{ $name }}">{{ ucfirst($name) }}</label>
    <textarea wire:model="{{ $name }}" name="{{ $name }}" rows="4" class="input @error((string) $name) input-error @enderror"></textarea>
    @error((string) $name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>

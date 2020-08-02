<div class="mb-4">
    <label for="{{ $name }}">{{ ucfirst($name) }}</label>
    <select wire:model="{{ $name }}" name="{{ $name }}" class="input @error((string) $name) input-error @enderror">
        @foreach ($options as $key => $value)
            <option value="{{ $key }}">{{ isset($display) ? $display($key, $value) : $value }}</option>
        @endforeach
    </select>
    @error((string) $name)
        <span class="error">{{ $message }}</span>
    @enderror
</div>

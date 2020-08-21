<div {{ $attributes }}>
    <label for="{{ $name }}" class="text-sm">{{ $label }}</label>
    <textarea wire:model="{{ $name }}" name="{{ $name }}" rows="4"
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

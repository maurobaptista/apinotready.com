<div>
    <form wire:submit.prevent="submit" class="bg-gray-300 p-2">
        @component('components.input')
            @slot ('name') email @endslot
            @slot ('type') email @endslot
        @endcomponent

        @component('components.input')
            @slot ('name') endpoint @endslot
        @endcomponent

        @component('components.select', [
            'options' => collect($methods)
                ->mapWithKeys(function (string $value) { return [$value => $value];}),
        ])
            @slot ('name') method @endslot
        @endcomponent

        @component('components.select', [
            'options' => $responses,
            'display' => function ($key, $value) {
                return "[$key] $value";
            },
        ])
            @slot ('name') response @endslot
        @endcomponent

        @component('components.textarea')
            @slot ('name') body @endslot
        @endcomponent

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

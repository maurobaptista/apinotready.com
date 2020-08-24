<div>
    <h2 class="text-2xl font-bold mb-4">Auth</h2>

    @unless ($emailSent)
        <div class="mb-4">
            <p>You will receive an email with an url to login into {{ config('app.name') }}.</p>
            <p class="font-bold">Note this url is valid for a short period of time.</p>
        </div>
        <form wire:submit.prevent="send">
            <x-form.input
                label="Email"
                name="email"
                type="text"
            />

            @error('email')
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-2 mt-2" role="alert">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn">
                Request Login Email
            </button>
        </form>
    @else
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-2 mt-2" role="alert">
            Email Sent to {{ $email }}!
        </div>

        <button type="submit" class="btn" wire:click="showForm">
            Request Again
        </button>
    @endunless
</div>

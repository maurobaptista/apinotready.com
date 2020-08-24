<?php

namespace App\Http\Livewire\Auth;

use Illuminate\View\View;
use Livewire\Component;

class Email extends Component
{
    /** @var string */
    public $email;

    /** @var bool */
    public $emailSent = false;

    /** @var string[] */
    protected $listeners = [
        'emailSent' => 'showEmailSent'
    ];

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.auth.email');
    }

    /**
     * Listener
     */
    public function showEmailSent(): void
    {
        $this->emailSent = true;
    }

    /**
     * Hide success message and add form again
     */
    public function showForm(): void
    {
        $this->emailSent = false;
    }

    /**
     * Trigger email with signed url
     */
    public function send(): void
    {
        $email = $this->validate($this->rules())['email'];

        $this->emit('emailSent');
    }

    /**
     * @return array
     */
    private function rules(): array
    {
        return [
            'email' => ['required', 'email'],
        ];
    }
}

<?php

namespace App\Rules;

use App\Models\Endpoint;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class EndpointIsUnique implements Rule
{
    /** @var string|null */
    private $segments;

    /** @var string|null */
    private $method;

    /** @var string|null */
    private $email;

    /**
     * Create a new rule instance.
     *
     * @param string|null $segments
     * @param string|null $method
     * @param string|null $email
     */
    public function __construct(?string $segments, ?string $method, ?string $email)
    {
        $this->segments = $segments;
        $this->method = $method;
        $this->email = $email;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (empty($this->segments) && empty($this->method) && empty($this->email)) {
            return true;
        }

        $user = User::where('email', $this->email)->first();

        if ($user === null) {
            return true;
        }

        return Endpoint::query()
            ->where('user_id', $user->id)
            ->where('method', strtoupper($this->method))
            ->where('segments', trim($this->segments, '/'))
            ->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Endpoint must be unique';
    }
}

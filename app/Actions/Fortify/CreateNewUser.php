<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Notifications\InvoicePaid;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'between:10,13'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();

        // Notification::send(request()->user(), new WelcomeNotification());
        Notification::send(request()->user(), new InvoicePaid());

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'phone_number' => $input['phone'],
            'password' => Hash::make($input['password']),
        ]);
    }
}

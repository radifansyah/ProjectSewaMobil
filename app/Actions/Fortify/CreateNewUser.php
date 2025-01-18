<?php

namespace App\Actions\Fortify;

use App\Models\User;
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
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'account_type' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],        // Validasi untuk address
            'phone_number' => ['required', 'string', 'max:15'],     // Validasi untuk phone_number
            'driver_license' => ['required', 'string', 'max:255'],  // Validasi untuk driver_license
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        // return User::create([
        //     'name' => $input['name'],
        //     'email' => $input['email'],
        //     'account_type' => $input['account_type'],
        //     'password' => Hash::make($input['password']),
        // ]);

        // Buat user baru
        $user = User::create([
            'name' => $input['name'],
            'account_type' => $input['account_type'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
            'address' => $input['address'],          // Menyimpan address
            'phone_number' => $input['phone_number'], // Menyimpan phone_number
            'driver_license' => $input['driver_license'], // Menyimpan driver_license
        ]);

        // Tetapkan peran berdasarkan tipe akun
        if ($input['account_type'] === 'User') {
            $user->assignRole('user');
        } else if ($input['account_type'] === 'Admin') {
            $user->assignRole('admin');
        } else {
            $user->assignRole('user');
        }
        // alert()->success('SuccessAlert','Lorem ipsum dolor sit amet.');

        return $user;
    }


    // Tetapkan peran berdasarkan tipe akun


}

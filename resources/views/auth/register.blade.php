<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="phone" value="{{ __('Phone Number') }}" />
                <x-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required autocomplete="phone" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <div class="relative">
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" oninput="validatePassword()" />
                    <button type="button" onclick="togglePasswordVisibility('password')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        {{ __('Show') }}
                    </button>
                </div>
                <p id="password-strength" class="text-sm mt-1"></p>
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <div class="relative">
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" oninput="validatePasswordMatch()" />
                    <button type="button" onclick="togglePasswordVisibility('password_confirmation')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-sm leading-5">
                        {{ __('Show') }}
                    </button>
                </div>
                <p id="password-match" class="text-sm mt-1"></p>
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-label for="terms">
                        <div class="flex items-center">
                            <x-checkbox name="terms" id="terms" required />

                            <div class="ms-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-label>
                </div>
            @endif

            <div class="flex flex-col items-center mt-4 space-y-2">
                <x-button>
                    {{ __('Register') }}
                </x-button>

                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>

<script>
    function togglePasswordVisibility(id) {
        var passwordField = document.getElementById(id);
        var passwordFieldType = passwordField.type;
        if (passwordFieldType === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    }

    function validatePassword() {
        var password = document.getElementById('password').value;
        var strengthText = document.getElementById('password-strength');
        var regex = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/;

        if (regex.test(password)) {
            strengthText.textContent = 'Strong password';
            strengthText.style.color = 'green';
        } else {
            strengthText.textContent = 'Password must be at least 8 characters long, contain at least one capital letter and one special character.';
            strengthText.style.color = 'red';
        }

        validatePasswordMatch();
    }

    function validatePasswordMatch() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;
        var matchText = document.getElementById('password-match');

        if (password === "") {
            matchText.textContent = '';
        } else if (password === confirmPassword) {
            matchText.textContent = 'Passwords match';
            matchText.style.color = 'green';
        } else {
            matchText.textContent = 'Passwords do not match';
            matchText.style.color = 'red';
        }
    }
</script>

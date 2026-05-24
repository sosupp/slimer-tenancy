<x-guest-layout>
    <div class="register-form-wrapper">
        <div class="register-logo">
            <x-application-logo />
        </div>


        <form class="form-wrapper" method="POST" action="#">
            <x-auth-session-status class="mb-4 success-bg" :status="session('status')" />
            <p class="form-heading">Reset password</p>
            @csrf
            <div class="text-sm text-gray-600">
                {{ __('Forgot your password? No problem. Please enter your email address used for the account and we will email you a password reset link.') }}
            </div>

            <x-inputs.text
                type="email" label="Email" :allowlabel="false"
                id="email" name="email" :value="old('email')"
                autocomplete="email" required autofocus
                placeholder="Email address"
            />

            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="#">
                {{ __('Already registered?') }}
            </a>

            <button type="submit"
                id="registerBtn">
                {{ __('Email Password Reset Link') }}
            </button>

        </form>

    </div>
</x-guest-layout>


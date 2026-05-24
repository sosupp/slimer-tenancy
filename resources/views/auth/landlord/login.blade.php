<x-guest-layout>
    <div class="login-form-wrapper register-form-wrapper">
        <form class="login-form"
            method="POST"
            action="{{route('landlord.login.store')}}">
            @csrf

            <div class="logo-and-domain">
                {{config('app.name') ?? 'Admin'}}
            </div>

            <x-inputs.special.text
                type="email" label="Email" id="email"
                name="email" :value="old('email')" autocomplete="email"
                placeholder=""
            />

            <x-inputs.special.text
                type="password" label="password" id="password"
                name="password" :value="old('password')" placeholder=""
                required
            />

            <button type="submit"
                id="registerBtn">
                login
            </button>

            <span class="footer-message">Contact admin if you have challenges.</span>
        </form>
    </div>
</x-guest-layout>

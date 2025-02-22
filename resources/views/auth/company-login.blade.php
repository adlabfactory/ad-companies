<x-guest-layout>
    <style>
        .inputform {
            border-radius: 50px;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #FFAA33 !important;
            box-shadow: 0 0 5px #FFAA33 !important;
            outline: none !important;
            border-radius: 50px;
        }
        
        .button-custom {
            background-color: #FFAA33;
            color: white;
            font-weight: bold;
            padding: 12px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            border: none;
            cursor: pointer;
            text-align: center;
            display: inline-block;
            width: 100%;
        }

        .button-custom:hover {
            background-color: #FF9900;
            transform: translateY(-2px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        }

        .button-custom:active {
            background-color: #E68A00;
            transform: translateY(2px);
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2);
        }
    </style>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('company.login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
            <x-text-input id="email" class="mt-1 block w-full inputform rounded-md border-gray-300 shadow-sm focus:border-[#FFAA33] focus:ring-[#FFAA33]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Mot de passe')" class="block text-sm font-medium text-gray-700" />
            <x-text-input id="password" class="mt-1 block w-full inputform rounded-md border-gray-300 shadow-sm focus:border-[#FFAA33] focus:ring-[#FFAA33]" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#FFAA33] shadow-sm focus:ring-[#FFAA33]" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">{{ __('Se souvenir de moi') }}</label>
        </div>

        <div class="flex flex-col items-center justify-center">
            @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 hover:text-gray-900 mb-3" href="{{ route('password.request') }}">
                    {{ __('Mot de passe oublié ?') }}
                </a>
            @endif

            <button type="submit" class="button-custom">
                {{ __('Se connecter') }}
            </button>

            <a class="mt-3 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                {{ __('Pas encore de compte ? Inscrivez-vous ici !') }}
            </a>
        </div>
    </form>
</x-guest-layout>

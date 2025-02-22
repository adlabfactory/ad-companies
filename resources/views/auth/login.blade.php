<x-guest-layout>
    <style>
        /* Style du champ input lorsqu'il est en focus */
        .inputform {
            border-radius: 50px;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #FFAA33 !important;
            box-shadow: 0 0 5px #FFAA33 !important;
            outline: none !important;
            border-radius: 50px;
           
        }
        .button-custom{
        background-color: #FFAA33; /* Couleur de fond */
        color: white; /* Couleur du texte */
        font-weight: bold;
        padding: 12px 24px;
        border-radius: 12px; /* Coins arrondis */
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Ombre légère */
        transition: all 0.3s ease-in-out; /* Effet fluide */
        border: none;
        cursor: pointer;
        text-align: center;
        display: inline-block;
        width: 100%;
    }

    .button-custom:hover {
        background-color: #FF9900; /* Changement de couleur au survol */
        transform: translateY(-2px); /* Effet de léger soulèvement */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Ombre plus marquée */
    }

    .button-custom:active {
        background-color: #E68A00; /* Couleur plus foncée lors du clic */
        transform: translateY(2px); /* Effet "pressé" */
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2); /* Ombre réduite */
    }


    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="block text-sm font-medium text-gray-700" />
            <x-text-input id="email" class="mt-1 block w-full  inputform rounded-md border-gray-300 shadow-sm focus:border-[#FFAA33] focus:ring-[#FFAA33]" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class=" block text-sm font-medium text-gray-700" />
            <x-text-input id="password" class="mt-1 block w-full  inputform rounded-md border-gray-300 shadow-sm focus:border-[#FFAA33] focus:ring-[#FFAA33]" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-[#FFAA33] shadow-sm focus:ring-[#FFAA33]" name="remember">
            <label for="remember_me" class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</label>
        </div>

       
            <button type="submit" class="button-custom">
                {{ __('Log in') }}
            </button>
         
        </div>
    </form>

</x-guest-layout>

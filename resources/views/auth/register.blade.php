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

        .custom-button {
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

    .custom-button:hover {
        background-color: #FF9900; /* Changement de couleur au survol */
        transform: translateY(-2px); /* Effet de léger soulèvement */
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15); /* Ombre plus marquée */
    }

    .custom-button:active {
        background-color: #E68A00; /* Couleur plus foncée lors du clic */
        transform: translateY(2px); /* Effet "pressé" */
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.2); /* Ombre réduite */
    }
    </style>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Handle -->
        <div>
            <x-input-label for="Username" :value="__('Username')" />
            <x-text-input id="handle" class="block mt-1 w-full inputform" type="text" name="handle" :value="old('handle')" required autofocus autocomplete="handle" />
            <x-input-error :messages="$errors->get('handle')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full inputform" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full inputform" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full inputform" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center justify-center mt-4 w-full">
            <!-- Bouton Register -->
            <x-primary-button class=" custom-button w-full bg-[#FFAA33] hover:bg-[#FF9900] text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:shadow-outline">
                {{ __('Register') }}
            </x-primary-button>
        
            <!-- Lien Already Registered -->
            <a class="mt-3 underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>
        </div>     
    </form>
</x-guest-layout>

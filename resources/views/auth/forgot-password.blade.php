<x-app-layout>
    <div class="bg-add border-radius-bottom p-2">
        <div class="">
            {{ __('Введите свою электронную почту для сброса пароля.') }}
        </div>
        <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" 
            placeholder="{{ __('Email') }}"
            :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Отправить') }}
            </x-primary-button>
        </div>
    </form>
    </div>

    
</x-app-layout>

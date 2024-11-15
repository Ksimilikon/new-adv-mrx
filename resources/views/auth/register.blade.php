<x-app-layout>
    <x-slot name="title">
        <title>Регистрация</title>
    </x-slot>
    <form method="POST" action="{{ route('register') }}"
          class="border-radius-bottom bg-add p-2 flex flex-col gap-2 w-1/3 
          justify-center justify-self-center max-md:w-10/12">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Псевдоним')" />
            <x-text-input id="name" class="block mt-1 w-full"
                          :placeholder="__('Псевдоним')"
                          type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full"
                          :placeholder="__('Email')"
                          type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Пароль')" />

            <x-text-input id="password" class="block mt-1 w-full"
                          :placeholder="__('Пароль')"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Повторите пароль')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                          :placeholder="__('Повторите пароль')"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">


            <x-primary-button class="ms-4">
                {{ __('Зарегистрироваться') }}
            </x-primary-button>
        </div>
    </form>
</x-app-layout>

<x-app-layout>
    <x-slot name="title">
        <title>Создание</title>
    </x-slot>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <form action="{{ route('card.store') }}" method="post" enctype="multipart/form-data"
          class="border-radius-bottom bg-add p-2 flex flex-col gap-2 w-1/3 justify-center justify-self-center">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Заголовок')" />
            <x-text-input id="title" class="block mt-1 w-full" type="title" name="title" :value="old('title')"
                          :placeholder="__('Заголовок')"
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="description" :value="__('Описание')" />
            <x-text-area id="description" class="block mt-1 w-full" type="description"
                         name="description" :value="old('description')"
                          :placeholder="__('Описание')"
                          required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>
        <div>
            <x-input-label for="image" :value="__('Изображение')" />
            <x-input-img name="image" required/>
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>
        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="">
                {{ __('Сохранить') }}
            </x-primary-button>
        </div>

    </form>
</x-app-layout>

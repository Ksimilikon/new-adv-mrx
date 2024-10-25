<x-app-layout>
    <x-slot name="title">
        <title>Редактирование</title>
    </x-slot>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="bg-add w-8/12 p-2 flex flex-col justify-items-center gap-2 sm:gap-4 border-radius-bottom">
        <div class="grid">
            <h1 class="text-3xl text-center mb-2 ">-- {{$card->title}} --</h1>
            <img class="w-1/2 justify-self-center rounded" src="{{ asset('images/'.$card->image_id.'.'.$card->extension) }}">
            <p class="text-center"><b>Описание: </b>{{ $card->description }}</p>
        </div>
        <livewire:CardInstructionCreate :id="$card->id" />
    </div>

</x-app-layout>

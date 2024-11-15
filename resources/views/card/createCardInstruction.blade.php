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
            
        @auth
        <form action="{{ route('user.card.ban') }}" method="POST">
            @csrf
            <input type="hidden" name="id" value="{{$card->id}}">
            <x-input-error :messages="$errors->get('id')" class="mt-2" />
            <button class="mt-4 btn rounded bg-red-500 hover:bg-red-800 text-white">Удалить от имени пользователя</button>
        </form>
            @if (auth()->user()->role_id == 2)
            
                <form action="{{ route('moder.card.ban') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{$card->id}}">
                    <button class="mt-4 btn rounded bg-red-500 hover:bg-red-800 text-white">Удалить от имени модера</button>
                </form>
            @endif
        @endauth
    </div>
    
</x-app-layout>

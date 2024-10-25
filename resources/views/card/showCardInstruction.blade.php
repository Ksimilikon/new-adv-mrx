<x-app-layout>
    <x-slot name="title">
        <title>{{ $card->title }}</title>
    </x-slot>
<div class="bg-add w-8/12 p-2 flex flex-col justify-items-center gap-2 sm:gap-4 border-radius-bottom">
    <div class="grid">
        <h1 class="text-3xl text-center mb-2 ">-- {{$card->title}} --</h1>
        <img class="w-1/2 justify-self-center rounded" src="{{ asset('images/'.$card->image_id.'.'.$card->extension) }}">
        <p class="text-center"><b>Описание: </b>{{ $card->description }}</p>
    </div>
    <div class="mt-4">
        @if($cardInstructions->isEmpty())
            <p class="text-center">Здесь нет дополнительных сведений</p>
        @endif
        @foreach($cardInstructions as $item)
        <div class="flex flex-col mt-3">
            <div class="flex justify-between bg-main">
                <div class="bg-gold w-1/12">
                    {{-- <input class="w-full" type="number" name="number" id="number" value="{{ $item->number }}"> --}}
                </div>
                <h2 class="text-white text-center">{{ $item->title }}</h2>
                <div class="bg-gold w-1/12 flex justify-center"></div>
            </div>

            <div class="flex flex-row gap-5">
                <img class="h-32" src="{{ asset('images/'.$item->image_id.'.'.$item->extension) }}" alt="">
                <p>{{ $item->description }}</p>

            </div>
        </div>
        @endforeach
    </div>
</div>
</x-app-layout>

<div class="w-8/12 flex flex-col">
    <div class="w-full flex flex-row">
        <input class="w-full" type="text" placeholder="Поиск"
        name="searchMain"
        wire:model='searchMain'
        wire:keydown.enter='search'>
        <button class="btn btn-blue rounded-none" wire:click='search'>Поиск</button>
    </div>
    <div class="bg-add  p-2 flex flex-wrap justify-center gap-2 sm:gap-4 border-radius-bottom">

        @foreach ($cards as $card)
            <div  class="p-2 border-1 border-gray-800 border-solid rounded w-full
            sm:w-full md:w-40 lg:w-1/4 flex flex-col justify-between">

                <a class="" href="{{ route('card.show', ['id' => $card->id]) }}">
                    <img class="rounded w-full" src="{{asset("images/".$card->image_id . '.' . $card->extension)}}" alt="">
                    <p class="truncate font-semibold text-xl">{{$card->title}}</p>
                    <p class="desc font-normal text-sm">{{$card->description}}</p>
                </a>
                
            </div>
        @endforeach
    </div>
</div>
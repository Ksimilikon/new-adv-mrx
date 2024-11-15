<div class="w-8/12 flex flex-col">
    <div class="w-full flex flex-row">
        <input class="w-full" type="text" placeholder="Поиск"
        name="searchMain"
        wire:model='searchMain'
        wire:keydown.enter='search'>
        <button class="btn btn-blue rounded-none" wire:click='search'
        wire:key='searchButton'>Поиск</button>
    </div>
    <div class="bg-add  p-2 flex flex-wrap justify-center gap-2 sm:gap-4 border-radius-bottom">

        @for ($i=0;$i<count($cards);$i++)
        <div  class="p-2 border-1 border-gray-800 border-solid rounded w-full
        sm:w-full md:w-40 lg:w-1/4 flex flex-col justify-between">

            <a class="" href="{{ route('card.show', ['id' => $cards[$i]->id]) }}">
                <img class="rounded w-full" src="{{asset("images/".$cards[$i]->image_id . '.' . $cards[$i]->extension)}}" alt="">
                <p class="truncate font-semibold text-xl">{{$cards[$i]->title}}</p>
                <p class="desc font-normal text-sm">{{$cards[$i]->description}}</p>
            </a>
            
        </div>
        @endfor
    </div>
</div>
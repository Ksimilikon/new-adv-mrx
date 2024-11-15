<div class="flex flex-col">
    @if(!empty($instructions))
        @foreach ($instructions as $item)
            <div class="flex flex-col mt-3">
                <div class="flex justify-between bg-main">
                    <div class="bg-gold w-1/12">
                        {{-- <input class="w-full" type="number" name="number" id="number" value="{{ $item->number }}"> --}}
                    </div>
                    <h2 class="text-white text-center">{{ $item->title }}</h2>
                    <div title="{{ __("Удалить") }}" class="bg-gold w-1/12 flex justify-center bg-inherit hover:bg-red-500 hover:text-white">
                        <button class="w-full" wire:click='delete({{ $item->number }})'>X</button></div>
                </div>

                <div class="flex flex-row gap-5 max-md:flex-col">
                    <img class="h-32" src="{{ asset('images/'.$item->image_id.'.'.$item->extension) }}" alt="">
                    <p>{{ $item->description }}</p>

                </div>
            </div>

        @endforeach
    @endif


    <form class="mt-5" wire:submit='createNew' enctype="multipart/form-data">
        <h1>Добавить</h1>
        <div class="flex flex-col">
            <input type="text" wire:model='title' name="title" id="title"
            placeholder="{{__("Заголовок")}}">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="flex flex-col">
            <textarea class="resize-y" wire:model='description' name="description" id="description"
            placeholder="{{__("Описание")}}"></textarea>
            @error('description') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <div class="">
            <input type="file" name="image" wire:model='image' id="image">
            @error('image') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>
        <button class="btn btn-blue" id="reset">{{ __('Добавить') }}</button>
    </form>
    
</div>

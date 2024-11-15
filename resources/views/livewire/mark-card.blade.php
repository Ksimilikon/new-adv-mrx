{{-- <button class="{{$buttonStyle}}" 
wire:click='{{ $buttonFunc }}({{$id}})'
wire:key='buttonMark.{{ $id }}'
>{{$buttonText}}</button> --}}
<div class="">
@if (App\Models\Marked::where('card_id', $id)->where('user_id', Illuminate\Support\Facades\Auth::id())->get()->first() == null)
    <form action="{{ route("card.mark.in") }}" method="post">
        @csrf
        <input name="id" type="hidden" value="{{$id}}">
        <button class="btn btn-blue">В избранное</button>
    </form>
@else
    <form action="{{ route("card.mark.out") }}" method="post">
        @csrf
        <input name="id" type="hidden" value="{{$id}}">
        <button class="btn text-white bg-red-500 hover:bg-red-800 mt-5 lg:mt-2">Убрать из избранного</button>
    </form>
@endif
</div>
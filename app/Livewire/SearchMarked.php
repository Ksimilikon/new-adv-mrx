<?php

namespace App\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchMarked extends Component
{
    public $cards;
    public $searchMain = '';

    public function render()
    {
        return view('livewire.search-marked');
    }

    public function mount(){
        $this->cards = DB::table('markeds')
        ->join('cards', 'markeds.card_id', '=', 'cards.id')
        ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
        ->join('images', 'card_has_images.image_id', '=', 'images.id')
        ->where('markeds.user_id', Auth::id())
        ->where('cards.deleted_at', NULL)
        ->select('cards.*', 'images.id as image_id', 'images.extension')->get();
    }
    public function search() {
        //dd(Auth::id());
        $searchMain = trim($this->searchMain);
        if($this->searchMain == ''){
            $this->cards = DB::table('markeds')
            ->join('cards', 'markeds.card_id', '=', 'cards.id')
            ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
            ->join('images', 'card_has_images.image_id', '=', 'images.id')
            ->where('markeds.user_id', Auth::id())
            ->where('cards.deleted_at', NULL)
            ->select('cards.*', 'images.id as image_id', 'images.extension')->get();
        }
        else{
            $tags_temp = explode(' ', $this->searchMain);
            $tags = array();
            foreach($tags_temp as $tag){
                if($tag != ''){
                    $tags[]=$tag;
                }
            }
            //dd($tags);
            $this->cards = 
            DB::table('markeds')
            ->join('cards', 'markeds.card_id', '=', 'cards.id')
            ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
            ->join('images', 'card_has_images.image_id', '=', 'images.id')
            ->join('card_has_tags', 'cards.id', '=', 'card_has_tags.card_id')
            ->join('tags', 'card_has_tags.tag_id', '=', 'tags.id')
            ->where('markeds.user_id', Auth::id())
            ->whereIn('tags.tag', $tags)
            ->where('cards.deleted_at', NULL)
            ->select('cards.*', 'images.id as image_id', 'images.extension')
            ->get();
        }
        
    }
}

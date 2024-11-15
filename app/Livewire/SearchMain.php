<?php

namespace App\Livewire;

use App\Models\Marked;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class SearchMain extends Component
{

    public $cards;
    public $searchMain = '';


    public function render()
    {
        return view('livewire.search-main');
    }
    public function mount(){
        $this->cards = DB::table('cards')
        ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
        ->join('images', 'card_has_images.image_id', '=', 'images.id')
        ->where('cards.deleted_at', NULL)
        ->select('cards.*', 'images.id as image_id', 'images.extension')->get();

    }
    public function search() {
        
        if($this->searchMain == ''){
            $this->cards = DB::table('cards')
            ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
            ->join('images', 'card_has_images.image_id', '=', 'images.id')
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
            DB::table('cards')
            ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
            ->join('images', 'card_has_images.image_id', '=', 'images.id')
            ->join('card_has_tags', 'cards.id', '=', 'card_has_tags.card_id')
            ->join('tags', 'card_has_tags.tag_id', '=', 'tags.id')
            ->whereIn('tags.tag', $tags)
            ->where('cards.deleted_at', NULL)
            ->select('cards.*', 'images.id as image_id', 'images.extension')
            ->get();
        }
        
    }

    
}

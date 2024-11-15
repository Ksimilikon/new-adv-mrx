<?php

namespace App\Http\Controllers;
use App\Models\Card;
use App\Models\card_has_image;
use App\Models\card_has_tag;
use App\Models\CardInstruction;
use App\Models\Image;
use App\Models\ListCardDeleted;
use App\Models\Marked;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    public function main() {
        //$cards = Card::all();
        // $info = DB::table('cards')
        // ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
        // ->join('images', 'card_has_images.image_id', '=', 'images.id')
        // ->select('cards.*', 'images.id as image_id', 'images.extension')->get();

        // return view("main", ['cards'=>$info, 'title'=>"Главная"]);
        return view("main");
    }
    public function create() {
        return view("card.createCard");
    }
    public function store(Request $request) {
        $image = $request->file('image');
        
        //dd($image);
        $request->validate([
            'title'=>['required', 'string', 'max:64'],
            'description'=> ['required', 'string', 'max:255'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
        ]);

        //create card general info
        $create = Card::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        //tags
        $tags = explode(' ', trim($create->title)) + explode(' ', trim($create->description));
        
        //add tag
        foreach($tags as $tag){
            $exist = Tag::where('tag', $tag)->first();
            
            if($exist == null){
                
                $new_tag = Tag::create([
                    'tag' => $tag,
                ]);
                card_has_tag::create([
                    'card_id' => $create->id,
                    'tag_id' => $new_tag->id,
                ]);
            }
            else{
                
                card_has_tag::create([
                    'card_id' => $create->id,
                    'tag_id' => $exist->id,
                ]);
            }
        }
        //save img
        $nameImage = $image->getClientOriginalName();
        $imageCreate = Image::create([
            'name' => $nameImage,
            'extension' => $image->getClientOriginalExtension(),
            'size' => $image->getSize(),
        ]);
        card_has_image::create([
            'card_id' => $create->id,
            'image_id' => $imageCreate->id,
        ]);
        $nameImage = $imageCreate->id . '.' . $image->getClientOriginalExtension();
        Storage::disk('public')->put('img/'.$nameImage, file_get_contents($image->getRealPath()));
        


        return to_route('card.show', ['id'=>$create->id]);
    }

    public function myCards() {
        //dd(Auth::id());
        $cards = DB::table('cards')
            ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
            ->join('images', 'card_has_images.image_id', '=', 'images.id')
            ->select('cards.*', 'images.id as image_id', 'images.extension')
            ->where('user_id', Auth::id())->get();
        //$cards = Card::where('user_id', Auth::id())->get();

        return view("card.myCards", ['cards'=>$cards]);
    }

    public function edit($id) {
        //dd($id);
        $card = Card::find($id);
        if(Auth::id() == $card->user_id) {
            $card = DB::table('cards')
            ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
            ->join('images', 'card_has_images.image_id', '=', 'images.id')
            ->select('cards.*', 'images.id as image_id', 'images.extension')
            ->where('cards.id', $id)->get()->first();
            return view("card.createCardInstruction", ['card'=>$card]);
        }
        else{
            return redirect("/");
        }
    }
    public function show($id) {

        $card = Card::find($id);
        if($card != null){
            if(Auth::id() == $card->user_id){
                return to_route('card.edit', ['id' => $id]);
            }
            else{
                $card = DB::table('cards')
                ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
                ->join('images', 'card_has_images.image_id', '=', 'images.id')
                ->select('cards.*', 'images.id as image_id', 'images.extension')
                ->where('cards.id', $id)->get()->first();
                $cardInstructions = DB::table('card_instructions')
                ->join('card_instruction_has_images', 'card_instruction_has_images.card_instruction_id', '=', 'card_instructions.id')
                ->join('images', 'images.id', '=', 'card_instruction_has_images.image_id')
                ->where('card_instructions.card_id', $id)
                ->orderBy('card_instructions.number', 'asc')
                ->select('card_instructions.*', 'images.id as image_id', 'images.extension')
                ->get();
            return view("card.showCardInstruction", ['card'=>$card, "cardInstructions"=>$cardInstructions]);
            }
        }
        else{
            return redirect('/');
        }
        
    }


    public function marked(){
        return view('card.marked');
    }

    public function userBan(Request $request){
        //return dd($request->id);
        $request->validate([
            'id'=>['required', 'integer']
        ]);
        $id = $request->id;
        
        if(Card::find($id)->user_id == Auth::id()){
            
            $card = Card::find($id);
            ListCardDeleted::create([
                'user_id' => auth()->user()->id,
                'card_id' => $id,
                'role_id' => 1
            ]);
            $card->delete();
        }
        return redirect('/');
    }
    public function moderBan(Request $request){
        $request->validate([
            'id'=>['required', 'integer']
        ]);
        $id = $request->id;
        $card = Card::find($id);
        ListCardDeleted::create([
            'user_id' => auth()->user()->id,
            'card_id' => $id,
            'role_id' => 2
        ]);
        $card->delete();
        return redirect('/');
    }

    public function markOutCard(Request $request){
        $request->validate([
            'id'=>['required', 'integer']
        ]);
        $id = $request->id;

        //$out = Marked::where('card_id', $id)->where('user_id', Auth::id())->get()->first();
        DB::table('markeds')
        ->where('card_id', $id)
        ->where('user_id', Auth::id())
        ->delete();
        //$out->delete();
        return to_route('card.show', ['id'=>$id]);
    }
    public function markInCard(Request $request){
        $request->validate([
            'id'=>['required', 'integer']
        ]);
        $id = $request->id;

        $to = Marked::create([
                        'user_id' => Auth::id(),
                        'card_id' => $id
                    ]);
        return to_route('card.show', ['id'=>$id]);
    }
}

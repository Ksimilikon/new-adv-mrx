<?php

namespace App\Http\Controllers;
use App\Models\Card;
use App\Models\card_has_image;
use App\Models\CardInstruction;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CardController extends Controller
{
    public function main() {
        //$cards = Card::all();
        $info = DB::table('cards')
        ->join('card_has_images', 'cards.id', '=', 'card_has_images.card_id')
        ->join('images', 'card_has_images.image_id', '=', 'images.id')
        ->select('cards.*', 'images.id as image_id', 'images.extension')->get();

        return view("main", ['cards'=>$info, 'title'=>"Главная"]);
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


        $create = Card::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'description' => $request->description,
        ]);

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
        return redirect('/');
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

        if(Auth::id() == Card::find($id)->user_id){
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


}

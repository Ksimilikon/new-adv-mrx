<?php

namespace App\Livewire;

use App\Models\CardInstruction;
use App\Models\CardInstruction_has_image;
use App\Models\Image;
//use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File;

class CardInstructionCreate extends Component
{
    use WithFileUploads;
    //controller's data
    public Collection $instructions;

    //controller get data
    public int $idCard;

    //form data
    public $title=null;
    public $description=null;
    public $image=null;

    protected $rules = [
        'title' => ['required', 'max:64', 'string'],
        'description' => ['required', 'max:255', 'string'],
        'image' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
    ];
    protected $messages = [
        'title.required' => 'Поле заголовка нужно заполнить',
        'description.required' => 'Поле описания нужно заполнить',
        'title.max' => 'Заголовок не может содержать более 64 символов',
        'description.max' => 'Описание не может содержать более 255 символов',
        'image.max'=>'Фото слишком большое',
        'image.mimes'=>'Формат изображения может быть jpeg, jpg, png',
        'image.image'=>'Выбранный файл не является изображением',
        'image.required'=>'Поле обязательно для ввода',
    ];

    public function mount($id){
        $this->idCard = $id;
        self::setInstructionsVar($id);
    }

    public function render()
    {
        return view('livewire.card-instruction-create');
    }

    private function setInstructionsVar($id){
        $this->instructions = DB::table('card_instructions')
        ->join('card_instruction_has_images', 'card_instruction_has_images.card_instruction_id', '=', 'card_instructions.id')
        ->join('images', 'images.id', '=', 'card_instruction_has_images.image_id')
        ->where('card_instructions.card_id', $id)
        ->orderBy('card_instructions.number', 'asc')
        ->select('card_instructions.*', 'images.id as image_id', 'images.extension')
        ->get();
        //return CardInstruction::where('card_id', $id)->orderBy('number', 'asc')->get();
    }

    public function createNew()
    {
        $this->validate();

        $previous = CardInstruction::where('card_id', $this->idCard)->orderBy('number', 'desc')->first();
        $number = null;
        if($previous == null){
            $number = 1;
        }
        else{
            $number= $previous->number + 1;
        }
        $new = new CardInstruction();
        $new->number = $number;
        $new->title = $this->title;
        $new->description = $this->description;
        $new->card_id = $this->idCard;
        $new->save();

        $nameImage = $this->image->getClientOriginalName();
        $imageCreate = Image::create([
            'name' => $nameImage,
            'extension' => $this->image->getClientOriginalExtension(),
            'size' => $this->image->getSize(),
        ]);
        CardInstruction_has_image::create([
            'card_instruction_id' => $new->id,
            'image_id' => $imageCreate->id,
        ]);
        $nameImage = $imageCreate->id . '.' . $this->image->getClientOriginalExtension();
        Storage::disk('public')->put('img/'.$nameImage, file_get_contents($this->image->getRealPath()));

        self::setInstructionsVar($this->idCard);
    }

    public function delete(int $number){
        //dd($this->idCard);
        //dd($number);
        $card = DB::table('card_instructions')
        ->where('card_id', $this->idCard)
        ->where('number', $number)
        ->first();
        //dd($card);
        if($card != null){
            $card_has = DB::table('card_instruction_has_images')
            ->where('card_instruction_id', $card->id)
            ->first();
            
            if($card_has != null){
                $image = Image::find($card_has->image_id);
                if($image != null){
                    $nameFile = $image->id.'.'.$image->extension;
                    
                    //File::delete(public_path('img/'.$nameFile));
                    $image->delete();
                }
                DB::table('card_instruction_has_images')
                ->where('card_instruction_id', $card->id)->delete();
            }
            DB::table('card_instructions')
        ->where('card_id', $this->idCard)
        ->where('number', $number)->delete();
            self::setInstructionsVar($this->idCard);
        }
        
    }
}

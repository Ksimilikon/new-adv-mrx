<?php

namespace App\Livewire;

use App\Models\Marked;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MarkCard extends Component
{
    public int $id;
    
    // public bool $isMarked = false;
    // private string $styleDelete = "btn text-white bg-red-500 hover:bg-red-800 mt-5 lg:mt-2";
    // private string $styleAdd = 'btn btn-blue mt-5 lg:mt-2';
    // private string $buttonTextDelete = 'Убрать';
    // private string $buttonTextAdd = 'В избранное';
    // private string $funcDel = 'out';
    // private string $funcAdd = 'set';

    // public string $buttonText = '';
    // public string $buttonStyle = '';
    // public string $buttonFunc = '';

    public function render()
    {
        return view('livewire.mark-card');
    }
    public function mount(int $id){
        //dd($this->id);
        $this->id = $id;
    }
    // public function mount(){
    //     //dd($this->id);
    //     $this->isMarked = Marked::where('card_id', $this->id)->where('user_id', Auth::id())->get()->first() != null;
    //     if($this->isMarked){
    //         $this->setButtonPropertiesDelete();
    //     }
    //     else{
    //         $this->setButtonPropertiesAdd();
    //     }
    // }
    // private function setButtonPropertiesAdd(){
    //     $this->buttonText = $this->buttonTextAdd;
    //     $this->buttonStyle = $this->styleAdd;
    //     $this->buttonFunc = $this->funcAdd;
    // }
    // private function setButtonPropertiesDelete(){
    //     $this->buttonText = $this->buttonTextDelete;
    //     $this->buttonStyle = $this->styleDelete;
    //     $this->buttonFunc = $this->funcDel;
    // }
    // private function setIsMarked(){
    //     if($this->isMarked){
    //         $this->setButtonPropertiesDelete();
    //     }
    //     else{
    //         $this->setButtonPropertiesAdd();
    //     }
    // }
    // public function set(){
    //     try{
    //         $this->isMarked = true;
    //         $this->setIsMarked();
    //         dd(1);
    //         $to = Marked::create([
    //             'user_id' => Auth::id(),
    //             'card_id' => $this->id
    //         ]);
    //     }
    //     catch(Exception $e){
            
    //     }
    // }
    // public function out(){
    //     try{
    //         $this->isMarked = false;
    //         $this->setIsMarked();

    //         $out = Marked::where('card_id', $this->id)->where('user_id', Auth::id())->get()->first();
    //         dd($out);
    //         $out->delete();
    //     }
    //     catch(Exception $e){
            
    //     }
    // }
}

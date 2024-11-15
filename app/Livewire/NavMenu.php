<?php

namespace App\Livewire;

use Livewire\Component;

class NavMenu extends Component
{
    public bool $isOpenModalNav=false;
    
    public function render()
    {
        return view('livewire.nav-menu');
    }
    public function navMobile(){
        $this->isOpenModalNav = !$this->isOpenModalNav;
        //return view('livewire.nav-menu');
    }
}

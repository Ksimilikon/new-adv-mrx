<?php
function currentPage(string $routeName) : string{
    $curUrl = url()->current();
    $target = route($routeName);
    if($curUrl == $target){
        return "visible";
    }
    else{
        return "invisible";
    }
}
?>
<div class="px-2 pb-2 w-10/12 h-full">
<nav class="2xl:hidden xl:hidden lg:hidden md:hidden">
    <button class="text-white nav-btn px-4" wire:click='navMobile'>☰</button>
    @if ($isOpenModalNav)
        <div class="absolute bg-main">
            <div class="flex flex-col pl-2">
                <a class="nav-btn px-4 flex flex-row" href="{{route("dashboard")}}">
                    <div class="nav-select-mobile {{currentPage("dashboard")}} "></div>
                    <p class="py-2">Главная</p>
                </a>
                @auth
                    <a class="nav-btn px-4 flex flex-col" href="{{route("card.create")}}">
                        <div class="nav-select-mobile {{currentPage("card.create")}} "></div>
                        <p class="py-2">Создать</p>
                    </a>
                    <a class="nav-btn px-4 flex flex-col" href="{{route("card.showMyCards")}}">
                        <div class="nav-select-mobile {{currentPage("card.showMyCards")}} "></div>
                        <p class="py-2">Мои карточки</p>
                    </a>
                    <a class="nav-btn px-4 flex flex-col" href="{{route("card.marked")}}">
                        <div class="nav-select-mobile {{currentPage("card.marked")}} "></div>
                        <p class="py-2">Избранное</p>
                    </a>
                    
                @endauth
            </div>
            <div class="mt-2 border-top">
                    @auth
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="nav-btn px-4 flex flex-col hover:text-red-800">
                        <div class="nav-select invisible"></div>
                        <p class="py-2 text-red-500">{{ __('Выйти') }}</p>
                    </button>
                </form>


                @endauth
                @guest
                    <a class="nav-btn px-4 flex flex-col" href="{{route("register")}}">
                        <div class="nav-select {{currentPage("register")}} "></div>
                        <p class="py-2">Регистрация</p>
                    </a>
                    <a class="nav-btn px-4 flex flex-col" href="{{route("login")}}">
                        <div class="nav-select {{currentPage("login")}}"></div>
                        <p class="py-2">Авторизация</p>
                    </a>
                @endguest
            </div>
        </div>
    @endif
</nav>
<nav class="max-md:hidden w-full h-full flex justify-between 2xl:visible xl:visible lg:visible">
    <div class="flex flex-row">
        <a class="nav-btn px-4 flex flex-col items-center" href="{{route("dashboard")}}">
            <div class="nav-select {{currentPage("dashboard")}} "></div>
            <p class="py-2">Главная</p>
        </a>
        @auth
            <a class="nav-btn px-4 flex flex-col items-center" href="{{route("card.create")}}">
                <div class="nav-select {{currentPage("card.create")}} "></div>
                <p class="py-2">Создать</p>
            </a>
            <a class="nav-btn px-4 flex flex-col items-center" href="{{route("card.showMyCards")}}">
                <div class="nav-select {{currentPage("card.showMyCards")}} "></div>
                <p class="py-2">Мои карточки</p>
            </a>
            <a class="nav-btn px-4 flex flex-col items-center" href="{{route("card.marked")}}">
                <div class="nav-select {{currentPage("card.marked")}} "></div>
                <p class="py-2">Избранное</p>
            </a>
            
        @endauth


    </div>
    <div class="flex justify-end">
        @auth
             <form action="{{route('logout')}}" method="POST">
                @csrf
                <button class="nav-btn px-4 flex flex-col items-center hover:text-red-600">
                    <div class="nav-select invisible"></div>
                    <p class="py-2 ">{{ __('Выйти') }}</p>
                </button>
            </form>


        @endauth
        @guest
            <a class="nav-btn px-4 flex flex-col items-center" href="{{route("register")}}">
                <div class="nav-select {{currentPage("register")}} "></div>
                <p class="py-2">Регистрация</p>
            </a>
            <a class="nav-btn px-4 flex flex-col items-center" href="{{route("login")}}">
                <div class="nav-select {{currentPage("login")}}"></div>
                <p class="py-2">Авторизация</p>
            </a>
        @endguest
    </div>
</nav>
</div>

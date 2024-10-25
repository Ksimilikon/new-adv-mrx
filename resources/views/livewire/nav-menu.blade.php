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
<nav class="px-2 pb-2 w-10/12 h-full flex justify-between">
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

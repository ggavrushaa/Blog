@extends('layouts.main')

@section('main.content')
    <div class="text-center">
        <h1>
            Главная страница
        </h1>
    </div>


    <div class="row text-center">
        <div class="col mt-5">
            <a href="{{route('user.donates')}}">
             <div class="btn btn-primary">
                {{__('Мои донаты')}} 
             </div>
            </a>
        </div>

        <div class="col mt-5">
            <a href="{{route('user.posts')}}">
             <div class="btn btn-primary">
                {{__('Мой блог')}} 
             </div>
            </a>
        </div>

        <div class="col mt-5">
            <a href="{{route('user.posts.create')}}">
             <div class="btn btn-primary">
                {{__('Создать пост')}} 
             </div>
            </a>
        </div>

        <div class="col mt-5">
            <a href="{{route('blog')}}">
             <div class="btn btn-primary">
                {{__('Все посты')}} 
             </div>
            </a>
        </div>

    </div>

    <div class="mt-5 mb-5">
        <div style="padding-top:56.200%;position:relative;">
            <iframe src="https://gifer.com/embed/FMvv" width="100%" height="100%" style='position:absolute;top:0;left:0;' 
            frameBorder="0" allowFullScreen class="rounded-pill"></iframe>
    </div> 

    <div class="d-flex flex-row mb-3 mt-5">
        <h4>
            Посмотрите, какой сегодня вы персонаж
        </h4>

        <a href="{{route('character')}}">
            <div class="btn btn-primary ms-3">
               {{__('Кто я из Наруто?')}} 
            </div>
           </a>
    </div>
@endsection

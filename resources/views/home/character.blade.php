@extends('layouts.main')

@section('main.content')
<div class="container text-start">
    <div class="row mb-4 justify-content-md-center">
        <div class="col-md-auto">
            <a href="{{route('home')}}">
                <div class="btn btn-primary ms-3">
                   {{__('Назад')}} 
                </div>
               </a>
        </div>
        
        <div class="col-md-auto">
            <a href="{{route('character')}}">
             <div class="btn btn-primary ms-3">
                {{__('Я не ')}} {{$character->title}}
             </div>
            </a>
        </div>
    </div>
</div>

<div class="card mb-3" style="width: 30rem;">
    <img src="{{$character->photo}}" class="img-thumbnail">
    <div class="card-body">
        <h3 class="card-title text-primary">Cегодня ты: {{$character->title}}</h3>
              <p class="card-text text-secondary">
                  <strong>Описание:</strong><br>{{$character->description}}
              </p>     
    </div>
</div>


    @endsection
@extends('layouts.main')

@section('page.title', 'Создать роль')

@section('main.content')
    <x-title>
        {{ __('Создать роль') }}

        <x-slot name="link">
            <a href="{{ route('role.index') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>

  
    <form action="{{route('role.store')}}" method="post">
        @csrf
        <div class="form-group mt-3">
            <label for="name">Название роли</label>
            <input type="text" class="form-control" id="name" name="name" autofocus>
        </div>
        <x-button type="submit" class="mt-3">
            {{ __('Cоздать') }}
        </x-button>
    </form>
    @endsection
    
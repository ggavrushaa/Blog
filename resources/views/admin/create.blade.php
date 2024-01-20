@extends('layouts.main')

@section('page.title', 'Создать пост')

@section('main.content')
    <x-title>
        {{ __('Создать юзера') }}

        <x-slot name="link">
            <a href="{{ route('admin.panel') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>

  
    <form action="{{ route('admin.panel.store') }}" method="post">
        @csrf
        <div class="form-group mt-3">
            <label for="name">Никнейм</label>
            <input type="text" class="form-control" id="name" name="name" autofocus>
        </div>

        <div class="form-group mt-3">
            <label for="name">Почта</label>
            <input type="email" class="form-control" id="name" name="email">
        </div>

        <div class="form-group mt-3">
            <label for="name">Пароль</label>
            <input type="password" class="form-control" id="name" name="password">
        </div>

        <div class="form-group mt-3">
            <label for="admin">Роль</label>
            <select name="admin" class="form-select">
                <option value="0" {{ old('admin') == false ? 'selected' : '' }}>Юзер</option>
                <option value="1" {{ old('admin') == true ? 'selected' : '' }}>Админ</option>
            </select>
        </div>

        <x-button type="submit" class="mt-3">
            {{ __('Cоздать') }}
        </x-button>
      
     
    </form>
    @endsection
    
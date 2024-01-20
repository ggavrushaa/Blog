@extends('layouts.main')

@section('page.title', 'Cоздать админа')

@section('main.content')
<x-title>
    {{ __('Юзеры') }}
</x-title>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Cписок юзеров   
        </h6>
    </div>
</div>

<form action="{{ route('ability.store') }}" method="POST">
    @csrf

    <select class="form-select" aria-label="Создайте админа" name="user_id">
        <option selected>Создай админа</option>
        @foreach ($admins as $admin)
            <option value="{{ $admin->id }}">{{ $admin->name }}</option>
        @endforeach
    </select>

    <button type="submit" class="btn btn-primary mt-3">
        {{ __('Создать') }}
    </button>
</form>

@endsection
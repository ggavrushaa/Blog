@extends('layouts.main')

@section('main.content')
<form method="POST" action="{{ route('admin.panel.update', $user->id) }}">
    @csrf
    @method('PUT')

    <div class="form-group mt-3">
        <label for="name">Никнейм</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
    </div>

    <div class="form-group mt-3">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="form-group mt-3">
        <label for="admin">Роль</label>
        <select name="admin" class="form-select">
            <option value="0" {{ $user->admin == false ? 'selected' : '' }}>Юзер</option>
            <option value="1" {{ $user->admin == true ? 'selected' : '' }}>Админ</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Обновить</button>
</form>

@endsection
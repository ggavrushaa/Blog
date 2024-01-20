@extends('layouts.main')

@section('main.content')

@if(is_null($user))
    {{ __('Нет ни одного пользователя') }}
@else

<div class="row">
    <div class="col-12 col-md-4">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Имя</th>
                    <th scope="col">Почта</th>
                    <th scope="col">Роль</th>
                    <th scope="col">Пароль</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">
                        {{$user->id}}
                    </th>
                    <td>
                        {{$user->name}}
                    </td>
                    <td>
                        {{$user->email}}
                    </td>
                    <td>
                        @if ($user->admin == 1)
                        {{ __('Админ') }}
                        @else
                        {{ __('Юзер') }}
                        @endif
                    </td>
                    <td>
                        {{$user->password}}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection

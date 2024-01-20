@extends('layouts.main')

@section('page.title', 'Админ панель')

@section('main.content')
<x-title>
    {{ __('Все пользователи') }}
@can('create', App\Models\User::class)
    <x-slot name="right">
        <x-button-link href="{{ route('admin.panel.create') }}">
            {{ __('Создать') }}
        </x-button-link>
    </x-slot>
@endcan
</x-title>
@if($users->isEmpty())
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
                    <th scope="col">Действие</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
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
                            @can('delete', App\Models\User::class)
                            <form action="{{ route('admin.panel.delete', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-primary" type="submit">{{ __('Удалить') }}
                                </form>        
                              @endcan
                                @can('update', App\Models\User::class) 
                                <form action="{{ route('admin.panel.edit', ['id' => $user->id]) }}" method="GET">
                                    <button class="btn btn-primary mt-3" type="submit">{{ __('Изменить') }}
                                    </form>                                
                                @endcan
                                    
                                @can('view', App\Models\User::class) 
                                <form action="{{ route('admin.panel.show', ['id' => $user->id]) }}" method="GET">
                                    <button class="btn btn-primary mt-3" type="submit">{{ __('Посмотреть') }}
                                    </form>                                
                                @endcan
                              
                            </td>
                            
                        </tr>
                        @endforeach

                        @if (session('success'))
                            <div class="alert alert-primary">
                                {{ session('success') }}
                            </div>
                        @endif
                    </tbody>
                </table>
            </div>
            {{$users->links()}}
</div>

    @endif
@endsection

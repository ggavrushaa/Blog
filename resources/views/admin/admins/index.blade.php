@extends('layouts.main')

@section('page.title', 'Доступы')

@section('main.content')
<x-title>
    {{ __('Админы') }}

    @can('create', App\Models\User::class)
        
    <x-slot name="right">
        <x-button-link href="{{ route('ability.create') }}">
            {{ __('Создать') }}
        </x-button-link>
    </x-slot>
    @endcan

</x-title>
@if (session('success'))
    <div class="alert alert-primary">
        {{ is_array(session('success')) ? implode(', ', session('success')) : session('success') }}
    </div>
@endif
<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Данные счастливчиков
        </h6>
    </div>
</div>

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordless text-nowrap mb-0">
            @forelse ($admins as $admin)
            <tr>
                <td>
                    <strong>ID</strong>
                </td>
                <td>
                    {{$admin->id}}
                </td>
                <td>
                   <strong>Имя</strong>
                </td>
                <td>
                    <a href="{{route('ability.show', ['id' => $admin->id])}}">
                        {{$admin->name}}
                    </a>                    
                </td>
                @can('delete', App\Models\User::class)
                    
                <td>
                    <form action="{{ route('ability.delete', ['id' => $admin->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-primary" type="submit">{{ __('Удалить') }}</button>
                    </form>  
                </td>
                @endcan
            </tr>
            @empty
            <tr>
                <td colspan="5">
                    Нет доступных админов
                </td>
            </tr>
            @endforelse
        </table>
    </div>
</div>

@endsection

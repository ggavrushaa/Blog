@extends('layouts.main')

@section('page.title', 'Роли')

@section('main.content')
<x-title>
    {{ __('Роли') }}

    @can('create', App\Models\User::class)
        
    <x-slot name="right">
        <x-button-link href="{{route('role.create')}}">
            {{ __('Создать') }}
        </x-button-link>
    </x-slot>
    @endcan

</x-title>
<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
           Доступные роли
        </h6>
        <div class="table-responsive">
            <table class="table table-bordless text-nowrap mb-0">
             
                     <tr>
                        @if ($roles->isEmpty())
                            <td>Пока что ролей не видно, добавь парочку</td>
                        @else
                            @foreach ($roles as $role)
                            <tr>
                                <td> 
                                    <a href="{{route('role.show', ['role' => $role])}}">
                                        {{$role->name}}
                                    </a>          
                                </td>
                                <td class="text-end mb-3">
                                    <form action="{{route('role.delete', ['role' => $role])}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                          <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                  </td>
                            </tr>
                            @endforeach
                        @endif
                    </tr>
             
            </table>
        </div>
    </div>
</div>

@endsection
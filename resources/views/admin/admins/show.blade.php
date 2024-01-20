@extends('layouts.main')

@section('page.title', 'Просмотр админа')

@section('main.content')
<x-title>
    {{ __('Админ и полномочия') }}
</x-title>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Данные админа
        </h6>
        <div class="table-responsive">
            <table class="table table-bordless text-nowrap mb-0">
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
                        {{$admin->name}}
                    </td>
                    <td>
                       <strong>Почта</strong>
                    </td>
                    <td>
                        {{$admin->email}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
           Полномочия админа
        </h6>
        <div class="table-responsive">
            <table class="table table-bordless text-nowrap mb-0">
                <tr>
                    <td>
                        <x-button-link href="{{ route('permissions.create', ['user_id' => $admin->id]) }}">
                            {{ __('Глянуть') }}
                        </x-button-link>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
           Роли админов
        </h6>
        <div class="table-responsive">
            <table class="table table-bordless text-nowrap mb-0">
                <tr>
                    <td>
                        <x-button-link href="{{ route('role.index', ['user_id' => $admin->id]) }}">
                            {{ __('Глянуть') }}
                        </x-button-link>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endsection
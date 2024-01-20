@extends('layouts.main')

@section('page.title', 'Просмотр роли')

@section('main.content')
<x-title>
    {{ __('Роль и полномочия') }}
</x-title>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Информация роли: {{$role->name}}
        </h6>
        <div class="table-responsive">
            <table class="table table-bordless text-nowrap mb-0">
                <tr>
                    <td>
                        <strong>ID</strong>
                    </td>
                    <td>
                        {{$role->id}}
                    </td>
                    <td>
                       <strong>Роль</strong>
                    </td>
                    <td>
                        {{$role->name}}
                    </td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
           Список полномочий
        </h6>
        <div class="table-responsive">
            <table class="table table-bordless text-nowrap mb-0">
                @foreach ($role->permissions as $permission)
                    <tr>
                        <td>
                            {{ $permission->action }}
                        </td>
                        <td class="text-end">
                            <form action="{{ route('role.permissions.revoke', ['role' => $role, 'permission' => $permission]) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>

<h3> Добавь полномочия для {{ $role->name }}</h3>
<form action="{{ route('role.permissions.assign', $role) }}" method="POST">
    @csrf
    <select name="permission_id" class="form-select">
        @foreach ($permissions as $permission)
            <option value="{{ $permission->id }}">
                {{ $permission->action }}
            </option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-3">Добавить</button>

@endsection
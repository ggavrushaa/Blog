@extends('layouts.main')

@section('page.title', 'Смотрим админа')

@section('main.content')
<x-title>
    {{ __('Добавь полномочие') }}
</x-title>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Cписок ролей
        </h6>
        @if ($admin->roles->isEmpty())
        <p>У этого пользователя пока нет ролей.</p>
    @else
    <div class="table-responsive">
        <table class="table table-bordless text-nowrap mb-0">
        @foreach ($admin->roles as $role)
        <tr class="d-flex justify-content-between">

            <td class="flex-grow-1"> 
                <a href="{{route('role.show', ['role' => $role])}}">
                    {{$role->name}}
                </a>          
            </td>

            <td>
                <form action="{{ route('role.revoke', ['user' => $admin, 'role' => $role]) }}" method="post">
                    @csrf
                    @method('DELETE')
                      <button type="submit" class="btn btn-danger">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</div>
    @endif
  </div>
</div>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Добавь роль
        </h6>

        <form action="{{ route('role.assign', $admin->id) }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ $admin->id }}">
            <select class="form-select" aria-label="Добавь роль" name="role_id" required>
                <option selected disabled value="">Роли:</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        
            <button type="submit" class="btn btn-primary mt-3 mb-3">
                {{ __('Добавить') }}
            </button>
        </form>
        
    </div>
</div>

<div class="card mb-3">
    <div class="card-body pb-0">
        <h6 class="mb-3 mt-0">
            Cписок полномочий
        </h6>
    @foreach ($adminPermissions as $adminPermission)
        <ul class="list-group list-group-flush">
            <li class="list-group-item"> {{ $adminPermission->action }}</li>
        </ul>
    @endforeach
    <div class="mb-3">
        @can('update', App\Models\User::class)
        <x-button-link href="{{ route('permissions.show', ['id' => $admin->id]) }}">
            {{ __('Редактировать') }}
        </x-button-link>
        @endcan
    </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-body pb-0">
<form action="{{ route('permissions.store', $admin->id)}}" method="POST">
    @csrf
    <input type="hidden" name="user_id" value="{{ $admin->id }}">
    <select class="form-select" aria-label="Добавь полномочие" name="permission_id" required>
        <option selected disabled value="">Полномочия:</option>
        @foreach ($permissions as $permission)
            <option value="{{ $permission->id }}">{{ $permission->action }}</option>
        @endforeach
    </select>
    
    <button type="submit" class="btn btn-primary mt-3 mb-3">
        {{ __('Добавить') }}
    </button>
</form>
    </div>
</div>



@endsection
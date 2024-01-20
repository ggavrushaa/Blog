@extends('layouts.main')

@section('page.title', 'Полномочия админа')

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
                @foreach ($permissions as $permission)
                    <tr>
                        <td>
                            {{$permission->action}}
                        </td>
                        <td>
                          <form action="{{ route('permissions.delete', ['user'=>$admin->id, 'permission'=> $permission->id]) }}" method="POST">
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
<x-button-link href="{{ route('permissions.create', ['user_id' => $admin->id]) }}">
    {{ __('Назад') }}
</x-button-link>
@endsection
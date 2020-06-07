@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header text-right">
                  <div class="float-left"><h2>Usuários</h2></div>
                  <button onclick="location.href='{{ route('users.create') }}'" type="button" class="btn btn-primary btn-lg">
                    <i class="fas fa-plus"></i> Usuário
                  </button>
                </div>
                <div class="card-body">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Nome</th>
                          <th scope="col">Email</th>
                          <th scope="col">Criado</th>
                          <th scope="col">Atualizado</th>
                          <th scope="col"></th>
                          <th scope="col"></th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                        <tr>
                          <td>{{ $user->name }}</td>
                          <td>{{ $user->email }}</td>
                          <td>{{ $user->updated_at_human }}</td>
                          <td>{{ $user->created_at_human }}</td>
                          <td>
                            {!! Form::open(['route' => ['users.edit', $user->id]]) !!}
                              @method('get')
                              <button type="submit" class="btn btn-success btn-sm">
                                <i class="fas fa-pen"></i>
                              </button>
                            {!! Form::close() !!}
                          </td>
                          <td>
                            {!! Form::open(['route' => ['users.destroy', $user->id]]) !!}
                              @method('delete')
                              <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                              </button>
                            {!! Form::close() !!}
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
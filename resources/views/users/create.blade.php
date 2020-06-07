@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo usuário</div>

                <div class="card-body">
                    @if(isset($user))

                      <form id='main-form' method="POST" action="{{ route('users.update', ['user' => $user->id]) }}">
                          @csrf
                          @method('put')

                    @else

                      <form id='main-form' method="POST" action="{{ route('users.store') }}">
                          @csrf

                    @endif

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">
                                Name
                            </label>

                            <div class="col-md-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{ $user->name ?? old('name') }}" required autocomplete="name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                E-mail
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email ?? old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">
                                Senha
                            </label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" @if(!isset($user)) required @endif autocomplete="current-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">
                                Senha de confirmação
                            </label>

                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" @if(!isset($user)) required @endif autocomplete="current-password_confirmation">
                            </div>
                        </div>

                    </form>
					
					@if(isset($user))
						<form id='secondary-form' method="POST" action="{{ route('users.destroy', ['user' => $user->id]) }}">
							  @csrf
							  @method('delete')
						</form>
					@endif

                    <div class="form-group row mb-0">
                        <div class="col-md-8 offset-md-4">
                            
							<button type="submit" form="main-form" class="btn btn-primary">
                                @if(isset($user)) Atualizar @else Cadastrar @endif
                            </button>
							
							@if(isset($user))
								<button type="submit" form="secondary-form" class="btn btn-danger btn">
									Deletar
								</button>
							@endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
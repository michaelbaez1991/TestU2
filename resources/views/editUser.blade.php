@extends('layouts.app')
    
@section('content')
    <br>
    <div class="container">
         <div class="row">
            <div class="col align-self-start">
                <h2>Modificar Usuario</h2>
            </div>
            <div class="col align-self-center">
            </div>
            <div class="col align-self-end">
                Crear nuevo pasatiempo 
                <button type="button" class="btn btn-success btn-sm" id="activarModalPasatiempo"><i class="fas fa-plus"></i></button>
            </div>
        </div><br>
        <div class="row align-items-center">
            <div class="col">
      
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @else
                    @if (Session::has('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong> {{ Session::get('status') }} </strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                @endif
            </div>

        </div>
    </div><br>

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Perfil</th>
                            <th scope="col">Ciudad</th>
                            <th scope="col">Pasatiempos</th>
                            <th scope="col">Fecha Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp

                        @foreach ($personas as $persona)
                            <tr>
                                <th scope="row">{{ $i }}</th>
                                <td>{{ $persona->name }}</td>
                                <td>{{ $persona->username }}</td>
                                <td>{{ $persona->email }}</td>
                                <td>{{ $persona->namePerfil }}</td>
                                <td>{{ $persona->nombreCiudad }}</td>
                                <td>
                                    <ul class="list-group">
                                        @foreach ($pasatiempos as $pasatiempo)
                                            @if ($persona->id_users == $pasatiempo->users_id)
                                                <a href="#" class="list-group-item list-group-item-action"> {{ $pasatiempo->pasatiempo }} </a>
                                            @endif
                                        @endforeach
                                    </ul><br>
                                    <button type="button" class="btn btn-warning btn-sm modal-edicion" data-toggle="modal" data-target="#editPasatiempo{{ $i }} " title="Editar pasatiempos"><i class="fas fa-edit" onclick="pasatiempoSelectEdit({{ $i }})"></i></button>
                                    <button type="button" class="btn btn-primary btn-sm modal-edicion" data-toggle="modal" data-target="#aggPasatiempo{{ $i }} " title="Agregar pasatiempo"><i class="fas fa-plus" onclick="pasatiempoSelectEdit({{ $i }})"></i></button>
                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deletePasatiempo{{ $i }}" title="Eliminar pasatiempo"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                    @if(Auth::user()->hasPerfil('Administrador'))
                                        <button type="button" class="btn btn-success btn-sm modal-edicion" data-toggle="modal" data-target="#editAll{{ $i }} " title="Editar datos del usuarios"><i class="fas fa-cogs" onclick="pasatiempoSelectAllEdit({{ $i }}, {{ $persona->id_users }})"></i></button>
                                    @endif
                                </td>
                                <td>{{ $persona->created_at }}</td>
                            </tr>

                            <!-- Modal Editar -->
                            <div class="modal fade bd-example-modal-lg" id="editPasatiempo{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar pasatiempo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('pasatiempoUpdate') }}">
                                                @csrf

                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="pasatiempoIdUpdate">Pasatiempos del usuario</label>
                                                        <select class="form-control" name="pasatiempoIdUpdate" id="pasatiempoIdUpdate" required>
                                                            <option id="nodoArea0" disabled selected >...</option>
                                                            @foreach ($pasatiempos as $pasatiempo)
                                                                @if ($persona->id_users == $pasatiempo->users_id)
                                                                    <option id="nodoArea0" value="{{ $pasatiempo->id_pasatiempo }}">{{ $pasatiempo->pasatiempo }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="col">
                                                        <label for="">Agregar cambio</label>
                                                        <input type="text" class="form-control" name="pasatiempoUpdate" id="pasatiempoUpdate" disabled="true" placeholder="Seleccione para poder editar">
                                                        <input type="hidden" name="idUpdatePasatiempo" id="idUpdatePasatiempo"/>
                                                    </div>
                                                </div><br>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Editar all -->
                            <div class="modal fade bd-example-modal-lg" id="editAll{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar pasatiempo</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('userUpdate') }}">
                                                @csrf

                                                <div class="form-row">
                                                    {{-- Nombre --}}
                                                    <div class="col">
                                                        <label for="nombreUser">Nombre</label>
                                                        <input type="text" class="form-control" name="nombreUser" id="nombreUser" placeholder="ingrese nombre" required >
                                                    </div>

                                                    {{-- Usuario --}}
                                                    <div class="col">
                                                        <label for="usuarioUser">Usuario</label>
                                                        <input type="text" class="form-control" name="usuarioUser" id="usuarioUser" placeholder="ingrese nombre" required >
                                                    </div>

                                                    {{-- Correo --}}
                                                    <div class="col">
                                                        <label for="emailUser">Email</label>
                                                        <input type="email" class="form-control" name="emailUser" id="emailUser" placeholder="ingrese su correo" required>
                                                    </div>
                                                </div><br>

                                                <div class="form-row">
                                                    {{-- Perfil --}}
                                                    <div class="col">
                                                        <label for="perfilUser">Perfil</label>
                                                        <select name="perfilUser" id="perfilUser" class="form-control" required>
                                                        </select>
                                                    </div>

                                                    {{-- Ciudad --}}
                                                    <div class="col">
                                                        <label for="ciudadUser">Ciudad</label>
                                                        <select class="form-control" name="ciudadUser" id="ciudadUser" required>
                                                        </select>
                                                    </div>
                                                </div><br>

                                                <input type="hidden" name="id_users" value="{{ $persona->id_users }}" />   
                                        </div><br>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Guardar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal Insert -->
                            <div class="modal fade bd-example-modal-lg" id="aggPasatiempo{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Agregar nuevo pasatiempo a usuario</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('pasatiempoAgg') }}">
                                                @csrf

                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="pasatiempoIdAgg">Pasatiempos disponibles</label>
                                                        <select class="form-control" name="pasatiempoIdAgg" id="pasatiempoIdAgg" required>
                                                            <option id="nodoArea0" disabled selected >...</option>
                                                            @foreach ($pasatiemposG as $pasatiempo)
                                                                <option id="nodoArea0" value="{{ $pasatiempo->id }}">{{ $pasatiempo->pasatiempo }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <input type="hidden" name="pasatiempoUserIdAgg" value="{{ $persona->id_users }}" />    
                                                </div><br>
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Agregar a pasatiempos</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                            <!-- Modal Delete-->
                            <div class="modal fade" id="deletePasatiempo{{ $i }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">¿Realmente quieres eliminar este pasatiempo?</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('pasatiempoDelete') }}">
                                                @method('DELETE')
                                                @csrf
                                                <div class="form-row">
                                                    <div class="col">
                                                        <label for="pasatiempoIdDelete">Pasatiempos del usuario</label>
                                                        <select class="form-control" name="pasatiempoIdDelete" id="pasatiempoIdDelete" required>
                                                            <option id="nodoArea0" disabled selected >...</option>
                                                            @foreach ($pasatiempos as $pasatiempo)
                                                                @if ($persona->id_users == $pasatiempo->users_id)
                                                                    <option value=" {{ $pasatiempo->id_pasatiempoxuser }}"> {{ $pasatiempo->pasatiempo }} </option>
                                                                @endif
                                                            @endforeach
                                                        </select>

                                                        <input type="hidden" name="idDeletePasatiempo" value="{{ $persona->id_users }}" />   
                                                    </div>
                                                </div><br> 
                                        </div>
                                        <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" class="btn btn-primary">Borrar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @php
                                $i++;
                            @endphp
                        @endforeach

                        <!-- Modal Crear -->
                        <div class="modal fade bd-example-modal-lg" id="crearPersona" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Nuevo pasatiempo</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="POST" action="{{ route('pasatiempoCreate') }}">
                                            @csrf

                                            <div class="form-row">
                                                <div class="col">
                                                    <label for="newPasatiempo">Nombre del nuevo pasatiempo</label>
                                                    <input type="text" class="form-control" name="newPasatiempo" id="newPasatiempo" placeholder="ingrese el nombre del pasatiempo" required autocomplete="off">
                                                </div>
                                            </div><br>
                                    </div>
                                    <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-primary">Crear</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

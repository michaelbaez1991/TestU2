@extends('layouts.app')
    
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Bienvenido</div>
                    <div class="card-body">
                        @foreach(App\User::where('id', Auth::user()->id)->get() as $work)
                            {{-- {{ $work->username }} --}}
                            <form>
                                <div class="row justify-content-center">
                                    <div class="col-7">

                                        <div class="form-group row">
                                            <label for="nombre" class="col-sm-3 col-form-label">Nombre: </label>
                                            <div class="col-sm-7">
                                                <input type="text" readonly class="form-control" id="nombre" name="nombre" value="{{ $work->name }}">
                                            </div>
                                        </div>
                                    
                                        <div class="form-group row">
                                            <label for="nameUser" class="col-sm-3 col-form-label">usuario: </label>
                                            <div class="col-sm-7">
                                                <input type="text" readonly class="form-control" id="nameUser" name="nameUser" value="{{ $work->username }}">
                                            </div>
                                        </div>

                                            <div class="form-group row">
                                            <label for="correo" class="col-sm-3 col-form-label">Email: </label>
                                            <div class="col-sm-7">
                                                <input type="text" readonly class="form-control" id="correo" name="correo" value="{{ $work->email }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
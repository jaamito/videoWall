@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menú</div>

                <div class="card-body">
                    <form action="{{ url('/home/guardarVideo') }}" method="POST" enctype="multipart/form-data">
                        <label>Fichero:</label>
                        <input type="file" name="file">

                        <label>Nombre:</label>
                        <input type="text" name="name"></br></br>
                        <p>Pantallas</p>
                        <img src="pantallas.png">
                        <p>Selecciona la pantalla donde quieres ver el vídeo</p>
                        <ul style="list-style:none; margin-left: 16%">
                            <li><input type="radio" name="gender" value="11"> <strong style="font-size: 20px">(1,1)</strong>
                            <input type="radio" name="gender" value="12"> <strong style="font-size: 20px">(1,2)</strong></li>
                            <li><input type="radio" name="gender" value="21"> <strong style="font-size: 20px">(2,1)</strong>
                            <input type="radio" name="gender" value="22"> <strong style="font-size: 20px">(2,2)</strong></li></br></br>
                        </ul>
                        <button type="submit" class="btn btn-primary">
                            Añadir Película
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
<!--Guardar vídeos-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Guardar vídeo</div>
                <p>Los formatos válidos: flv,mp4,m3u8,ts,3gp,mov,avi,wmv
                 @if(Session::has('flash_message'))
                     <div class="alert alert-success alert-dismissable col-md-offset-6 col-md-6">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                       {{Session::get('flash_message')}}
                    </div>
                  @endif
                <div class="card-body">
                    <form action="{{ url('/home/guardarVideo') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <label>Fichero:</label>
                        <input type="file" name="file" required>

                        <label>Nombre:</label>
                        <input type="text" name="name" required></br></br>
                    
                        <p>El vídeo se guardará en todas las pantallas</p>
                        <button type="submit" class="btn btn-primary">
                            Añadir vídeo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div><br>
<!--Guardar vídeos-->
<!--Reproducir vídeos-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Reproducir vídeo</div>
                <p>Los formatos válidos: flv,mp4,m3u8,ts,3gp,mov,avi,wmv
                <div class="card-body">
                    <form action="{{ url('/home/reproducirVideo') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <p>Pantallas</p>
                        <img src="pantallas.png">
                        <p>Selecciona la pantalla donde quieres ver el vídeo</p>
                        <ul style="list-style:none; margin-left: 16%">

                            <li><input type="radio" name="pantalla" value="11"> <strong style="font-size: 20px">(1,1)</strong>
                            <select name="11">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>

                            <li><input type="radio" name="pantalla" value="12"> <strong style="font-size: 20px">(1,2)</strong>
                            <select name="12">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>

                            <li><input type="radio" name="pantalla" value="21"> <strong style="font-size: 20px">(2,1)</strong>
                            <select name="21">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>

                            <li><input type="radio" name="pantalla" value="22"> <strong style="font-size: 20px">(2,1)</strong>
                            <select name="22">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>
                                </br></br>
                        </ul>
                        <button type="submit" class="btn btn-primary">
                            Reproducir vídeo vídeo
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!--Reproducir vídeos-->
</div>
@endsection

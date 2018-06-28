@extends('layouts.app')

@section('content')

<div class="container">
<!--Guardar vídeos-->
    <div class="row justify-content-center" >
        <div class="col-md-8">
            <div class="card" style="background-color: #272727;color: #ff6b34;border-color: #ff6b34">
            <div class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727">
            <strong>Importar vídeo</strong></div>
                <div id="divEdit1" class="card-body" style="display: none;">
                <p style="font-size: 20px;">Los formatos válidos: flv,mp4,m3u8,ts,3gp,mov,avi,wmv
                 @if(Session::has('flash_message'))
                     <div class="alert alert-success alert-dismissable col-md-offset-6 col-md-6">
                      <button type="button" class="close" data-dismiss="alert">&times;</button>
                       {{Session::get('flash_message')}}
                    </div>
                  @endif
                    <form action="{{ url('/home/guardarVideo') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}

                        <label style="color: #ff6b34;font-size: 20px">Fichero:</label>
                        <input type="file" name="file" required>

                        <label style="color: #ff6b34;font-size: 20px">Nombre:</label>
                        <input type="text" name="name" required></br></br>
                    
                        <p style="color: #ff6b34;font-size: 20px">El vídeo se guardará en todas las pantallas</p>
                        <button type="submit" class="btn" style="background-color: #ff6b34; color: white;font-size: 20px">
                            Añadir vídeo
                        </button>
                    </form>
                </div>
            </div>
        </div>
       <div class="col-md-1">
            <div class="card" style="background-color: #272727;color: #ff6b34;border-color: #ff6b34">
                <button id="btOc1" onclick="mostrar1()" class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727;text-align: center;border-color: #ff6b34;display: block;">
                    <strong>+</strong>
                </button>
                <button id="btMo1" onclick="noMostrar1()" class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727;text-align: center;border-color: #ff6b34;display: none;">
                    <strong>-</strong>
                </button>
            </div>
        </div>
    </div><br>
<!--Guardar vídeos-->
<!--Reproducir vídeos-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #272727;color: #ff6b34;border-color: #ff6b34">
                <div class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727"><strong>Play vídeo</strong></div>
                <div id="divEdit2" class="card-body" style="display: none;">
                    <form action="{{ url('/home/reproducirVideo') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <p style="color: #ff6b34;font-size: 20px">Pantallas</p>
                        <img src="pantallas.png" class="pant">
                        <p style="color: #ff6b34;font-size: 20px">Selecciona la pantalla donde quieres ver el vídeo</p>
                        <ul style="list-style:none; margin-left: 16%">
                            <li><input type="checkbox" name="pantalla11" value="1"> <strong style="color: #ff6b34;font-size: 20px">(1,1)</strong>
                            <select name="11">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>

                            <li><input type="checkbox" name="pantalla12" value="1"> <strong style="color: #ff6b34;font-size: 20px">(1,2)</strong>
                            <select name="12">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>

                            <li><input type="checkbox" name="pantalla21" value="1"> <strong style="color: #ff6b34;font-size: 20px">(2,1)</strong>
                            <select name="21">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>

                            <li><input type="checkbox" name="pantalla22" value="1"> <strong style="color: #ff6b34;font-size: 20px">(2,2)</strong>
                            <select name="22">
                                <option value="0">--seleccionar--</option>
                                @foreach( $arrayVideos as $key => $video )
                                   <option value="{{$video->name}}">{{$video->name}}</option>
                                @endforeach
                            </select></li>
                                </br></br>
                        </ul>
                        <button type="submit" class="btn" style="background-color: #ff6b34; color: white;font-size: 20px">
                            Play vídeo
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div id="divEdit2" class="col-md-1" style="display: block;">
            <div class="card" style="background-color: #272727;color: #ff6b34;border-color: #ff6b34">
                <button id="btOc2" onclick="mostrar2()" class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727;text-align: center;border-color: #ff6b34">
                    <strong>+</strong>
                </button>
                 <button id="btMo2" onclick="noMostrar2()" class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727;text-align: center;border-color: #ff6b34;display: none;">
                    <strong>-</strong>
                </button>
            </div>
        </div>
    </div><br>
<!--Reproducir vídeos-->
<!--Parar vídeos-->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="background-color: #272727;color: #ff6b34;border-color: #ff6b34">
                <div class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727"><strong>Stop vídeo</strong></div>
                <div id="divEdit3" class="card-body" style="display: none;">
                    <form action="{{ url('/home/pararVideo') }}" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                        <p style="color: #ff6b34;font-size: 20px">Pantallas</p>
                        <img src="pantallas.png" class="pant">
                        <p style="color: #ff6b34;font-size: 20px">Selecciona la pantalla donde quieras apagar el vídeo</p>
                        <ul style="list-style:none; margin-left: 16%">
                            <div class="row">
                              <div class="col-md-2"><li><input type="checkbox" name="pantalla11" value="1"> <strong style="color: #ff6b34;font-size: 20px">(1,1)</strong></li></div>
                              <div class="col-md-2"><li><input type="checkbox" name="pantalla12" value="1"> <strong style="color: #ff6b34;font-size: 20px">(1,2)</strong></li></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                            </div>
                            <div class="row">
                              <div class="col-md-2"><li><input type="checkbox" name="pantalla21" value="1"> <strong style="color: #ff6b34;font-size: 20px">(2,1)</strong></li></div>
                              <div class="col-md-2"> <li><input type="checkbox" name="pantalla22" value="1"> <strong style="color: #ff6b34;font-size: 20px">(2,2)</strong></li></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                              <div class="col-md-2"></div>
                            </div>
                            </br></br>
                        </ul>
                        <button type="submit" class="btn" style="background-color: #ff6b34; color: white;font-size: 20px">
                            Stop vídeo
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-1" style="display: block;">
            <div class="card" style="background-color: #272727;color: #ff6b34;border-color: #ff6b34">
                <button id="btOc3" onclick="mostrar3()" class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727;text-align: center;border-color: #ff6b34;display: block;">
                    <strong>+</strong>
                </button>
                 <button id="btMo3" onclick="noMostrar3()" class="card-header" style="background-color: #ff6b34;font-size: 20px;color: #272727;text-align: center;border-color: #ff6b34;display: none;">
                    <strong>-</strong>
                </button>
            </div>
        </div>
    </div>
<!--Parar vídeos-->
</div>
<script type="text/javascript">
        function mostrar1(){
          document.getElementById('divEdit1').style.display = 'block';
          document.getElementById('btOc1').style.display = 'none';
          document.getElementById('btMo1').style.display = 'block';
        }
        function mostrar2(){
          document.getElementById('divEdit2').style.display = 'block';
          document.getElementById('btOc2').style.display = 'none';
          document.getElementById('btMo2').style.display = 'block';
        }
        function mostrar3(){
          document.getElementById('divEdit3').style.display = 'block';
          document.getElementById('btOc3').style.display = 'none';
          document.getElementById('btMo3').style.display = 'block';
        }

        function noMostrar1(){
          document.getElementById('divEdit1').style.display = 'none';
          document.getElementById('btOc1').style.display = 'block';
          document.getElementById('btMo1').style.display = 'none';
        }
        function noMostrar2(){
          document.getElementById('divEdit2').style.display = 'none';
          document.getElementById('btOc2').style.display = 'block';
          document.getElementById('btMo2').style.display = 'none';
        }
        function noMostrar3(){
          document.getElementById('divEdit3').style.display = 'none';
          document.getElementById('btOc3').style.display = 'block';
          document.getElementById('btMo3').style.display = 'none';
        }

      </script>
@endsection

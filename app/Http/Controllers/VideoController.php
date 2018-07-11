<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Controllers\SplFileInfo;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use App\nomVid;


class VideoController extends Controller
{
    
    public function guardarVideo(Request $request)
    {
    	$file = $request->input('file');
	    $nombre = $request->input('name');
	    if($nombre){
	    	if($request->hasFile('file')){
	    		$videos = nomVid::all();
			    $mime = $request->file('file')->getClientOriginalExtension();
				if ($mime == "flv" || $mime == "mp4" || $mime == "m3u8" || $mime == "ts" || $mime == "3gp" || $mime == "mov" || $mime == "avi" || $mime == "wmv" || $mime == "mkv"){
				  	$video = Input::file("file");
			        $vPath = public_path().'/video/';
			        $video->move($vPath, $request->input('name'));

			    	$file = public_path().'/scripts/copyServer.sh';
					$texto = "scp ".public_path().'/video/'.$nombre." pi@192.168.10.216:/home/pi/Videos &";
					$fp = fopen($file, "w");
					fwrite($fp, $texto);
					fclose($fp);

					$process = new Process('sh '.public_path().'/scripts/copyServer.sh');
					$process->setTimeout(60000);
					$process->run();
					// ejecutar despues de que el comando finalice
					if (!$process->isSuccessful()) {
					    throw new ProcessFailedException($process);
					}

					echo $process->getOutput();
					
					$vid = new nomVid();
			        $vid->name = $nombre;
			        $vid->save();
			        
			        \Session::flash('flash_message', 'Vídeo guardado y enviado correctamente ');
			    	return redirect("home");
				}else{
					
					\Session::flash('flash_message', 'Vídeo con formato incorrecto!');
			    	return redirect("home");
				}
	    		
	    	}else{
		        \Session::flash('flash_message', 'No has subido ningun archivo!');
			    	return redirect("home");
			}
		}else{
			\Session::flash('flash_message', 'Faltan campos por rellenar!');
			    	return redirect("home");
		}

    }
    public function reproducirVideo(Request $request){

    
    	if ($request->input('pantalla11') == '1'){
    		if($request->input('11') != '0'){
    			$file1 = public_path().'/scripts/11/play.sh';
    			$texto1 = "ssh pi@192.168.10.215 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('11')."' > /dev/null 2>&1 &";
				$fp1 = fopen($file1, "w");
				fwrite($fp1, $texto1);
				fclose($fp1);
				$process = new Process('sh '.public_path().'/scripts/11/stop.sh');
				$process->run();
				$process = new Process('sh '.public_path().'/scripts/11/play.sh');
				$process->run();
				// ejecutar despues de que el comando finalice
				if (!$process->isSuccessful()) {
				    throw new ProcessFailedException($process);
				}

				echo $process->getOutput();
				}

			}
    	if ($request->input('pantalla12') == '1'){
    		if($request->input('12') != '0'){
    			$file1 = public_path().'/scripts/12/play.sh';
    			$texto1 = "ssh pi@192.168.10.212 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('12')."' > /dev/null 2>&1 &";
				$fp1 = fopen($file1, "w");
				fwrite($fp1, $texto1);
				fclose($fp1);
				$process = new Process('sh '.public_path().'/scripts/12/stop.sh');
				$process->run();
				$process = new Process('sh '.public_path().'/scripts/12/play.sh');
				$process->run();
				// ejecutar despues de que el comando finalice
				if (!$process->isSuccessful()) {
				    throw new ProcessFailedException($process);
				}

				echo $process->getOutput();
				}
    	}
    	if ($request->input('pantalla21') == '1'){
    		if($request->input('21') != '0'){
    			$file1 = public_path().'/scripts/21/play.sh';
    			$texto1 = "ssh pi@192.168.10.214 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('21')."' > /dev/null 2>&1 &";
				$fp1 = fopen($file1, "w");
				fwrite($fp1, $texto1);
				fclose($fp1);
				$process = new Process('sh '.public_path().'/scripts/21/stop.sh');
				$process->run();
				$process = new Process('sh '.public_path().'/scripts/21/play.sh');
				$process->run();
				// ejecutar despues de que el comando finalice
				if (!$process->isSuccessful()) {
				    throw new ProcessFailedException($process);
				}

				echo $process->getOutput();
				}
    	}
    	if ($request->input('pantalla22') == '1'){
    		if($request->input('22') != '0'){
    			$file1 = public_path().'/scripts/22/play.sh';
    			$texto1 = "ssh pi@192.168.10.213 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('22')."' > /dev/null 2>&1 &";
				$fp1 = fopen($file1, "w");
				fwrite($fp1, $texto1);
				fclose($fp1);
				$process = new Process('sh '.public_path().'/scripts/22/stop.sh');
				$process->run();
				$process = new Process('sh '.public_path().'/scripts/22/play.sh');
				$process->run();
				// ejecutar despues de que el comando finalice
				if (!$process->isSuccessful()) {
				    throw new ProcessFailedException($process);
				}

				echo $process->getOutput();
				}
    	}
    	return redirect('home');
    }

    public function pararVideo(Request $request){
    	
    	$process = new Process('sh '.public_path().'/scripts/stopServer.sh');
		$process->run();

    	if ($request->input('pantalla11') == '1'){
				$process = new Process('sh '.public_path().'/scripts/11/stop.sh');
				$process->run();
				// ejecutar despues de que el comando para ver errores
				//if (!$process->isSuccessful()) {
				    //throw new ProcessFailedException($process);
				//}

				echo $process->getOutput();
    		}

    	if ($request->input('pantalla12') == '1'){
				$process = new Process('sh '.public_path().'/scripts/12/stop.sh');
				$process->run();
				// ejecutar despues de que el comando finalice

				echo $process->getOutput();
    	}

    	if ($request->input('pantalla21') == '1'){
				$process = new Process('sh '.public_path().'/scripts/21/stop.sh');
				$process->run();
				// ejecutar despues de que el comando finalice

				echo $process->getOutput();
    	}

    	if ($request->input('pantalla22') == '1'){
				$process = new Process('sh '.public_path().'/scripts/22/stop.sh');
				$process->run();
				// ejecutar despues de que el comando finalice

				echo $process->getOutput();
    	}

    		$process = new Process('sh '.public_path().'/scripts/stopServer.sh');
			$process->run();
				// ejecutar despues de que el comando finalice

			echo $process->getOutput();

    	return redirect('home');

    }

    public function reiniciarRaspi(Request $request){

    	$reiniciarRaspi = $request->input('reiniciar');

    	if($reiniciarRaspi == "1"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.215 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	if($reiniciarRaspi == "2"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.212 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	if($reiniciarRaspi == "3"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.214 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	if($reiniciarRaspi == "4"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.213 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	return redirect('home');
    }

    public function reproducirVideoPiWall(Request $request){
    	$process = new Process('sh '.public_path().'/scripts/stopServer.sh');
		$process->run();

		$file1 = public_path().'/scripts/11/playPi.sh';
		$texto1 = "ssh pi@192.168.10.215 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
		$fp1 = fopen($file1, "w");
		fwrite($fp1, $texto1);
		fclose($fp1);
		$process = new Process('sh '.public_path().'/scripts/11/stop.sh');
		$process->run();
		$process = new Process('sh '.public_path().'/scripts/11/playPi.sh');
		$process->run();
		// ejecutar despues de que el comando finalice
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		echo $process->getOutput();
		
		$file1 = public_path().'/scripts/12/playPi.sh';
		$texto1 = "ssh pi@192.168.10.212 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
		$fp1 = fopen($file1, "w");
		fwrite($fp1, $texto1);
		fclose($fp1);
		$process = new Process('sh '.public_path().'/scripts/12/stop.sh');
		$process->run();
		$process = new Process('sh '.public_path().'/scripts/12/playPi.sh');
		$process->run();
		// ejecutar despues de que el comando finalice
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		echo $process->getOutput();
			

		$file1 = public_path().'/scripts/21/playPi.sh';
		$texto1 = "ssh pi@192.168.10.214 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
		$fp1 = fopen($file1, "w");
		fwrite($fp1, $texto1);
		fclose($fp1);
		$process = new Process('sh '.public_path().'/scripts/21/stop.sh');
		$process->run();
		$process = new Process('sh '.public_path().'/scripts/21/playPi.sh');
		$process->run();
		// ejecutar despues de que el comando finalice
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		echo $process->getOutput();
				

		$file1 = public_path().'/scripts/22/playPi.sh';
		$texto1 = "ssh pi@192.168.10.213 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
		$fp1 = fopen($file1, "w");
		fwrite($fp1, $texto1);
		fclose($fp1);
		$process = new Process('sh '.public_path().'/scripts/22/stop.sh');
		$process->run();
		$process = new Process('sh '.public_path().'/scripts/22/playPi.sh');
		$process->run();
		// ejecutar despues de que el comando finalice
		if (!$process->isSuccessful()) {
		    throw new ProcessFailedException($process);
		}
		echo $process->getOutput();

		$video = $request->input('piWall');
		// Server
		
			$file1 = public_path().'/scripts/playPiServer.sh';
			$texto1 = "ssh pi@192.168.10.216 'ffmpeg -stream_loop -1 -re -i /home/pi/Videos/".$video." -vcodec copy -f avi -an udp://239.0.1.23:1234' > /dev/null 2>&1 &";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/playPiServer.sh');
			$process->run();
			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}
			echo $process->getOutput();
		
    	return redirect('home');
    }
}

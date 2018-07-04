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
    	$mime = $request->file('file')->getClientOriginalExtension();
    	$nombre = $request->input('name');
		
		if ($mime == "flv" || $mime == "mp4" || $mime == "m3u8" || $mime == "ts" || $mime == "3gp" || $mime == "mov" || $mime == "avi" || $mime == "wmv"){
		  	$video = Input::file("file");
	        $vPath = public_path().'/video/';
	        $video->move($vPath, $request->input('name'));

        	$file1 = public_path().'/scripts/11/copy.sh';
        	$file2 = public_path().'/scripts/12/copy.sh';
        	$file3 = public_path().'/scripts/21/copy.sh';
        	$file4 = public_path().'/scripts/22/copy.sh';
        	$file5 = public_path().'/scripts/copyServer.sh';
			$texto1 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.215:/home/pi/Videos > /dev/null 2>&1 &";
			$texto2 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.212:/home/pi/Videos > /dev/null 2>&1 &";
			$texto3 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.214:/home/pi/Videos > /dev/null 2>&1 &";
			$texto4 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.213:/home/pi/Videos > /dev/null 2>&1 &";
			$texto5 = "scp -i ".public_path().'/video/'.$nombre." pi@192.168.10.216:/home/pi/Videos > /dev/null 2>&1 &";
			$fp1 = fopen($file1, "w");
			$fp2 = fopen($file2, "w");
			$fp3 = fopen($file3, "w");
			$fp4 = fopen($file4, "w");
			$fp5 = fopen($file5, "w");
			fwrite($fp1, $texto1);
			fwrite($fp2, $texto2);
			fwrite($fp3, $texto3);
			fwrite($fp4, $texto4);
			fwrite($fp5, $texto5);
			fclose($fp1);
			fclose($fp2);
			fclose($fp3);
			fclose($fp4);
			fclose($fp5);
			
			$vid = new nomVid();
	        $vid->name = $nombre;
	        $vid->save();

			$process = new Process('sh '.public_path().'/scripts/11/copy.sh');
			$process->run();
			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}

			echo $process->getOutput();
			

			$process = new Process('sh '.public_path().'/scripts/12/copy.sh');
			$process->run();
			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}

			echo $process->getOutput();
			

			$process = new Process('sh '.public_path().'/scripts/21/copy.sh');
			$process->run();
			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}

			echo $process->getOutput();
			
			$process = new Process('sh '.public_path().'/scripts/22/copy.sh');
			$process->run();
			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}

			$process = new Process('sh '.public_path().'/scripts/copyServer.sh');
			$process->run();
			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}

			echo $process->getOutput();
			$mensaje = "1";
	        \Session::flash('flash_message', 'Vídeo guardado y enviado correctamente ');
	    	return view('home',array('mensaje'=>$mensaje));
		}else{
			$mensaje = "0";
			\Session::flash('flash_message', 'Vídeo con formato incorrecto!');
	    	return view('home',array('mensaje'=>$mensaje));

		}
    }
    public function reproducirVideo(Request $request){

    
    	if ($request->input('pantalla11') == '1'){
    		if($request->input('11') != '0'){
    			$file1 = public_path().'/scripts/11/play.sh';
    			$texto1 = "ssh pi@192.168.10.215 -i videowall 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('11')."' > /dev/null 2>&1 &";
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
    			$texto1 = "ssh pi@192.168.10.212 -i videowall 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('12')."' > /dev/null 2>&1 &";
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
    			$texto1 = "ssh pi@192.168.10.214 -i videowall 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('21')."' > /dev/null 2>&1 &";
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
    			$texto1 = "ssh pi@192.168.10.213 -i videowall 'omxplayer --loop --no-osd /home/pi/Videos/".$request->input('22')."' > /dev/null 2>&1 &";
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
				// ejecutar despues de que el comando finalice
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
			$texto1 = "ssh pi@192.168.10.215 -i videowall 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	if($reiniciarRaspi == "2"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.212 -i videowall 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	if($reiniciarRaspi == "3"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.214 -i videowall 'sudo init 6'";
			$fp1 = fopen($file1, "w");
			fwrite($fp1, $texto1);
			fclose($fp1);
			$process = new Process('sh '.public_path().'/scripts/reiniciar.sh');
			$process->run();
    	}

    	if($reiniciarRaspi == "4"){
    		$file1 = public_path().'/scripts/reiniciar.sh';
			$texto1 = "ssh pi@192.168.10.213 -i videowall 'sudo init 6'";
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
		$texto1 = "ssh pi@192.168.10.215 -i videowall 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
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
		$texto1 = "ssh pi@192.168.10.212 -i videowall 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
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
		$texto1 = "ssh pi@192.168.10.214 -i videowall 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
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
		$texto1 = "ssh pi@192.168.10.213 -i videowall 'pwomxplayer -A udp://239.0.1.23:1234?buffer_size=1200000B' > /dev/null 2>&1 &";
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
			$texto1 = "ssh pi@192.168.10.216 -i videowall 'ffmpeg -stream_loop -1 -re -i /home/pi/Videos/".$video." -vcodec copy -f avi -an udp://239.0.1.23:1234' > /dev/null 2>&1 &";
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

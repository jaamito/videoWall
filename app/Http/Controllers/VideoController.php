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
	        $vid = new nomVid();
	        $vid->name = $nombre;
	        $vid->save();

	        //Prueba luego eliminar-----------------------------------------------------------------------
	        $file = public_path().'/scripts/prueba/copy.sh';
			$texto = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.11.200:/home/pi/Desktop";
			$fp = fopen($file, "w");
			fwrite($fp, $texto);
			fclose($fp);
			$process = new Process('sh '.public_path().'/scripts/prueba/copy.sh');
			$process->run();
			//Prueba luego eliminar-----------------------------------------------------------------------

			// ejecutar despues de que el comando finalice
			if (!$process->isSuccessful()) {
			    throw new ProcessFailedException($process);
			}

			echo $process->getOutput();

        	$file1 = public_path().'/scripts/11/copy.sh';
        	$file2 = public_path().'/scripts/12/copy.sh';
        	$file3 = public_path().'/scripts/21/copy.sh';
        	$file4 = public_path().'/scripts/22/copy.sh';
			$texto1 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.215:/home/pi/Videos";
			$texto2 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.212:/home/pi/Videos";
			$texto3 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.214:/home/pi/Videos";
			$texto4 = "scp -i videowall ".public_path().'/video/'.$nombre." pi@192.168.10.213:/home/pi/Videos";
			$fp1 = fopen($file1, "w");
			$fp2 = fopen($file2, "w");
			$fp3 = fopen($file3, "w");
			$fp4 = fopen($file4, "w");
			fwrite($fp1, $texto1);
			fwrite($fp2, $texto2);
			fwrite($fp3, $texto3);
			fwrite($fp4, $texto4);
			fclose($fp1);
			fclose($fp2);
			fclose($fp3);
			fclose($fp4);
			/* QUITAR ESTO CUANDO ESTEN EN RED
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

			echo $process->getOutput();
			*/
	        \Session::flash('flash_message', 'Vídeo guardado y enviado correctamente ');
	    	return redirect('home');
		}else{

			\Session::flash('flash_message', 'Vídeo con formato incorrecto!');
	    	return redirect('home');

		}
    }
    public function reproducirVideo(Request $request){



    }
}

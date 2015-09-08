<?php
include 'php_serial.class.php';

function enviarSMS ($nr_tlm,$sms)
{
	$serial = new PhpSerial;

	$serial->deviceSet("COM6"); //choose COM port

	$serial->confBaudRate(9600); //Choose Bitrate
			
	$serial->deviceOpen('w+'); //Open COM port

	$serial->sendMessage("AT".chr(13)); //Check if is acessible

    //read response and check if it can continue
	$codigo_at = $serial->readPort();
	$verificar = substr($codigo_at, -4);
	if (substr($verificar, 0, 2)=='OK')
	{
        
		$serial->sendMessage("AT+CMGF=1".chr(13)); //Prepare to SMS

        //read response and check if it may continue
		$codigo_at = $serial->readPort();
		$verificar = substr($codigo_at, -4);
		if (substr($verificar, 0, 2)=='OK')
		{

			$serial->sendMessage('AT+CMGS="'.$nr_tlm.'"'.chr(13)); //send destination number
			$serial->sendMessage($sms . chr(26)); //send SMS text
			sleep(5);

            //read response and check if the sms was sent
			$codigo_at = $serial->readSMS();
			$verificar = substr($codigo_at, -4);
			if (substr($verificar, 0, 2)=='OK')
			{
				$resposta= "OK";
			}else{
				$resposta= "NOK";
			}
		}else{
			$resposta= "NOK";
		}
	}else{
		$resposta="NOK";
	}

	$serial->deviceClose(); //close COM port - NEVER FORGET THIS STEP!
	return $resposta;
}

$sms="Message to send!";
$numero=911111111;

$resposta_sms=enviarSMS($numero,$sms);


?>

<head>
	<meta charset="UTF-8" />

</head>
<?php

function pingDomain($domain,$port){
    $starttime = microtime(true);
    $file      = fsockopen ($domain, $port, $errno, $errstr, 10);
    $stoptime  = microtime(true);
    $status    = 0;

    if (!$file) $status = -1;  // Site is down
    else {
        fclose($file);
        $status = ($stoptime - $starttime) * 1000;
        $status = floor($status);
    }
    return $status;
}
$serverIP="127.0.0.1";
if(($ping=pingDomain($serverIP,"25565"))==-1)
	echo "Minecraft Server $serverIP\t <span style='color:red'>X</span>";
else
{
	echo "Minecraft Server $serverIP\t <span style='color:green'>";
	$pingMaxTime=500;
	if($ping>$pingMaxTime)
		echo"</span><span style='color:gray'>▁▂▃▅▇</span>";
	else
	{
		$green=round(($pingMaxTime-$ping)/($pingMaxTime/5));
		$i=0;
		$signal=array("▁","▂","▃","▅","▇");
		for(;$i<$green;$i++)
			echo $signal[$i];
		echo "</span><span style='color:gray'>";
		for(;$i<5;$i++)
			echo $signal[$i];
		echo "</span>";
	}
	echo 'reply'. $ping . 'ms';

}
?>
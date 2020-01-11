<?php 
error_reporting(0);
  $source = $_GET['source'];
	if ($source == 't') {
		$data = shell_exec('cat /var/www/html/sensor_web/t.txt');
	} elseif ($source == 'rh') {
		$data = shell_exec('cat /var/www/html/sensor_web/rh.txt');
	} elseif ($source == 'ah') {
		$data = shell_exec('cat /var/www/html/sensor_web/ah.txt');
	} elseif ($source == 'dp') {
		$data = shell_exec('cat /var/www/html/sensor_web/dp.txt');
	} else {
		$data = -256;
	}
  echo $data;
 
?>

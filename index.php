<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Zhandos.pc
 * Date: 27.09.13
 * Time: 1:39
 * To change this template use File | Settings | File Templates.
 * запускать run.bat
 * запуститься 30 скриптов
 * в test_2.txt должно быть тоже что и в test.txt
 */


$file = fopen('test.txt', 'r');

flock($file, LOCK_EX);
$pos = getPos();
fseek($file, $pos);
$data = array();
for ($i = 0; $i < 1000; $i ++) {
	$data[] = fgets($file,1000);
}
setPos(ftell($file));
$dbSimulateFile = fopen('test_2.txt', 'a');
flock($dbSimulateFile, LOCK_EX);
foreach ($data as $v) {
	fwrite($dbSimulateFile, $v);
}
flock($dbSimulateFile, LOCK_UN);
fclose($dbSimulateFile);
flock($file, LOCK_UN);
fclose($file);
//echo '<pre>';
//var_dump($data);
//echo '</pre>';


function getPos() {
	$posFile = fopen('pos.txt', 'r');
	flock($posFile, LOCK_SH);
	$pos = fgets($posFile, 1000);
	flock($posFile, LOCK_UN);
	fclose($posFile);
	return $pos;
}

function setPos($pos) {
	file_put_contents('pos.txt', $pos, LOCK_EX);
}


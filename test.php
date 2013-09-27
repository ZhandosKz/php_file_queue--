<?php
$file = fopen('test.txt', 'a');
for ($i = 1; $i <= 30000; $i++)
{
	fwrite($file, 'line: '.$i."\n");
}
fclose($file);
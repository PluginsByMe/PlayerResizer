<?php
$server = proc_open(PHP_BINARY . " src/pocketmine/PocketMine.php --no-wizard", [
//$server = proc_open("./start.sh --no-wizard", [
	0 => ["pipe", "r"],
	1 => ["pipe", "w"],
	2 => ["pipe", "w"]
], $pipes);
if(!is_resource($server)){
	die('Failed to create process');
}
fwrite($pipes[0], "plugins\nhelp\nresizeme 5\nresizeme\nresizethem\nstop\n\n");
fclose($pipes[0]);
while(!feof($pipes[1])){
	echo fgets($pipes[1]);
}
fclose($pipes[1]);
fclose($pipes[2]);
echo "\n\nReturn value: ". proc_close($server) ."\n";
if(count(glob("../*.log")) === 0){
	echo "The PlayerResizer plugin has no unrecoverable errors and is working well!\nYAY!";
	exit(0);
}else{
	echo "The PlayerResizer plugin has a syntax error.\nIt will be fixed whenever the developers have a chance.\nPlease be patient and wait for them to fix it.";
	exit(1);
}

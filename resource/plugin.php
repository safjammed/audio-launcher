<?php
/*
	THIS FILE MANAGES ALL THE PLUGINS
*/

//Keeps track of all plugins
global $plugins; $plugins=[];


//Initiate all plugins
foreach (glob("plugins/*.php") as $filename)
{	
    include_once $filename; 
    //echo $filename."        ";  
}

$pluginNamesExt = preg_grep('~\.(php)$~', scandir(__DIR__.'/../plugins/')); // gets filenames of plugins



//gets all the name of the languages in a single array
foreach ($pluginNamesExt as $singlePlugin) {
	$x= substr($singlePlugin, 0, strrpos($singlePlugin, '.php'));
	array_push($plugins, $x);
}

//var_dump( glob("plugins/*.php"));

?>
<?php 
/**
* 
*/
class jsConsole
{

    public function log($msg){
       		$html = '<script type="text/javascript">console.log("'.$msg.'");</script>';
       		echo $html;    	
    }


	public function info($msg){
		$html = '<script type="text/javascript">console.info("'.$msg.'");</script>';
       		echo $html;
	}
}



$console= new jsConsole();
 ?>
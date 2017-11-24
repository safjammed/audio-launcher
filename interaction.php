<?php 
include_once 'resource/session.php';
include_once 'resource/Database.php';    
include_once 'resource/utilities.php';

header('Content-Type: application/json');

if (isset($_GET['update'])) {
	$audio_id = $_GET['update'];
	$likes = 0;
	$dislikes = 0;
	$data = [];

	$sql = "SELECT * FROM interactions WHERE audio_id =".$audio_id;
	$statement = $db->prepare($sql);
	$statement->execute();
	while ($row = $statement->fetch()) {
		if ($row['type'] == 0) { //if dislike
			$dislikes ++;
		}elseif ($row['type'] == 1) { //if like
			$likes ++;
		}else{//if nothing found
			$likes = 0;
			$dislikes = 0;
		}
	}
	$data = ['likes'=>$likes, 'dislikes'=>$dislikes];

	echo json_encode($data);
}elseif ($_GET['type']) { //if likes or dislikes was performed
	$type = ($_GET['type'] == 'like') ? 1 : 0;
	$audio_id = $_GET['audio_id'];
	$user_id =$_GET['user_id'];
	$data = [];
	//see if the user has already made an interaction
	if(interationMade($db, $user_id, $audio_id) == false){
		$statement=$db->prepare("INSERT INTO interactions (user_id,audio_id,type) VALUES (:user_id,:audio_id,:type)");
		$statement->execute([':user_id'=> $user_id,':audio_id'=>$audio_id,':type'=>$type]);		
	}else{
		$data = ['disable'=>true];
	}
	//if the user already made and interaction
		//disable the buttons

	echo json_encode($data);
}



?>
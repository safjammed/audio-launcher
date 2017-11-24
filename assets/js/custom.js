$(function () { //Document ready
	var disablelikebtn= function(){
	//disable (dis)like buttons
		$('#addLikes').prop('disabled','disabled');
		$('#addDislikes').prop('disabled','disabled');
	}
	//get latest likes count
	var getLikeInfo = function () {
		var audioid = $('#addLikes').data('audioid');
		$.get('interaction.php?update='+audioid, function(data) {
			// console.log(data);
			$('#addLikes .badge').text(data.likes);
			$('#addDislikes .badge').text(data.dislikes);
		});
	}
	setInterval(function(){
		getLikeInfo();
	},500);
	getLikeInfo();
	//parse Likes
	$("#addLikes").click(function(event) {
		var audioid = $(this).data('audioid');
		var userid = $(this).data('userid');
		console.log(userid);
		disablelikebtn();
		getLikeInfo();
		$.get('interaction.php?type=like&audio_id='+audioid+'&user_id='+userid, function(data){
			getLikeInfo();
			console.log(data);
		});
	});

	$("#addDislikes").click(function(event) {
		var audioid = $(this).data('audioid');
		var userid = $(this).data('userid');
		disablelikebtn();
		getLikeInfo();
		$.get('interaction.php?type=dislike&audio_id='+audioid+'&user_id='+userid, function(data){
			getLikeInfo();
			console.log(data);
		});
	});
	
});
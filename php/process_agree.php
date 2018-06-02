<?php
	session_start();		
	@ $db = mysqli_connect('localhost','root','1q2w3e','testpic');
	
	if( $_SESSION['username'] == $_SESSION['question_user'] ){
		$query = "update users set points = points+".$_SESSION['question_points']." where userid = ".$_GET['a'];
		mysqli_query($db,$query);
		$query = 'update questions set solved = 1 where id = '.$_SESSION["question_id"];
		mysqli_query($db,$query);
	}
	else{
		echo '<script>alert("因为你不是提问者所以无法采纳!");window.history.back();</script>';
	}
	$db->close();
?>
<script>
window.history.back();
</script>
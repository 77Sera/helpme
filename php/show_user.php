<?php
	session_start();
	
	if( isset($_GET['d']) ){
		if($_GET['d'] == 1){
			$_SESSION['user'] = 'off';
		}
	}
	
	if( isset($_SESSION['user']) && $_SESSION['user'] == 'on' ){
		@ $db = mysqli_connect('localhost','root','1q2w3e','testpic');
		$query = 'select * from users where username="'.$_SESSION['username'].'"';
		$result = mysqli_query($db,$query);
		$row = mysqli_fetch_assoc($result);
		$_SESSION['points'] = $row['points'];
		mysqli_close($db);
		
		if( !isset($_SESSION['username']) ){
			$_SESSION['username'] = '用户名';
		}
		
		if( preg_match('/\?/',$_SERVER['REQUEST_URI']) ){
			$add = '&';
		}
		else{
			$add = '?';
		}
		
		echo "<li>".$_SESSION['username']." , <a href='./".preg_replace('/(\/.*?\/)/','',$_SERVER['REQUEST_URI']).$add."d=1'>退出</a></li>
			<li>积分：".$_SESSION['points']."</li>";
	}
	else{
		echo '<li><a href="./php/login.php">登录</a>/<a href="./php/register.php">注册</a></li>';
	}
?>
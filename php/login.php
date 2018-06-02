<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link rel="stylesheet" href="./../css/login_register.css" >
</head>
<body>
	<a id="back" href="./../index.php">←返回主页</a>
	<div class="form_user">
		<p>哈喽! 欢迎登录!</p>
		<form action="" method="POST">
			<ul>
				用户名<li><input class="input" type="text" name="username" placeholder="enter your username" maxlength="20"/></li>
				密码<li><input class="input" type="password" name="password" placeholder="enter your password" maxlength="20"/></li>
				<li><input type="submit" id='button' value="登录" /><a href="./register.php">还没注册?去注册→</a></li>
			</ul>
		</form>
	</div>
<script>
	window.onload = function(){
		var btn = document.getElementById('button');
		btn.onclick = function(){
			var username = document.getElementsByName('username')[0];
			if( username.value == '' ){
				alert('用户名为空!');
				return false;
			}
			var password = document.getElementsByName('password')[0];
			if( password.value == '' ){
				alert('密码为空!');
				return false;
			}
			return true;
		}
	}
</script>
</body>
</html>
<?php
	session_start();

	if( isset($_POST['username']) && isset($_POST['password']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		@ $db = mysqli_connect('localhost','root','1q2w3e','testpic');
		
		$query = 'select * from users where username="'.$username.'" and password="'.sha1($password).'"';
		
		$result = mysqli_query($db,$query);
		
		$row = mysqli_fetch_assoc($result);
		
		if( $row['username'] != '' && $row['username'] == $username ){
			$_SESSION['username'] = $username;
			$_SESSION['points'] = $row['points'];
			$_SESSION['user'] = 'on';
			echo '<script>
			alert("登录成功!");
			window.location.href="./../index.php";
			</script>';
		}
		else{
			echo '<script>alert("用户名或密码错误!");</script>';
		}
		
		$db->close();
	}
?>
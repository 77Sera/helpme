<?php
	function f_show_header($title){
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><? echo $title; ?></title>
	<link rel="stylesheet" href="./css/setting.css" >
	<script src="./scripts/jquery-3.2.1.min.js"></script>
	<script src="./scripts/jquery.animate-shadow.js"></script>
</head>
<body>
	<div id='header'>
		<div id='bg_header'>
		<div id='header_top'> <?#页面顶端信息 主站名+余额显示+用户信息?>
			<a href="./index.php" target="_self"><h1 id="header_title">Help觅</h1></a>
			<div id='header_list'>
				<ul>
					<li><a target='_self' href='./index.php'>主页</a></li>
					<?php include('show_user.php'); ?>
				</ul>
			</div>	
		</div>

		<div id='header_middle'> <? #search框?>
				
		</div>
		</div>
		
		<div id='header_bottom'> <? #一个list，‘全部 线代 高数 XX 其它’?>
			<div id='subject_list'>
				<ul>
					<li><a target="_self" href="./index.php?s=0">全部</a></li>
					<li><a target="_self" href="./index.php?s=1">线代</a></li>
					<li><a target="_self" href="./index.php?s=2">高数</a></li>
					<li><a target="_self" href="./index.php?s=3">其它</a></li>
					<li id="post_question"><a href="./upload_question.php" target="_self">我要提问</a></li>
					<li><div id="search">
					<form action="http://www.baidu.com/s" method="post"><input type="search" placeholder="例:概率论78题肿么做?">
					<input type="submit" value="搜索"/></form>
				</div></li>
				</ul>
			</div>
		</div>
	</div>
<?php
}
?>
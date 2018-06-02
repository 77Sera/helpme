<?php
	include('./php/f_showquestion.php');
	include('./php/f_show_header.php');
	include('./php/f_show_footer.php');
	include('./php/f_show_hotquestion.php');
	
	f_show_header('Help觅——What\'s your question(｡･∀･)ﾉﾞ');
?>
	
	<div id='content'> <? #页面主体内容 类似b站那种排版?>
		<div id='question_list'>
			<? 
				@ $id = $_GET['id'];
				if(!isset($id)){
					@ $db = mysqli_connect('localhost','root','1q2w3e','testpic');
					$query = "select id from questions order by id desc limit 1";
					$result = mysqli_query($db,$query);
					$row = mysqli_fetch_assoc($result);
					$id = $row['id'];
					$db->close();
				}
			
				if( isset($_GET['s']) ){
					$s = $_GET['s'];
				}
				else{
					$s = 0;
				}
			
				f_showquestion($id,$s);
				/*
				if( isset($_GET['s'] ) ){
						echo '<script>
							$("#question_list li[class!='.$_GET['s'].']").css("display","none");
						</script>';
				}
				*/
				f_show_hotquestion();
			?>
		</div>
	</div>
	
<?php
	f_show_footer();
?>

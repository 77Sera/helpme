<?php
	include('./php/f_showquestion.php');
	include('./php/f_show_header.php');
	include('./php/f_show_footer.php');
	include('./php/f_show_hotquestion.php');
	
	f_show_header('A question');
?>

<br />
<hr />

<div id='show_question'>
	<div id='question'>
	<?php
	$q_url = $_GET["q_url"];
	
	@ $db = mysqli_connect('localhost' , 'root' , '1q2w3e' , 'testpic');
		
	$query = "select * from questions where position='$q_url'";//.$q_url."'";
		
	$result = mysqli_query($db,$query);
	
	$solved = 0;
	
	if( $result->num_rows == 0 ){
		echo '<p>呃。。。好像出了一点问题。</p>
		<p>您可以尝试向网站管理员反馈这个错误</p>
		<a href="./index.php">返回主页</a>';
	}
	else{
		$row = mysqli_fetch_assoc($result);
		
		$solved = $row['solved'];
		
		$query = "select * from users where userid =".$row['userid'];
		$tmp_result = mysqli_query($db,$query);
		$tmp_row = mysqli_fetch_assoc($tmp_result);
		
		echo '<div id="question_details">';
		echo '用户:'.$tmp_row["username"].'<br /><br /><span>Q:</span><span>'.$row["description"].'</span>';
		echo '</div><br /><br />';
		echo '<img id="question_img" src="'.$q_url.'"  alt="question pic"/><hr />';
	
		$query = 'select * from answers where questionid ='.$row['id'];
		
		// 将问题id放到session里;
		$_SESSION['question_id'] = $row['id'];
		$_SESSION['question_user'] = $tmp_row['username'];
		$_SESSION['question_points'] = $row['points'];
		
		echo '<ul>';
		
		$result = mysqli_query($db,$query);
		$i = 1;
		if( $result->num_rows != 0 ){
			while( $row = mysqli_fetch_assoc($result) ){
				$query = 'select username from users where userid = '.$row['userid'];
				$tmp_result = mysqli_query($db,$query);
				$tmp_row = mysqli_fetch_assoc($tmp_result);
				echo 'Floor '.$i.'<br /><br/> '.$tmp_row["username"].' 的回答:<br /><li><p>'.$row["description"].'</p><img class="answer_pic" title="answer" src="'.$row['position'].'" /></li>
				<p><a class="agree" href="./php/process_agree.php?a='.$row['userid'].'">采纳√</a></p><hr />';
				$i+=1;
			}
		}
		else{
			echo '<li><p>尚无人回答TA的问题噢~</p></li>';
		}
		echo '</ul>';	
	}
	
	$db->close();

	?>
	</div>
</div>

<div id='answer'>
	<p>A:</p>
	<form action="./php/process_answer.php" method="POST" enctype="multipart/form-data">
		<span>插入图片: </span><input type="file" name="file" id='file' size="20"  />
		<br /><br />
		文字描述:<textarea id="answer_contents" name="answer_contents">适当的描述有时也是必要的噢~</textarea>
		<input id='submit_button' type="submit" value="提交回答" />
	</form>
</div>

<?php
	if( !isset($_SESSION['user']) ){
		$_SESSION['user'] = 'off';
	}

	if( $_SESSION['user'] == 'off' ){
		echo '<script>
			$(document).ready(function(){
				$("input[type=submit]").click(function(){
					alert("回答前先登录吧!");
					return false;
				})
				$(".agree").css("display","none")
			})
		</script>';
	}
	else{
		echo '<script>
		$(document).ready(function(){
			$("input[type=submit]").click(function(){
				var file = document.getElementById("file");
				if( file.value == "" ){
					alert("传个图呗~");
					return false;
				}
			})
		})
		</script>';
	}
	
	if( $solved == 1 ){
		echo '<script>
			$(document).ready(function(){
				$(".agree").css("display","none");
			})
		</script>';
	}
?>

<?php
	f_show_footer();
?>
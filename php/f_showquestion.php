<?php
		
		function f_showquestion($id,$s){
		
		@ $db = mysqli_connect('localhost' , 'root' , '1q2w3e' , 'testpic');
		
		$query = "select * from questions where id <=".$id." order by id desc";
		
		$result = mysqli_query($db,$query);
		
		echo '<ul>';
		
		$i = 0;
		$x = 0;
		while($row = mysqli_fetch_assoc($result)){
			if( $x >5 ) break;
			
			if($i == 2){
				$i=0;
				echo '<hr />';
			}
			
			if($i == 0) $cls='left';
			else $cls='';
			
			if( $s == 0 ){
				$query = "select * from users where userid = ".$row['userid'];
				$tmp_result = mysqli_query($db,$query);
				$tmp_row = mysqli_fetch_assoc($tmp_result);
				
				// $row[points] = 积分；$row['description'] = 描述;			
				echo "<li><a href='./answer_question.php?q_url=".$row["position"]."'><img class='$cls' width='350' height='100' src='".$row['position']."' alt='pic'/></a>
				<p>描述：".$row['description']." 积分：".$row['points']." 用户：".$tmp_row['username']."</p></li>";
				$i+=1;
				$x+=1;
			}
			else{
				if( $s == $row['subject'] ){
					$query = "select * from users where userid = ".$row['userid'];
					$tmp_result = mysqli_query($db,$query);
					$tmp_row = mysqli_fetch_assoc($tmp_result);
				
					// $row[points] = 积分；$row['description'] = 描述;			
					echo "<li><a href='./answer_question.php?q_url=".$row["position"]."'><img class='$cls' width='350' height='100' src='".$row['position']."' alt='pic'/></a><p>描述：".$row['description']." 积分：".$row['points']." 用户：".$tmp_row['username']."</p></li>";
					$i+=1;
					$x+=1;
				}
			}
		}
		echo '</ul>';
		
		//获取数据库图片里的最大id；
		$query = "select id from questions order by id desc limit 1";
		$result = $db->query($query);
		$row = mysqli_fetch_assoc($result);
		$maxid = $row['id'];
		$db->close();
		
		$url = $_SERVER['REQUEST_URI'];
		
		if( preg_match('/s=/' , $url) ){
			if( preg_match('/s=1/' , $url) ) $s = 1;
			else if( preg_match('/s=2/' , $url) ) $s = 2;
			else if( preg_match('/s=3/' , $url) ) $s = 3;
			else $s = 0;
			$add = '&s='.$s;
		}
		else $add = '';
		
		$temp = $id+6;
		echo "<a class='change_page' id='prev_page' href='./?id=$temp".$add."'>上一页</a>";
		$temp-=12;
		echo "<a class='change_page' id='next_page' href='./?id=$temp".$add."'>下一页</a>";
		
		if( ( $maxid - $id ) < 6 ){
			echo "<script>
				var prev_page = document.getElementById('prev_page');
				prev_page.style.color = '#B8B8B8';
				$('#prev_page').removeAttr('href');
			</script>";
		}
		
		if( $id < 7 ){
			echo "<script>
				var next_page = document.getElementById('next_page');
				next_page.style.color = '#B8B8B8';
				$('#next_page').removeAttr('href');
			</script>";
		}
}
?>	
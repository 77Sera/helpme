<?php
	include('./php/f_showquestion.php');
	include('./php/f_show_header.php');
	include('./php/f_show_footer.php');
	include('./php/f_show_hotquestion.php');
	
	f_show_header('Upload question');
?>

<br />
<hr />

<div id='upload_question'>
	<form action="./php/process_upload.php" method="POST" enctype="multipart/form-data">
		<ul>
			预览：
			<li><div id="img_div"><img id='img_img' src='./images/logo/upload_logo.png' alt=''/></div></li>
			<li><input type="file" name="file" id='file' onchange="PreviewImage(this,'img_img','img_div');" size="20"  /></li>
			<li>请选择科目：
			<label><input name="subject" type="radio" value="1" checked="true"/>线代</label>
			<label><input name="subject" type="radio" value="2" />高数</label>
			<label><input name="subject" type="radio" value="3" />其它</label>
			</li>
			<li>请选择积分：
			<label><input name="points" type="radio" value="1" checked="true" />1分</label>
			<label><input name="points" type="radio" value="2" />2分</label>
			<label><input name="points" type="radio" value="5" />5分</label>
			<label><input name="points" type="radio" value="10" />10分</label>
			</li>
			<li><textarea id="upload_contents" name="upload_contents">描述一下你的问题呗。</textarea><li>
			<li><input id='submit_button2' type="submit" value="提交问题" /></li>
		</ul>
	</form>
</div>

<?php
	if( !isset($_SESSION['user']) ){
		$_SESSION['user'] = 'off';
	}
	
	if( $_SESSION['user'] == 'off' ){
		echo '<script>
		var btn = document.getElementById("submit_button2");
		$(document).ready(function(){
			btn.onclick = function(){
				alert("提问前请先登录!");
				return false;
			}
		}) 
		</script>';
	}
	else{
		$points = $_SESSION['points'];
		echo '<script>
		var btn = document.getElementById("submit_button2");
		$(document).ready(function(){
			btn.onclick = function(){
				var points = document.getElementsByName("points");
				for( var i = 0; i < points.length; i++ ){
					if( points[i].checked ){
						if( points[i].value > '.$points.' ){
							alert("积分不足!");
							return false;
						}
						break;
					}
				}
				
				var file = document.getElementById("file");
				
				if( file.value == "" ){
					alert("传个图呗~");
					return false;
				}
			}
		})
		</script>';
	}
?>

<?php
	f_show_footer();
?>
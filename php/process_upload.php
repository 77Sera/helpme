<?php
//1.限制文件的类型，防止注入
//2.限制文件的大小
//3.防止文件名重复
// 方法一:修改文件名  时间戳+随机数+用户名 //我先不这样改
// 方法二:建文件夹
    
//4.保存文件

//判断上传的文件是否出错,是的话，返回错误
session_start();

if($_FILES["file"]["error"])
{
    echo $_FILES["file"]["error"];    
}
else
{
    //没有出错
    //加限制条件
    //判断上传文件类型为png或jpg且大小不超过1024000B
    if(($_FILES["file"]["type"]=="image/png"||$_FILES["file"]["type"]=="image/jpeg")&&$_FILES["file"]["size"]<1024000)
    {
			@ $db = mysqli_connect('localhost','root','1q2w3e','testpic');
			
			// 获取问题表里的最大id，然后赋给$id 以便保存。
			$query = "select id from questions order by id desc limit 1";
			$result = mysqli_query($db,$query);
			$row = mysqli_fetch_assoc($result);
			$id = $row['id']+1;
			
            //防止文件名重复
            $filename ="./../images/questionpics/".'xd_q_'.$id.'.png';
             //检查文件或目录是否存在
            if(file_exists($filename))
            {
                echo "该文件已存在";
            }
            else
            {  
                //保存文件,   move_uploaded_file 将上传的文件移动到新位置  
                move_uploaded_file($_FILES["file"]["tmp_name"],$filename);
				
				//获取问题的描述文本和花费积分
				$description = $_POST['upload_contents'];
				$points = $_POST['points'];
				$subject = $_POST['subject'];
				
				// 通过SESSION传过来的username来获取$userid; 
				$query = "select userid from users where username='".$_SESSION['username']."'";
				$result = mysqli_query($db,$query);
				$row = mysqli_fetch_assoc($result);
				$userid = $row['userid'];
				
				//扣除问题所花费的积分;
				$query = "update users set points = points-".$points." where userid = ".$userid;
				mysqli_query($db,$query);
				
				$query = "select * from users where userid = ".$userid;
				$result = mysqli_query($db,$query);
				$row = mysqli_fetch_assoc($result);
				$_SESSION['points'] = $row['points'];
				
				
				// 赋图片名称；
				$filename = './images/questionpics/xd_q_'.$id.'.png';
				
				// 将问题路径，描述，积分，提问者id插入questions表；
				$query = "insert into questions(position,description,points,userid,subject) values('".$filename."','".$description."',".$points.",".$userid.",".$subject.")";
				
				$db->query($query);
			
			} 			
			$db->close();
    }
    else
    {
        echo"文件类型不对";
    }
}
?>

<script>
alert('提问成功!等待别人回答吧~');
window.location.href="./../index.php";
</script>
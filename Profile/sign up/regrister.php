<?php
    //��������
	    include '../init.php';

    $username = isset($_POST['username'])?$_POST['username']:"";
    $password = isset($_POST['password'])?$_POST['password']:"";
    $re_password = isset($_POST['re_password'])?$_POST['re_password']:"";
    $first = isset($_POST['first'])?$_POST['first']:"";
    $last = isset($_POST['last'])?$_POST['last']:"";
    $email = isset($_POST['email'])?$_POST['email']:"";
    $phone = isset($_POST['phone'])?$_POST['phone']:"";
    $nick = isset($_POST['nick'])?$_POST['nick']:"";
 if($password == $re_password) {
        //��������
        //׼��SQL���,��ѯ�û���
        $sql_select="SELECT UserName FROM user WHERE UserName = '$username'";
        //ִ��SQL���
        $ret = mysqli_query($link,$sql_select);
        $row = mysqli_fetch_array($ret);
        //�ж��û����Ƿ��Ѵ���
        if($username == $row['UserName']) {
            //�û����Ѵ��ڣ���ʾ��ʾ��Ϣ
            header("Location:sign up.php?err=1");
        } else {

            //�û��������ڣ���������
            //׼��SQL���
            $insert = "INSERT INTO user(UserFirst,UserLast,Email,Nickname,Phone,PassWord,UserName) VALUES('$first','$last','$email','$nick','$phone','$password','$username')";            //ִ��SQL���
            mysqli_query($link,$insert);
			$sql = "SELECT UserID FROM user where UserName= '$username' ";
			$result = $link->query($sql);
		while($row = mysqli_fetch_assoc($result))
		
		{
    
            $insertid = "INSERT INTO shipping(UserID) VALUES(" . $row['UserID'] . ")";           
            mysqli_query($link,$insertid);
            header("Location:profile.php?err=3");
			}
        }

        //�ر����ݿ�
        mysqli_close($link);
    } else {
        header("Location:sign up.php?err=2");
    }


?>
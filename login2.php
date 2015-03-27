<html>
	<head>
		<title>ようこそ!</title>
	</head>

	<body>


		<?php
		
		session_start();
		if(isset($_GET['username']) && isset($_GET['pass'])){
			$username = $_GET['username'];
			$pass = $_GET['pass'];
			if($username != $username || $pass != $pass){
				print('ログインエラー');
				print('<a href="../login1.html">戻る</a>');
				exit;
			}
			else {				
				$_SESSION['username'] = $username;
			}
		}
		
		$dbcon=mysqli_connect('localhost','root','','presentation');
		if(!$dbcon){
			print('DB接続失敗');
			exit;
		}

		mysqli_set_charset($dbcon,'utfs8');

		$sql = "SELECT";
		$sql .= " *";
		$sql .= " FROM";
		$sql .= " id_pass";
		$sql .= " ,";
		$sql .= " user";
		$sql .= " WHERE";
		$sql .= " user.u_name";
		$sql .= " =";
		$sql .= " id_pass.u_name";
		$sql .= " AND";
		$sql .= " id_pass.u_name";
		$sql .= " =";
		$sql .= ' "';
		$sql .= "$username";
		$sql .= '"';
		$sql .= " AND";
		$sql .= " id_pass.u_pass";
		$sql .= " =";
		$sql .= ' "';
		$sql .= "$pass";
		$sql .= '"';
		$sql .= ";";


		$insert=mysqli_query($dbcon,$sql);

		$count = 0;

		 while($row=mysqli_fetch_assoc($insert)){
		 	foreach($row as $key => $val){
		 		print(" ");
		 	}
		 $count = $count+1;

		 }

		if($count < 1){
			print("ユーザーIDあるいはパスワードが存在しません");
			print("<br/>");
			print('<a href="../login1.html">戻る</a>');
		 	exit;
		 }
		 mysqli_free_result($insert);
		 mysqli_close($dbcon);




		?>
		


	</body>
</html>
<?php
	session_start();

	include 'conn.inc.php';

	if($_SESSION['esiste']==0){
		
		$_SESSION['esiste']=0;
		echo "<html>
				<body>
					<form method='post'>
						Username: <input type='text' name='username' value=''></br>
						Password: <input type='password'name='password' value=''></br>
						<input type='submit' name='login' value='Login'>
					</form>
				</body>
			</html>";	
		if(isset($_POST['password'])){
			$dbh = new PDO('mysql:host='.$host.';dbname='.$db,$Username,$Password);
			$stm = $dbh->prepare('SELECT * FROM quintab_utenti.datiutenti d WHERE d.Password=":password" and d.Username=":username"');
			$stm->bindValue(':username',$_POST['username']);
			$stm->bindValue(':password',$_POST['password']);
			if($stm->execute() == true){
				$_SESSION['esiste']=1;
				header("location: sito.php");
		}
		else{
			echo 'Username o password non valido.';
		}
	}
	}
	else{
		echo 'Sei già loggato.';
	}
?>
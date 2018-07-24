<?php
	function remember_me($remember_me, $email,$pwd){
		if(isset($remember_me)){
			setcookie("email", $email, time() + (10 * 365 * 24 * 60 * 60));

			setcookie("pwd", $pwd, time() + (10 * 365 * 24 * 60 * 60));
		}
		else{
			if(isset($_COOKIE['email'])){
				setcookie("email", "");
			}
			if(isset($_COOKIE['pwd'])){
				setcookie("pwd", "");
			}
		}
	}
?>

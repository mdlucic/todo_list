<?php

//if user clicked on the link change his status and log him in
echo "im here";
if(isset($_GET['code']))
{
	echo "not here";
	require_once("../classes/User_Auth.php");
	$user = new UserAuth;
	$user->setVerificationCode($_GET['code']);

	if($user->isValidEmailToken())
	{
		$user->setStatus('Enabled');
		if($user->enableAccount())
		{
			header("Location: ../../public/view/login.php?action=verified");
			exit();
		}
		else
		{
			echo "Error, account not enabled";
		}
	}
	else 
	{
		echo "Error, token is invalid";
	}

}


?>

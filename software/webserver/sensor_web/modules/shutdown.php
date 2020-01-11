<?php
	switch ($_GET['action']) {
		case '0':
				restart();
			break;

		case '1':
				shutdown();
			break;

		default:
			header('Location: ../index.php');
			break;
	}

	function restart(){

			?>
				<!DOCTYPE html>
				<html>
					<head>
						<meta charset="utf-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta http-equiv="refresh" content="50; URL=../index.php">
						<title>Raspberry Pi Control Panel</title>
						<link rel="stylesheet" href="../stylesheets/main.css">
					</head>

					<body>
						<div id="container">
							<img id="logo" src="../images/raspberry.png">
							<div id="title">Raspberry Pi Control Panel</div>
							<p class="action">Raspberry Pi is now rebooting...</p>
							<img id="loader" src="../images/reboot.gif">
						</div>
					</body>
				</html>
			<?php

			system('sudo /sbin/shutdown -r now');

	}

	function shutdown(){
			?>
				<!DOCTYPE html>
				<html>
					<head>
						<meta charset="utf-8">
						<meta http-equiv="X-UA-Compatible" content="IE=edge">
						<meta http-equiv="refresh" content="20; URL=../index.php">
						<title>Raspberry Pi Control Panel</title>
						<link rel="stylesheet" href="../stylesheets/main.css">
					</head>

					<body>
						<div id="container">
							<img id="logo" src="../images/raspberry.png">
							<div id="title">Raspberry Pi Control Panel</div>
							<p class="action" STYLE="color: #FF0000;">Raspberry Pi is now shutting down...</p>
							<img id="loader" src="../images/shutdown.gif">
						</div>
					</body>
				</html>
			<?php

			system('sudo /sbin/shutdown -h now');
	}
?>
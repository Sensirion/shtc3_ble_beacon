<?php
	ob_start();
?>

<!doctype html>
<html>

<head>
	<meta http-equiv="X-UA-Compatible">
	<link rel="stylesheet" href="stylesheets/main.css">
	<link rel="stylesheet" href="stylesheets/button.css">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8">
    <style>
		body {
			text-align: center;
		}

		#g1, #g2 {
			width: 200px;
			height: 300px;
			display: inline-block;
			margin: 1em;
		}
		#g3, #g4 {
		  width:120px; height:250px;
		  display: inline-block;
		  margin: 1em;
		}

		p {
			display: block;
			width: 250px;
			margin: 2em auto;
			text-align: left;
		}
    </style>
	<script>
		function checkAction(action){
			if (confirm('RasPi is going to ' + action))
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	</script>    
</head>

<body>
	<div id="container">
		<img id="logo" src="images/raspberry.png">
		<div id="title">Raspberry Pi Sensor Panel</div>

		<div id="g1"></div>
		<div id="g2"></div>
		<div id="g3"></div>
		<div id="g4"></div>

		<script src="javascript/raphael-2.1.4.min.js"></script>
		<script src="javascript/justgage.1.2.2.min.js"></script>
		<script src="javascript/jquery-1.9.1.min.js"></script>

		<script>
			var g1, g2, g3, g4;
			document.addEventListener("DOMContentLoaded", function(event) {
				g1 = new JustGage({
					id: "g1",
					value: -40,
					min: -40,
					max: 125,
					gaugeWidthScale: 0.7,
					decimals: 2,
					title: "Temperature",
					label: "°C"
				});

				g2 = new JustGage({
					id: "g2",
					value: 0,
					min: 0,
					max: 100,
					gaugeWidthScale: 0.7,
					decimals: 2,
					title: "Relative Humidity",
					label: "%"
				});

				g3 = new JustGage({
					id: "g3",
					value: 0,
					min: 0,
					max: 40,
					gaugeWidthScale: 0.7,
					decimals: 2,
					title: "Absolute Humidity",
					label: "g/m³"
				});

				g4 = new JustGage({
					id: "g4",
					value: -20,
					min: -20,
					max: 50,
					gaugeWidthScale: 0.7,
					decimals: 2,
					title: "Dew Point",
					label: "°C"
				});        

				var myvar='';
				$.ajax({
					type:'post',
					url: 'api.php',
					dataType:'text',
					success: function(data) {
						useReturnData(data);
					}
				});

				setInterval(function() {
					$.get("api.php", 'source=t', function(data) {  g1.refresh(data)});
					$.get("api.php", 'source=rh', function(data) {  g2.refresh(data)});
					$.get("api.php", 'source=ah', function(data) {  g3.refresh(data)});
					$.get("api.php", 'source=dp', function(data) {  g4.refresh(data)});
				}, 2500);
			});
		</script>
		<div id="controls">
			<a class="button_orange" href="modules/shutdown.php?action=0" onclick="return checkAction('<?php echo 'reboot'; ?>');"><?php echo 'Reboot'; ?></a><br/>
			<a class="button_red" href="modules/shutdown.php?action=1" onclick="return checkAction('<?php echo 'shutdown'; ?>');"><?php echo 'Shutdown'; ?></a>
		</div>
	</div>
</body>

</html>

<?php 
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Wahtasapp</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.1/css/bootstrap.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
	<div class="container p-4">
		<div class="row">
			<div class="col">
				<div class="card">
					<div class="card-header">Scan QR</div>
					<div class="qrcode"></div>
					<div class="card-body">
						<div id="qrcode">
							<div class="d-flex justify-content-center">
								<div class="spinner-grow text-primary" role="status">
									<span class="sr-only">Loading...</span>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="card">
					<div class="card-header">Kirim Pesan</div>
					<div class="card-body">
						<form  method="GET">
							<table class="table table-bordered">
								<tr>
									<th>#</th>
									<th>Nama</th>
									<th>Nomor</th>
								</tr>
								<?php 
								$no = [
									'andrian'	=> '6287717246586', 
									'Dito' 		=> '6282137425024', 
									'Dany' 		=> '6285872764417',
								];
								foreach ($no as $nama => $num) :
								?>
								<tr>
									<td><input type="checkbox" name="no[]" value="<?=$num?>"></td>
									<td><?=$nama?></td>
									<td><?=$num?></td>
								</tr>
								<?php endforeach?>
							</table>
							<div class="form-group">
								<label>Pesan</label>
								<textarea class="form-control" name="pesan"></textarea>	
							</div>
							<button type="submit" class="btn btn-primary"> Kirim</button>
						</form>
						<?php
						if (isset($_GET['no'])){
							$nomor = $_GET['no'];
							$pesan = $_GET['pesan'];
							for($i=0; $i<count($nomor);$i++){
								$data = [
								    'phone' => $nomor[$i], // Receivers phone
								    'body' 	=> $pesan, // Message
								];
								$json = json_encode($data); // Encode data to JSON
								// URL for request POST /message
								$token = 'c53xoj5mpif55frh';
								$instanceId = '380281';
								$url = 'https://api.chat-api.com/instance'.$instanceId.'/message?token='.$token;
								// Make a POST request
								$options = stream_context_create(['http' => [
									'method'  => 'POST',
									'header'  => 'Content-type: application/json',
									'content' => $json
								]
							]);
								// Send a request
								$result = file_get_contents($url, false, $options);
							}
						}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
			setInterval(function(){
				$("#qrcode").load('qrcode.php')
			}, 2000);
		});
	</script>

</body>
</html>
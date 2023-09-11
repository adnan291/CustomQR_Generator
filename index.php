<!DOCTYPE html>
<html lang="en">

<head>
	<title>QR Code Generator</title>
	<link rel='stylesheet'
		href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css'>
	<link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css'>
	<style>
		body {
			margin: 0;
			background-color: lightpink;
		}

		.container {
			margin-top: 2rem;
			padding: 2rem;
			border-radius: 1rem;
			background-color: white;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
		}

		.card {
			border: none;
			box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.25);
		}

		.card-header {
			background-color: #f5f5f5;
			border-bottom: none;
		}

		label {
			font-weight: bold;
		}

		.btn-primary {
			background-color: #007bff;
			border-color: #007bff;
			border-radius: 2rem;
			font-size: 1.2rem;
		}

		.btn-primary:hover {
			background-color: #0069d9;
			border-color: #0062cc;
		}

		.btn-secondary {
			background-color: lightblue;
			border-color: #f5f5f5;
			border-radius: 2rem;
			font-size: 1.2rem;
		}

		.btn-secondary:hover {
			background-color: #e5e5e5;
			border-color: #ddd;
		}

		.btn-download {
			background-color: darkcyan;
			border-color: #f5f5f5;
			border-radius: 2rem;
			font-size: 1.2rem;
		}

		.btn-download:hover {
			background-color: #e5e5e5;
			border-color: #ddd;
		}


		.btn {
			margin-right: 5px;

		}
	</style>
</head>

<body>
	<div class="container py-3">

		<div class="row">
			<div class="col-md-12">

				<div class="row justify-content-center">
					<div class="col-md-6">
						<!-- form user info -->
						<div class="card card-outline-secondary">
							<div class="card-header">
								<h3 class="mb-0">Custom QR Code Generator</h3>
							</div>
							<?php
							$name = "";
							$email = "";
							$company = "";
							$website = "";

							if (isset($_POST["btnsubmit"])) {
								$name = $_POST["name"];
								$email = $_POST["email"];
								$company = $_POST["company"];
								$website = $_POST["website"];

								/*echo "<pre>";
								var_dump($_POST);
								echo "</pre>";*/
							}
							?>
							<div class="card-body">
								<p>Please fill out all required fields (*) in the form below:</p>
								<form autocomplete="off" class="form" role="form" action="index.php" method="post">
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label" for="name">Full
											name*</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" value="<?php echo $name; ?>"
												name="name" id="name" placeholder="Enter your full name" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"
											for="email">Email*</label>
										<div class="col-lg-9">
											<input class="form-control" type="email" value="<?php echo $email; ?>"
												name="email" id="email" placeholder="Enter your email address" required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"
											for="company">Company*</label>
										<div class="col-lg-9">
											<input class="form-control" type="text" value="<?php echo $company; ?>"
												name="company" id="company" placeholder="Enter your company name"
												required>
										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"
											for="website">Website*</label>
										<div class="col-lg-9">
											<input class="form-control" type="url" value="<?php echo $website; ?>"
												name="website" id="website" placeholder="Paste your website URL"
												required pattern="https?://.+">

										</div>
									</div>
									<div class="form-group row">
										<label class="col-lg-3 col-form-label form-control-label"></label>
										<div class="col-lg-9">

											<input class="btn btn-primary" type="submit" name="btnsubmit"
												value="Generate QR Code">
											<input type="reset" class="btn btn-secondary" value="Reset">
										</div>
									</div>
								</form>
								<?php
								include "phpqrcode/qrlib.php";
								$PNG_TEMP_DIR = 'temp/';
								if (!file_exists($PNG_TEMP_DIR))
									mkdir($PNG_TEMP_DIR);

								$filename = $PNG_TEMP_DIR . 'test.png';

								if (isset($_POST["btnsubmit"])) {
									$codeString = $_POST["name"] . "\n";
									$codeString .= $_POST["email"] . "\n";
									$codeString .= $_POST["company"] . "\n";
									$website = $_POST["website"];

									$codeString = $website;

									$filename = $PNG_TEMP_DIR . 'test' . md5($codeString) . '.png';

									QRcode::png($codeString, $filename, 'H', 10, 2);


									echo '<img src="' . $PNG_TEMP_DIR . basename($filename) . '" /><hr/>';

									if (file_exists($filename)) {
										echo '<a href="' . $PNG_TEMP_DIR . basename($filename) . '" download><button class="btn btn-download">Download QR</button></a>';
									}
								}
								?>




							</div>
						</div><!-- /form user info -->
					</div>
				</div>

			</div><!--/col-->
		</div><!--/row-->

	</div><!--/container-->

</body>

</html>
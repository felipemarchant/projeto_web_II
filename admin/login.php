<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Entrar</title>
	<link rel="stylesheet" href="../lib/skin/css/bootstrap.min.css">
	<link rel="stylesheet" href="skin/css/login.css">
</head>
<body class="admin_login">
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<a href="../index.php" title="UNG">
							<img src="skin/images/logo.jpg">
						</a>
					</div>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Entrar</h4>
							<form method="POST" action="index.php">
							 
								<div class="form-group">
									<label for="email">E-Mail</label>

									<input id="email" type="email" class="form-control" name="email" value="" required autofocus placeholder="E-Mail">
								</div>

								<div class="form-group">
									<label for="password">Senha
									</label>
									<input id="password" type="password" class="form-control" name="password" placeholder="Senha" required data-eye>
								</div>
								<div class="form-group no-margin">
									<button type="submit" class="btn btn-primary btn-color btn-block">
										Entrar
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; Projeto Web <?php echo date('Y'); ?>
					</div>
				</div>
			</div>
		</div>
	</section>
</body>
</html>
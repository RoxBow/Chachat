<main class="wrapper-page-login">
<section class="section-choix-login">
	<div class="container">
		<div class="logo">
			<i class="fa fa-picture-o fa-5x" aria-hidden="true"></i>
		</div>
		<div class="wrapper-btn-login">
			<div class="wrapper-login">
				<a href="#" class="selected">
					<i class="fa fa-user fa-3x" aria-hidden="true"></i> Login
				</a>
			</div>
			<div class="wrapper-sign-in">
				<a href="#">
					<i class="fa fa-user fa-3x" aria-hidden="true"></i> S'enregistrer
				</a>
			</div>
			<div class="wrapper-sign-guest">
				<a href="#">
					<i class="fa fa-user fa-3x" aria-hidden="true"></i> Invité
				</a>
			</div>
		</div>
	</div>
</section>
<section class="section-champs-login">
	<div class="container">
		<h2>ChaChat</h2>

		<div class="wrapper-form wrapper-form-login">
			<form method="post" action="traitement.php">
				<p>
					<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"/>
					<br/>
					<input type="password" name="password" id="password" placeholder="Mot de passe"/>
					<br/>
					<input type="submit" value="Valider" />
				</p>
			</form>
		</div>
		<div class="wrapper-form wrapper-form-register">
			<form method="post" action="traitement.php">
				<p>
					<input type="email" name="email" id="email" placeholder="Email"/>
					<br/>
					<input type="text" name="pseudo" id="pseudo" placeholder="Pseudo"/>
					<br/>
					<input type="password" name="password" id="password" placeholder="Mot de passe"/>
					<br/>
					<input type="submit" value="Valider" />
				</p>
			</form>
		</div>
	</div>
</section>
</main>    
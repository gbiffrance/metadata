<div id=body >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
		// S'il y a un message d'erreur
		if (isset($error))
		{
			echo "<p class='error'>".$error."</p>";
		}
		// S'il y a un message de validation
		if (isset($valide))
		{
			echo $valide;
		}
		// Sinon on affiche le formulaire
		else
		{
			?>
				<form method="post" action="<?php echo site_url('connexion'); ?>">
					<table>
						<tr><td>Email</td><td><input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>" /></td></tr>
						<tr><td>Mot de passe </td><td><input type="password" name="password" /></td></tr>
						<tr><td></td><td><input type="submit" value="Valider"/></td></tr>
					</table>
				</form>
				<br /><br />
				<span class="tips">Si vous n'avez pas de compte GBIF France, vous pouvez en cr&eacute;er un en cliquant &nbsp;
				<a href="<?php echo site_url('enregistrement'); ?>">ICI</a>.</span>
			<?php
		}
	?>
</div>

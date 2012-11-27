<div id=body >
	<?php
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
				<form method="post" action="enregistrement">
					<table>
						<tr><td>Email (login)</td><td><input type="text" name="email" value="<?php if(isset($email)){echo $email;} ?>" /></td></tr>
						<tr><td>Nom </td><td><input type="text" name="nom" value="<?php if(isset($nom)){echo $nom;} ?>" /></td></tr>
						<tr><td>Institution </td><td><input type="text" name="inst" value="<?php if(isset($inst)){echo $inst;} ?>" title="nom de l'institution &agrave; laquelle vous appartenez" /></td></tr>
						<tr><td>Mot de passe </td><td><input type="password" name="password" /></td></tr>
						<tr><td>Retapez votre mot de passe </td><td><input type="password" name="password2" /></td></tr>
						<tr><td></td><td><input type="submit" value="Valider"/></td></tr>
					</table>
				</form>
			<?php
		}
	?>
</div>

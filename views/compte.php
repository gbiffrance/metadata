<div id=body >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
		echo validation_errors();
	?>
	<table>
		<form method="post" action="<?php echo site_url('compte/modif'); ?>">
		<tr><td>Nom</td><td><input type="text" name="nomAgent" value="<?php echo set_value('nomAgent', $agent->NameAgent); ?>" /></td></tr>
		<tr><td>Email</td><td><input type="text" name="emailAgent" value="<?php echo set_value('emailAgent', $agent->EmailAgent); ?>" /></td></tr>
		<tr><td>Nouveau mot de passe</td><td><input type="password" name="passAgent" /></td></tr>
		<tr><td>Retapez votre nouveau mot de passe </td><td><input type="password" name="passAgent2" /></td></tr>
		<tr><td>Institution</td><td><input type="text" name="nameOrga" value="<?php echo set_value('nameOrga', $agent->NameOrga); ?>" /></td></tr>
		<tr><td><input type="hidden" name="IdAgent" value="<?php echo $agent->IdAgent; ?>"/></td></tr>
		<tr><td><input type="submit" value="Valider les modifications"/></td></tr>
	</form>
</table>

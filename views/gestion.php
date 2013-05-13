<div id=body >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
		
		// On liste les agents
		if(isset($agents))
		{
			echo "<br />\n";
			echo "<table>";
			echo "<tr><td></td><td>Nom de l'agent</td><td>Email</td><td>Nom de l'organisation</td><td>Droits</td></tr>";
			foreach($agents as $item)
			{
				echo "<tr>";
				$url = "gestion/agent/".$item['IdAgent'];
				echo "<td><a href='".site_url($url)."'>Modifier l'agent</a></td>";
				echo "<td>".$item['NameAgent']."</td><td>".$item['EmailAgent']."</td><td>".$item['NameOrga']."</td><td>".$item['NomDroit']."</td>";
				echo "</tr>";
			}
			echo "</table>";
		}
		// On modifie l'agent
		elseif(isset($agent))
		{
			echo validation_errors();
			echo "
			<p>\n
				<a href='".site_url()."/gestion'>Retour</a>\n
			</p>\n";
			?>
			<table>
				<form method="post" action="<?php echo site_url('modifagent'); ?>">
				<tr><td>Nom *</td><td><input type="text" name="nomAgent" value="<?php echo set_value('nomAgent', $agent->NameAgent); ?>" /></td></tr>
				<tr><td>Email *</td><td><input type="text" name="emailAgent" value="<?php echo set_value('emailAgent', $agent->EmailAgent); ?>" /></td></tr>
				<tr><td>Nom de l'organisation *</td><td><input type="text" name="nameOrga" value="<?php echo set_value('nameOrga', $agent->NameOrga); ?>" /></td></tr>
				<tr>
					<td>Droits *</td>
					<td>
						<select name="IdDroit">
						<?php
							// On parcourt la liste des droits
							foreach ($droits as $item)
							{
								echo "<option value='".$item['IdDroit']."'";
								if ($agent->IdDroit == $item['IdDroit'])
								{
									echo " ".set_select('IdDroit', $item['IdDroit'], TRUE);
								}
								else
								{
									echo " ".set_select('IdDroit', $item['IdDroit']);
								}
								echo ">".$item['NomDroit']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Institutions associ&eacute;es *<br/>(s&eacute;lectionnez pour d&eacute;sassocier)</td>
					<td>
						<select name="IdInstlie[]" multiple="multiple">
						<?php
							// On parcourt la liste des institutions liées
							foreach ($instlie as $item)
							{
								echo "<option value='".$item['IdInst']."' ".set_select('IdInstlie[]', $item['IdInst'])." >".$item['NameInst']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Institutions non associ&eacute;es *<br/>(s&eacute;lectionnez pour associer)</td>
					<td>
						<select name="IdInstnonlie[]" multiple="multiple">
						<?php
							// On parcourt la liste des institutions liées
							foreach ($instnonlie as $item)
							{
								echo "<option value='".$item['IdInst']."' ".set_select('IdInstnonlie[]', $item['IdInst'])." >".$item['NameInst']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jeux de donn&eacute;es associ&eacute;s *<br/>(s&eacute;lectionnez pour d&eacute;sassocier)</td>
					<td>
						<select name="IdDatalie[]" multiple="multiple">
						<?php
							// On parcourt la liste des dataset liées
							foreach ($datalie as $item)
							{
								echo "<option value='".$item['IdData']."' ".set_select('IdDatalie[]', $item['IdData'])." >".$item['NameData']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jeux de donn&eacute;es non associ&eacute;s *<br/>(s&eacute;lectionnez pour associer)</td>
					<td>
						<select name="IdDatanonlie[]" multiple="multiple">
						<?php
							// On parcourt la liste des dataset liées
							foreach ($datanonlie as $item)
							{
								echo "<option value='".$item['IdData']."' ".set_select('IdDatanonlie[]', $item['IdData'])." >".$item['NameData']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td><input type="hidden" name="IdAgent" value="<?php echo $agent->IdAgent; ?>"/></td></tr>
				<tr><td><input type="submit" value="Valider"/></td></tr>
			</form>
		</table>
		<?php
		}
	?>
</div>

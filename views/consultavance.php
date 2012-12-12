<div id=body >
	<p>Vous pouvez effectuer une recherche multiple sur diff&eacute;rents crit&egrave;res. Celle-ci s'effectuera sur tous les champs que vous aurez remplis.<br/>
	Pour faire une selection multiple, appuyez sur la touche ctrl tout en cliquant sur vos diff&eacute;rents choix.<br/>
	Pour d&eacute;selectionner un champ, appuyez sur la touche ctrl tout en cliquant dessus.</p>
	<table>
		<form method="post" action="resultat">
			<tr>
				<th colspan=2>Informations concernant l'institution</th>
			</tr>
			<tr>
				<td>Nom </td>
				<td><input type="text" name="nomInst" /></td>
			</tr>
			<tr>
				<td>Type </td>
				<td>
					<select name=IdTypeInst[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des typeinst
						foreach ($typeinst as $item)
						{
							echo "<option value='".$item['IdTypeInst']."'>".trim($item['NameTypeInst'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>R&eacute;gion </td>
				<td>
					<select name=IdRegion[] multiple="multiple" size=10>
					<?php
						// On parcourt la liste des régions
						foreach ($region as $item)
						{
							echo "<option value='".$item['IdRegion']."'>".trim($item['NameRegion'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Ville </td>
				<td>
					<select name=IdTown[] multiple="multiple" size=10>
					<?php
						// On parcourt la liste des villes
						foreach ($ville as $item)
						{
							echo "<option value='".$item['IdTown']."'>".trim($item['NameTown'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr><th colspan=2>Informations concernant le jeu de donn&eacute;es</th></tr>
			<tr><td>Nom </td><td><input type="text" name="nomData" /></td></td></tr>
			<tr>
				<td>Type </td>
				<td>
					<select name=IdTypeData[] multiple="multiple" size=2>
					<?php
						// On parcourt la liste des typedata
						foreach ($typedata as $item)
						{
							echo "<option value='".$item['IdTypeData']."'>".trim($item['NameTypeData'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Nature </td>
				<td>
					<select name=IdNature[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des naturedata
						foreach ($naturedata as $item)
						{
							echo "<option value='".$item['IdNature']."'>".trim($item['NameNature'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<!--<tr><td>Date de cr&eacute;ation </td><td></td></tr>
			<tr><td>Date de mise &agrave; jour </td><td></td></tr>-->
			<tr><th colspan=2>G&eacute;ographie</th></tr>
			<tr>
				<td>Continent </td>
				<td>
					<select name=IdContinent[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des contient
						foreach ($contient as $item)
						{
							echo "<option value='".$item['IdContinent']."'>".trim($item['NameContinent'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Pays </td>
				<td>
					<select name=IdCountry[] multiple="multiple" size=10>
					<?php
						// On parcourt la liste des pays
						foreach ($pays as $item)
						{
							echo "<option value='".$item['IdCountry']."'>".trim($item['NameCountry'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr><th colspan=2>Taxonomie</th></tr>
			<tr>
				<td>R&egrave;gne </td>
				<td>
					<select name=IdKingdom[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des kingdom
						foreach ($kingdom as $item)
						{
							echo "<option value='".$item['IdKingdom']."'>".trim($item['KingdomTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Phylum </td>
				<td>
					<select name=IdPhylum[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des phylum
						foreach ($phylum as $item)
						{
							echo "<option value='".$item['IdPhylum']."'>".trim($item['PhylumTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Classe </td>
				<td>
					<select name=IdClass[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des class
						foreach ($class as $item)
						{
							echo "<option value='".$item['IdClass']."'>".trim($item['ClassTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Ordre </td>
				<td>
					<select name=IdOrder[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des ordertaxo
						foreach ($ordertaxo as $item)
						{
							echo "<option value='".$item['IdOrder']."'>".trim($item['OrderTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<!-- Pour le moment, on ne va pas plus précis que l'ordre
			<tr>
				<td>Famille </td>
				<td>
					<select name=IdFamily[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des family
						foreach ($family as $item)
						{
							echo "<option value='".$item['IdFamily']."'>".trim($item['FamilyTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Genre </td>
				<td>
					<select name=IdGenus[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des genus
						foreach ($genus as $item)
						{
							echo "<option value='".$item['IdGenus']."'>".trim($item['GenusTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Esp&egrave;ce </td>
				<td>
					<select name=IdSpecie[] multiple="multiple" size=5>
					<?php
						// On parcourt la liste des specie
						foreach ($specie as $item)
						{
							echo "<option value='".$item['IdSpecie']."'>".trim($item['SpecieTaxo'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select>
				</td>
			</tr>
			-->
			<tr><td><input type="hidden" name="choix" value="advance" /></td><td><input type="submit" value="Valider"/></td></tr>
		</form>
	</table>
	<br/>
	<a href="consultation">Recherche simple</a>			
</div>

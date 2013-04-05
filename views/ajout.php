<div id=body >
	<?php
		// On charge le helper d'url
		$this->load->helper('url');
		// Si ajout institution
		if (isset($typeinst))
		{
			echo validation_errors();
		?>
		<table>
			<form method="post" action="<?php echo site_url('ajoutinst'); ?>">
				<tr><th colspan=2>Informations concernant l'institution</th></tr>
				<tr><td>Nom *</td><td><input type="text" name="nomInst" value="<?php echo set_value('nomInst'); ?>"/></td></tr>
				<tr><td>Description *</td><td><textarea name="descInst"><?php echo set_value('descInst'); ?></textarea></td></tr>
				<tr><td>Sigle </td><td><input type="text" name="sigleInst" value="<?php echo set_value('sigleInst'); ?>"/></td></tr>
				<tr><td>Adresse (num&eacute;ro + rue) *</td><td><input type="text" name="adresseInst" value="<?php echo set_value('adresseInst'); ?>"/></td></tr>
				<tr><td>Code postal *</td><td><input type="number" name="codepostalInst" value="<?php echo set_value('codepostalInst'); ?>"/></td></tr>
				<tr>
					<td>Ville *</td>
					<td>
						<select name="IdTown">
							<option value="0">Nouvelle ville</option>
						<?php
							// On parcourt la liste des villes
							foreach ($ville as $item)
							{
								echo "<option value='".$item['IdTown']."' ".set_select('IdTown', $item['IdTown']).">".trim($item['NameTown'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newville" value="<?php echo set_value('newville'); ?>"/>
					</td>
				</tr>
				<tr>
					<td>R&eacute;gion *</td>
					<td>
						<select name=IdRegion>
						<?php
							// On parcourt la liste des régions
							foreach ($region as $item)
							{
								echo "<option value='".$item['IdRegion']."' ".set_select('IdRegion', $item['IdRegion']).">".trim($item['NameRegion'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td>T&eacute;l&eacute;phone </td><td><input type="tel" name="telInst" value="<?php echo set_value('telInst'); ?>"/></td></tr>
				<tr><td>Mail </td><td><input type="email" name="mailInst" value="<?php echo set_value('mailInst'); ?>"/></td></tr>
				<tr><td>Adresse URL du logo de l'institution </td><td><input type="url" name="logoInst" value="<?php echo set_value('logoInst'); ?>"/></td></tr>
				<tr><td>Site web de l'institution </td><td><input type="url" name="urlInst" value="<?php echo set_value('urlInst'); ?>"/></td></tr>
				<tr>
					<td>Institution m&egrave;re </td>
					<td>
						<select name=parentInst>
							<option value='0'>Aucune</option>
						<?php
							// On parcourt la liste des inst
							foreach ($inst as $item)
							{
								echo "<option value='".$item['IdInst']."' ".set_select('parentInst', $item['IdInst']).">".trim($item['NameInst'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Type *</td>
					<td>
						<select name=IdTypeInst[] multiple="multiple" size=5>
						<?php
							// On parcourt la liste des typeinst
							foreach ($typeinst as $item)
							{
								echo "<option value='".$item['IdTypeInst']."' ".set_select('IdTypeInst[]', $item['IdTypeInst']).">".trim($item['NameTypeInst'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td><input type="submit" value="Valider"/></td></tr>
			</form>
		</table>
		<?php
		}
		// Si ajout dataset
		else if (isset($typedata))
		{
			echo validation_errors();
		?>
		<table>
			<form method="post" action="<?php echo site_url('ajoutdata'); ?>">
				<tr><th colspan=2>Informations concernant le jeu de donn&eacute;es</th></tr>
				<tr>
					<td>Institution *</td>
					<td>
						<select name=inst>
						<?php
							// On parcourt la liste des inst
							foreach ($inst as $item)
							{
								echo "<option value='".$item['IdInst']."' ".set_select('inst', $item['IdInst']).">".trim($item['NameInst'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td>Nom *</td><td><input type="text" name="nomData" value="<?php echo set_value('nomData'); ?>" /></td></tr>
				<tr><td>Identifiant GBIF si connect&eacute; </td><td><input type="text" name="idGbif" title="chiffre &agrave; la fin de l'url gbif. Exemple : http://data.gbif.org/datasets/resource/1850/, il faut indiquer 1850" value="<?php echo set_value('idGbif'); ?>" /></td></tr>
				<tr><td>Identifiant GBIF France si connect&eacute; </td><td><input type="text" name="idGbifFrance" title="explication a venir" value="<?php echo set_value('idGbifFrance'); ?>" /></td></tr>
				<tr><td>Description *</td><td><textarea name="descData"><?php echo set_value('descData'); ?></textarea></td></tr>
				<tr><td>Droits </td><td><input type="text" name="rights" title="s'il existe des limites de consultation/utilisation des donn&eacute;es, indiquez les ici" value="<?php echo set_value('rights'); ?>" /></td></tr>
				<tr><td>But </td><td><input type="text" name="purpose" title="dans quel but ces donn&eacute;es ont &eacute;t&eacute; collect&eacute;es (recherche, enseignement, inventaires, etc)" value="<?php echo set_value('purpose'); ?>" /></td></tr>
				<tr>
					<td>Poss&egrave;de des types? </td>
					<td>
						<select name="type">
							<option value="NON" <?php echo set_select('type', 'NON'); ?>>Non</option>
							<option value="OUI" <?php echo set_select('type', 'OUI'); ?>>Oui</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Type de jeu de donn&eacute;es</td>
					<td>
						<select name="IdTypeData">
						<?php
							// On parcourt la liste des typedata
							foreach ($typedata as $item)
							{
								echo "<option value='".$item['IdTypeData']."' ".set_select('IdTypeData', $item['IdTypeData']).">".trim($item['NameTypeData'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Nature *</td>
					<td>
						<select name=IdNature[] multiple="multiple" size=5>
						<?php
							// On parcourt la liste des naturedata
							foreach ($naturedata as $item)
							{
								echo "<option value='".$item['IdNature']."' ".set_select('IdNature[]', $item['IdNature']).">".trim($item['NameNature'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr>
					<td>Jeu de donn&eacute;es p&egrave;re *</td>
					<td>
						<select name=parentData>
						<option value='0'>Aucun</option>
						<?php
							// On parcourt la liste des datasets
							foreach ($dataset as $item)
							{
								echo "<option value='".$item['IdData']."' ".set_select('parentData', $item['IdData']).">".trim($item['NameData'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><th colspan=2>Couverture g&eacute;ographique</th></tr>
				<tr>
					<td>Continent </td>
					<td>
						<select name=IdContinent[] multiple="multiple" size=5>
						<?php
							// On parcourt la liste des contient
							foreach ($contient as $item)
							{
								echo "<option value='".$item['IdContinent']."' ".set_select('IdContinent[]', $item['IdContinent']).">".trim($item['NameContinent'])."</option>";
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
								echo "<option value='".$item['IdCountry']."' ".set_select('IdCountry[]', $item['IdCountry']).">".trim($item['NameCountry'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td>Pr&eacute;cision g&eacute;ographique </td><td><input type="text" name="precisiongeo" title="exemple : autour de la m&eacute;diterran&eacute;e" value="<?php echo set_value('precisiongeo'); ?>"/></td></tr>
				<tr><td>Latitude min </td><td><input type="text" name="latmin" value="<?php echo set_value('latmin'); ?>" /></td></tr>
				<tr><td>Latitude max </td><td><input type="text" name="latmax" value="<?php echo set_value('latmax'); ?>" /></td></tr>
				<tr><td>Longitude min </td><td><input type="text" name="longmin" value="<?php echo set_value('longmin'); ?>" /></td></tr>
				<tr><td>Longitude max </td><td><input type="text" name="longmax" value="<?php echo set_value('longmax'); ?>" /></td></tr>
				<tr><th colspan=2>Taxonomie</th></tr>
				<tr>
					<td>R&egrave;gne </td>
					<td>
						<select name=IdKingdom[] multiple="multiple" size=5>
						<?php
							// On parcourt la liste des kingdom
							foreach ($kingdom as $item)
							{
								echo "<option value='".$item['IdKingdom']."' ".set_select('IdKingdom[]', $item['IdKingdom']).">".trim($item['KingdomTaxo'])."</option>";
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
							<option value='0'>Nouveau phylum</option>
						<?php
							// On parcourt la liste des phylum
							foreach ($phylum as $item)
							{
								echo "<option value='".$item['IdPhylum']."' ".set_select('IdPhylum[]', $item['IdPhylum']).">".trim($item['PhylumTaxo'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newphylum" />
					</td>
				</tr>
				<tr>
					<td>Classe </td>
					<td>
						<select name=IdClass[] multiple="multiple" size=5>
							<option value='0'>Nouvelle classe</option>
						<?php
							// On parcourt la liste des class
							foreach ($class as $item)
							{
								echo "<option value='".$item['IdClass']."' ".set_select('IdClass[]', $item['IdClass']).">".trim($item['ClassTaxo'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newclasse" />
					</td>
				</tr>
				<tr>
					<td>Ordre </td>
					<td>
						<select name=IdOrder[] multiple="multiple" size=5>
							<option value='0'>Nouvel ordre</option>
						<?php
							// On parcourt la liste des ordertaxo
							foreach ($ordertaxo as $item)
							{
								echo "<option value='".$item['IdOrder']."' ".set_select('IdOrder[]', $item['IdOrder']).">".trim($item['OrderTaxo'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newordre" />
					</td>
				</tr>
				<tr><td>Pr&eacute;cision taxonomique </td><td><input type="text" name="precisiontaxo" value="<?php echo set_value('precisiontaxo'); ?>"/></td></tr>
				<tr><td>Noms communs </td><td><input type="text" name="nomcommun" value="<?php echo set_value('nomcommun'); ?>" /></td></tr>
				<tr><th colspan=2>Couverture temporelle</th></tr>
				<tr>
					<td><input type='checkbox' name='temporel[]' value='Fossile' <?php echo set_checkbox('temporel[]', 'Fossile'); ?> >Fossile</td>
					<td><input type="text" name="newfossile" value="<?php echo set_value('newfossile'); ?>"/></td>
				</tr>
				<tr>
					<td><input type='checkbox' name='temporel[]' value='Ancien' <?php echo set_checkbox('temporel[]', 'Ancien'); ?> >Ancien</td>
					<td><select name=IdAncien[] multiple="multiple" size=5>
					<option value='0'>Nouveau si&egrave;cle</option>
					<?php
						// On parcourt la liste des siècles	anciens						
						foreach ($ancient as $item)
							{
								echo "<option value='".$item['IdAncient']."' ".set_select('IdAncien[]', $item['IdAncient']).">".$item['CenturyAncient']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type='text' name='newAncient' placeholder="siècle" value="<?php echo set_value('newAncient'); ?>"/></td></tr>
					<tr>
						<td><input type='checkbox' name='temporel[]' value='Actuel' <?php echo set_checkbox('temporel[]', 'Actuel'); ?> >Actuel</td>
						<td><select name=IdActuel[] multiple="multiple" size=5>
						<option value='0'>Nouvelle ann&eacute;e</option>
						<?php
						// On parcourt la liste des années récentes							
						foreach ($current as $item)
							{
								echo "<option value='".$item['IdCurrent']."' ".set_select('IdActuel[]', $item['IdCurrent']).">".$item['YearCurrent']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
					</select><input type='number' name='newCurrent' placeholder="année" value="<?php echo set_value('newCurrent'); ?>"/></td></tr>
				<tr><th colspan=2>M&eacute;thodes</th></tr>
				<tr><td>M&eacute;thode de collecte </td><td><input type="text" name="collecte" value="<?php echo set_value('collecte'); ?>"/></td></tr>
				<tr><td>M&eacute;thode de pr&eacute;servation </td><td><input type="text" name="preservation" value="<?php echo set_value('preservation'); ?>" /></td></tr>
				<tr><td>Qualit&eacute; </td><td><input type="text" name="qualite" value="<?php echo set_value('qualite'); ?>" /></td></tr>
				<tr><th colspan=2>Projet de recherche</th></tr>
				<tr><td>Titre du projet </td><td><input type="text" name="titreP" value="<?php echo set_value('titreP'); ?>" /></td></tr>
				<tr><td>Domaine du projet </td><td><input type="text" name="domaineP" value="<?php echo set_value('domaineP'); ?>" /></td></tr>
				<tr><td>Description du projet </td><td><textarea name="descP"><?php echo set_value('descP'); ?></textarea></td></tr>
				<tr><td>Fonds du projet </td><td><input type="text" name="fondP" value="<?php echo set_value('fondP'); ?>" /></td></tr>
				<tr><th colspan=2>Bibliographie</th></tr>
				<tr><td>R&eacute;f&eacute;rence </td><td><input type="text" name="refB" title="DOI, identifiant dans la source originale, lien vers un jeu de donn&eacute;es li&eacute;, etc" value="<?php echo set_value('refB'); ?>" /></td></tr>
				<tr><td>Type de ressource </td><td><input type="text" name="typeB" title="publication, source originale, jeux de donn&eacute;es li&eacute;s, ressources li&eacute;es, etc " value="<?php echo set_value('typeB'); ?>" /></td></tr>
				<tr><th colspan=2>Stockage</th></tr>
				<tr><td>Stockage physique<br/>(nombre / unit&eacute;)</td><td><input type="number" name="nb" title="nombre" value="<?php echo set_value('nb'); ?>"/><input type="text" name="unit" title="exemple : individus, boites, planches d'herbier, etc" value="<?php echo set_value('unit'); ?>"/></td></tr>
				<tr>
					<td>Stockage informatique </td>
					<td>
						<select name=IdSupport[] multiple="multiple" size=5>
						<?php
						// On parcourt la liste des années récentes							
						foreach ($support as $item)
							{
								echo "<option value='".$item['IdSupport']."' ".set_select('IdSupport[]', $item['IdSupport']).">".$item['FormatSupport']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
					</select>
					</td>
				</tr>				
				<tr><td>Base de donn&eacute;es<br/>(url) </td><td><input type="url" name="urlbdd" value="<?php echo set_value('urlbdd'); ?>" /></td></tr>
				<tr><td>Niveau d'informatisation<br/>(faible, total, 30%, etc) </td><td><input type="text" name="nivinfo"  value="<?php echo set_value('nivinfo'); ?>"/></td></tr>
				<tr><th colspan=2>Personnes</th></tr>
				<!-- On mets 1 personne obligatoire, et une 2ème facultative -->
				<tr><td>Pr&eacute;fixe </td><td><input type="text" name="prefixPers"  value="<?php echo set_value('prefixPers'); ?>"/></td></tr>
				<tr><td>Nom * </td><td><input type="text" name="nomPers"  value="<?php echo set_value('nomPers'); ?>"/></td></tr>
				<tr><td>Pr&eacute;nom * </td><td><input type="text" name="prenomPers"  value="<?php echo set_value('prenomPers'); ?>"/></td></tr>
				<tr><td>Ann&eacute;e de naissance </td><td><input type="number" name="naissancePers"  value="<?php echo set_value('naissancePers'); ?>"/></td></tr>
				<tr><td>Ann&eacute;e de d&eacute;c&eacute;s </td><td><input type="number" name="decesPers" value="<?php echo set_value('decesPers'); ?>" /></td></tr>
				<tr><td>Email * </td><td><input type="email" name="mailPers" value="<?php echo set_value('mailPers'); ?>" /></td></tr>
				<tr><td>Num&eacute;ro de t&eacute;l&eacute;phone </td><td><input type="tel" name="telPers" value="<?php echo set_value('telPers'); ?>" /></td></tr>
				<tr><td>Adresse </td><td><input type="text" name="adressePers" value="<?php echo set_value('adressePers'); ?>" /></td></tr>
				<tr>
					<td>R&ocirc;le </td>
					<td>
						<select name="IdRole">
						<?php
							// On parcourt la liste des roles
							foreach ($role as $item)
							{
								echo "<option value='".$item['IdRole']."' ".set_select('IdRole', $item['IdRole']).">".trim($item['NameRole'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<!-- On stocke ici le nombre de personnes a récupérer (à modifier dynamiquement par javascript)-->
				<tr><td><input type="hidden" name="nbPers" value="2"/><br/></td></tr>
				<tr><td>Pr&eacute;fixe </td><td><input type="text" name="prefixPers2"  value="<?php echo set_value('prefixPers2'); ?>"/></td></tr>
				<tr><td>Nom </td><td><input type="text" name="nomPers2"  value="<?php echo set_value('nomPers2'); ?>"/></td></tr>
				<tr><td>Pr&eacute;nom </td><td><input type="text" name="prenomPers2"  value="<?php echo set_value('prenomPers2'); ?>"/></td></tr>
				<tr><td>Ann&eacute;e de naissance </td><td><input type="number" name="naissancePers2"  value="<?php echo set_value('naissancePers2'); ?>"/></td></tr>
				<tr><td>Ann&eacute;e de d&eacute;c&eacute;s </td><td><input type="number" name="decesPers2" value="<?php echo set_value('decesPers2'); ?>" /></td></tr>
				<tr><td>Email </td><td><input type="email" name="mailPers2" value="<?php echo set_value('mailPers2'); ?>" /></td></tr>
				<tr><td>Num&eacute;ro de t&eacute;l&eacute;phone </td><td><input type="tel" name="telPers2" value="<?php echo set_value('telPers2'); ?>" /></td></tr>
				<tr><td>Adresse </td><td><input type="text" name="adressePers2" value="<?php echo set_value('adressePers2'); ?>" /></td></tr>
				<tr>
					<td>R&ocirc;le </td>
					<td>
						<select name="IdRole2">
						<?php
							// On parcourt la liste des roles
							foreach ($role as $item)
							{
								echo "<option value='".$item['IdRole']."' ".set_select('IdRole2', $item['IdRole']).">".trim($item['NameRole'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td><input type="submit" value="Valider"/></td></tr>
			</form>
		</table>
		<?php
		}
		// Si rien, on donne le choix entre ajout inst ou dataset
		else
		{
			echo "<a href='".site_url('ajoutinst')."'>Ajout d'une nouvelle institution</a><br/>";
			echo "<a href='".site_url('ajoutdata')."'>Ajout d'un nouveau jeu de donn&eacute;es</a>";
		}
		?>
</div>

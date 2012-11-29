<div id=body >
		<?php
		// On charge le helper d'url
		$this->load->helper('url');
		// Si modif institution
		if (isset($typeinst))
		{
			echo validation_errors();
		?>
		<table>
			<form method="post" action="<?php echo site_url('modifinst'); ?>">
				<tr><th colspan=2>Informations concernant l'institution</th></tr>
				<tr><td>Nom *</td><td><input type="text" name="nomInst" value="<?php echo set_value('nomInst', $inst->NameInst); ?>" /></td></tr>
				<tr><td>Description *</td><td><textarea name="descInst"><?php echo set_value('descInst', $inst->DescriptionInst); ?></textarea></td></tr>
				<tr><td>Sigle </td><td><input type="text" name="sigleInst" value="<?php echo set_value('sigleInst', $inst->SigleInst); ?>" /></td></tr>
				<tr><td>Adresse (num&eacute;ro + rue) *</td><td><input type="text" name="adresseInst" value="<?php echo set_value('adresseInst', $inst->AddressInst); ?>" /></td></tr>
				<tr><td>Code postal *</td><td><input type="number" name="codepostalInst" value="<?php echo set_value('codepostalInst', $inst->PostalCode); ?>" /></td></tr>
				<tr>
					<td>Ville *</td>
					<td>
						<select name="IdTown">
							<option value="0">Nouvelle ville</option>
						<?php
							// On parcourt la liste des villes
							foreach ($ville as $item)
							{
								echo "<option value='".$item['IdTown']."'";
								if ($inst->IdTown == $item['IdTown'])
								{
									echo " ".set_select('IdTown', $item['IdTown'], TRUE);
								}
								else
								{
									echo " ".set_select('IdTown', $item['IdTown']);
								}
								echo ">".trim($item['NameTown'])."</option>";
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
								echo "<option value='".$item['IdRegion']."'";
								if ($inst->IdRegion == $item['IdRegion'])
								{
									echo " ".set_select('IdRegion', $item['IdRegion'], TRUE);
								}
								else
								{
									echo " ".set_select('IdRegion', $item['IdRegion']);
								}
								echo ">".trim($item['NameRegion'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td>T&eacute;l&eacute;phone </td><td><input type="tel" name="telInst" value="<?php echo set_value('telInst', $inst->PhoneInst); ?>" /></td></tr>
				<tr><td>Mail </td><td><input type="email" name="mailInst" value="<?php echo set_value('mailInst', $inst->EmailInst); ?>" /></td></tr>
				<tr><td>Adresse URL du logo de l'institution </td><td><input type="url" name="logoInst" value="<?php echo set_value('logoInst', $inst->LogoUrlInst); ?>" /></td></tr>
				<tr><td>Site web de l'institution </td><td><input type="url" name="urlInst" value="<?php echo set_value('urlInst', $inst->UrlInst); ?>" /></td></tr>
				<tr>
					<td>Id inst parente </td>
					<td>
						<select name=parentInst>
							<option value='0'>Aucune</option>
						<?php
							// On parcourt la liste des inst
							foreach ($instmere as $item)
							{
								echo "<option value='".$item['IdInst']."'";
								if ($inst->IdInstParent == $item['IdInst'])
								{
									echo " ".set_select('parentInst', $item['IdInst'], TRUE);
								}
								else
								{
									echo " ".set_select('parentInst', $item['IdInst']);
								}
								echo ">".trim($item['NameInst'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<?php
				?>
				<tr>
					<td>Type *</td>
					<td>
						<select name=IdTypeInst[] multiple="multiple" size=5>
						<?php
							// On découpe la variable $type en un tableau
							$type = explode(', ' , $type);
							// On parcourt la liste des typeinst
							foreach ($typeinst as $item)
							{
								echo "<option value='".$item['IdTypeInst']."'";
								// On parcourt le tableau contenant les types de l'institution
								foreach ($type as $item2)
								{
									if ($item2 == $item['NameTypeInst'])
									{
										echo " ".set_select('IdTypeInst[]', $item['IdTypeInst'], TRUE);
									}
									else
									{
										echo " ".set_select('IdTypeInst[]', $item['IdTypeInst']);
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".trim($item['NameTypeInst'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td><input type="hidden" name="idInst" value="<?php echo $inst->IdInst; ?>"/></td></tr>
				<tr><td><input type="submit" value="Valider les modifications"/></td></tr>
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
			<form method="post" action="<?php echo site_url('modifdata'); ?>">
				<tr><th colspan=2>Informations concernant le jeu de donn&eacute;es</th></tr>
				<tr>
					<td>Institution *</td>
					<td>
						<select name=inst>
						<?php
							// On parcourt la liste des inst
							foreach ($inst as $item)
							{
								echo "<option value='".$item['IdInst']."'";
								if ($data->IdInst == $item['IdInst'])
								{
									echo " ".set_select('inst', $item['IdInst'], TRUE);
								}
								else
								{
									echo " ".set_select('inst', $item['IdInst']);
								}
								echo ">".trim($item['NameInst'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td>Nom *</td><td><input type="text" name="nomData" value="<?php echo set_value('nomData', $data->NameData); ?>" /></td></tr>
				<tr><td>Identifiant GBIF si connect&eacute; </td><td><input type="text" name="idGbif" title="chiffre &agrave; la fin de l'url gbif. Exemple : http://data.gbif.org/datasets/resource/1850/, il faut indiquer 1850" value="<?php echo set_value('idGbif', $data->IdGbif); ?>" /></td></tr>
				<tr><td>Identifiant GBIF France si connect&eacute; </td><td><input type="text" name="idGbifFrance" title="explication a venir" value="<?php echo set_value('idGbifFrance', $data->IdGbifFrance); ?>" /></td></tr>
				<tr><td>Description *</td><td><textarea name="descData"><?php echo set_value('descData', $data->DescriptionData); ?></textarea></td></td></tr>
				<tr><td>Droits </td><td><input type="text" name="rights" title="s'il existe des limites de consultation/utilisation des donn&eacute;es, indiquez les ici" value="<?php echo set_value('rights', $data->Rights); ?>" /></td></tr>
				<tr><td>But </td><td><input type="text" name="purpose" title="dans quel but ces donn&eacute;es ont &eacute;t&eacute; collect&eacute;es (recherche, enseignement, inventaires, etc)" value="<?php echo set_value('purpose', $data->Purpose); ?>" /></td></tr>
				<tr>
					<td>Poss&egrave;de des types? </td>
					<td>
						<select name="type">
							<option value="NON"
							<?php 
							if($data->HaveType == 'NON')
							{
								echo " ".set_select('type', 'NON', TRUE);
							}
							else
							{
								echo " ".set_select('type', 'NON');
							}
							?>
							>Non</option>
							<option value="OUI"
								<?php 
							if($data->HaveType == 'OUI')
							{
								echo " ".set_select('type', 'OUI', TRUE);
							}
							else
							{
								echo " ".set_select('type', 'OUI');
							}
							?>
							>Oui</option>
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
								echo "<option value='".$item['IdTypeData']."'";
								if ($data->IdTypeData == $item['IdTypeData'])
								{
									echo " ".set_select('IdTypeData', $item['IdTypeData'], TRUE);
								}
								else
								{
									echo " ".set_select('IdTypeData', $item['IdTypeData']);
								}
								echo ">".trim($item['NameTypeData'])."</option>";
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
							// On découpe la variable en un tableau
							$natureD = explode(', ' , $natureD);
							// On parcourt la liste des naturedata
							foreach ($naturedata as $item)
							{
								echo "<option value='".$item['IdNature']."'";
								// On parcourt le tableau contenant les natures du dataset
								foreach ($natureD as $item2)
								{
									if ($item2 == $item['NameNature'])
									{
										echo " ".set_select('IdNature[]', $item['IdNature'], TRUE);
									}
									else
									{
										echo " ".set_select('IdNature[]', $item['IdNature']);
									}
								}
								// On libère la variable
								unset ($item2);
								echo ">".trim($item['NameNature'])."</option>";
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
								echo "<option value='".$item['IdData']."'";
								if ($data->IdDataParent == $item['IdData'])
								{
									echo " ".set_select('parentData', $item['IdData'], TRUE);
								}
								else
								{
									echo " ".set_select('parentData', $item['IdData']);
								}
								echo ">".trim($item['NameData'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><th colspan=2>G&eacute;ographie</th></tr>
				<tr>
					<td>Continent </td>
					<?
					if($geoD)
					{
						// On découpe la variable en un tableau
						$ContD = explode(', ' , $geoD->NameContinent);
						$PaysD = explode(', ' , $geoD->NameCountry);
					}
					?>
					<td>
						<select name=IdContinent[] multiple="multiple" size=5>
						<?php
							// On parcourt la liste des continent
							foreach ($continent as $item)
							{
								echo "<option value='".$item['IdContinent']."'";
								if($geoD)
								{
									// On parcourt le tableau contenant les continents du dataset
									foreach ($ContD as $item2)
									{
										if ($item2 == $item['NameContinent'])
										{
											echo " ".set_select('IdContinent[]', $item['IdContinent'], TRUE);
										}
										else
										{
											echo " ".set_select('IdContinent[]', $item['IdContinent']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".trim($item['NameContinent'])."</option>";
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
								echo "<option value='".$item['IdCountry']."'";
								if($geoD)
								{
									// On parcourt le tableau contenant les pays du dataset
									foreach ($PaysD as $item2)
									{
										if ($item2 == $item['NameCountry'])
										{
											echo " ".set_select('IdCountry[]', $item['IdCountry'], TRUE);
										}
										else
										{
											echo " ".set_select('IdCountry[]', $item['IdCountry']);
										}
									}
								}
								echo ">".trim($item['NameCountry'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select>
					</td>
				</tr>
				<tr><td>Pr&eacute;cision g&eacute;ographique </td><td><input type="text" name="precisiongeo" title="exemple : autour de la m&eacute;diterran&eacute;e" value="<?php if($geoD){echo set_value('precisiongeo', $geoD->PrecisionGeo);}else{set_value('precisiongeo');}?>" /></td></tr>
				<tr><td>Latitude min </td><td><input type="text" name="latmin" value="<?php if($geoD){echo set_value('latmin', $geoD->LatMin);}else{echo set_value('latmin', 0);} ?>" /></td></tr>
				<tr><td>Latitude max </td><td><input type="text" name="latmax" value="<?php if($geoD){echo set_value('latmax', $geoD->LatMax);}else{echo set_value('latmax', 0);} ?>" /></td></tr>
				<tr><td>Longitude min </td><td><input type="text" name="longmin" value="<?php if($geoD){echo set_value('longmin', $geoD->LongMin);}else{echo set_value('longmin', 0);} ?>" /></td></tr>
				<tr><td>Longitude max </td><td><input type="text" name="longmax" value="<?php if($geoD){echo set_value('longmax', $geoD->LongMax);}else{echo set_value('longmax', 0);} ?>" /></td></tr>
				<tr><th colspan=2>Taxonomie</th></tr>
				<tr>
					<td>R&egrave;gne </td>
					<?php
					if ($taxoD)
					{
						// On découpe la variable en un tableau
						$kingdomD = explode(', ' , $taxoD->KingdomTaxo);
						$phylumD = explode(', ' , $taxoD->PhylumTaxo);
						$classD = explode(', ' , $taxoD->ClassTaxo);
						$orderD = explode(', ' , $taxoD->OrderTaxo);
					}
					?>
					<td>
						<select name=IdKingdom[] multiple="multiple" size=5>
						<?php
							// On parcourt la liste des kingdom
							foreach ($kingdom as $item)
							{
								echo "<option value='".$item['IdKingdom']."'";
								if ($taxoD)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($kingdomD as $item2)
									{
										if ($item2 == $item['KingdomTaxo'])
										{
											echo " ".set_select('IdKingdom[]', $item['IdKingdom'], TRUE);
										}
										else
										{
											echo " ".set_select('IdKingdom[]', $item['IdKingdom']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".trim($item['KingdomTaxo'])."</option>";
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
							<option value='0' <?php echo set_select('IdPhylum[]', '0'); ?> >Nouveau phylum</option>
						<?php
							// On parcourt la liste des phylum
							foreach ($phylum as $item)
							{
								echo "<option value='".$item['IdPhylum']."'";
								if ($taxoD)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($phylumD as $item2)
									{
										if ($item2 == $item['PhylumTaxo'])
										{
											echo " ".set_select('IdPhylum[]', $item['IdPhylum'], TRUE);
										}
										else
										{
											echo " ".set_select('IdPhylum[]', $item['IdPhylum']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".trim($item['PhylumTaxo'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newphylum" value="<?php echo set_value('newphylum'); ?>"/>
					</td>
				</tr>
				<tr>
					<td>Classe </td>
					<td>
						<select name=IdClass[] multiple="multiple" size=5>
							<option value='0' <?php echo set_select('IdClass[]', '0'); ?> >Nouvelle classe</option>
						<?php
							// On parcourt la liste des class
							foreach ($class as $item)
							{
								echo "<option value='".$item['IdClass']."'";
								if ($taxoD)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($classD as $item2)
									{
										if ($item2 == $item['ClassTaxo'])
										{
											echo " ".set_select('IdClass[]', $item['IdClass'], TRUE);
										}
										else
										{
											echo " ".set_select('IdClass[]', $item['IdClass']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".trim($item['ClassTaxo'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newclasse" value="<?php echo set_value('newclasse'); ?>"/>
					</td>
				</tr>
				<tr>
					<td>Ordre </td>
					<td>
						<select name=IdOrder[] multiple="multiple" size=5>
							<option value='0' <?php echo set_select('IdOrder[]', '0'); ?> >Nouvel ordre</option>
						<?php
							// On parcourt la liste des ordertaxo
							foreach ($ordertaxo as $item)
							{
								echo "<option value='".$item['IdOrder']."'";
								if ($taxoD)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($orderD as $item2)
									{
										if ($item2 == $item['OrderTaxo'])
										{
											echo " ".set_select('IdOrder[]', $item['IdOrder'], TRUE);
										}
										else
										{
											echo " ".set_select('IdOrder[]', $item['IdOrder']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".trim($item['OrderTaxo'])."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type="text" name="newordre" value="<?php echo set_value('newordre'); ?>"/>
					</td>
				</tr>
				<tr><td>Pr&eacute;cision taxonomique </td><td><input type="text" name="precisiontaxo" value="<?php if($taxoD){echo set_value('precisiontaxo', $taxoD->PrecisionTaxo);}else{set_value('precisiontaxo');} ?>" /></td></tr>
				<tr><td>Noms communs </td><td><input type="text" name="nomcommun" value="<?php if($taxoD){echo set_value('nomcommun', $taxoD->CommonName);}else{set_value('nomcommun');} ?>" /></td></tr>
				<tr><th colspan=2>Couverture temporelle</th></tr>
				<?php
				if($tempoD)
				{
					// On découpe la variable en un tableau
					$siecle = explode(', ' , $tempoD->CenturyAncient);
					$annee = explode(', ' , $tempoD->YearCurrent);
				}
				?>
				<tr><td><input type='checkbox' name='temporel[]' value='Fossile'
				<?php
				if($tempoD)
				{
					if(!empty($tempoD->TextFossil))
					{
						echo " ".set_checkbox('temporel[]', 'Fossile', TRUE);
					}
					else
					{
						echo " ".set_checkbox('temporel[]', 'Fossile');
					}
				}
				?>
				>Fossile</td><td><input type="text" name="newfossile" value="<?php if($tempoD){echo set_value('newfossile', $tempoD->TextFossil);}else{set_value('newfossile');} ?>" /></td></tr>
				<tr><td><input type='checkbox' name='temporel[]' value='Ancien'
				<?php
				if($tempoD)
				{
					if(!empty($tempoD->CenturyAncient))
					{
						echo " ".set_checkbox('temporel[]', 'Ancien', TRUE);
					}
					else
					{
						echo " ".set_checkbox('temporel[]', 'Ancien');
					}
				}
				?>
				>Ancien</td><td><select name=IdAncien[] multiple="multiple" size=5>
					<option value='0' <?php echo set_select('IdAncien[]', '0'); ?> >Nouveau si&egrave;cle</option>
					<?php
						// On parcourt la liste des siècles	anciens						
						foreach ($ancient as $item)
							{
								echo "<option value='".$item['IdAncient']."'";
								if($tempoD)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($siecle as $item2)
									{
										if ($item2 == $item['CenturyAncient'])
										{
											echo " ".set_select('IdAncien[]', $item['IdAncient'], TRUE);
										}
										else
										{
											echo " ".set_select('IdAncien[]', $item['IdAncient']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".$item['CenturyAncient']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
						</select><input type='text' name='newAncient' placeholder="siècle" value="<?php echo set_value('newAncient'); ?>"/></td></tr>
					<tr><td><input type='checkbox' name='temporel[]' value='Actuel'
					<?php
					if($tempoD)
					{
						if(!empty($tempoD->YearCurrent))
						{
							echo " ".set_checkbox('temporel[]', 'Actuel', TRUE);
						}
						else
						{
							echo " ".set_checkbox('temporel[]', 'Actuel');
						}
					}
					?>
					>Actuel</td><td><select name=IdActuel[] multiple="multiple" size=5>
						<option value='0' <?php echo set_select('IdActuel[]', '0'); ?> >Nouvelle ann&eacute;e</option>
						<?php
						// On parcourt la liste des années récentes							
						foreach ($current as $item)
							{
								echo "<option value='".$item['IdCurrent']."'";
								if($tempoD)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($annee as $item2)
									{
										if ($item2 == $item['YearCurrent'])
										{
											echo " ".set_select('IdActuel[]', $item['IdCurrent'], TRUE);
										}
										else
										{
											echo " ".set_select('IdActuel[]', $item['IdCurrent']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".$item['YearCurrent']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
					</select><input type='text' name='newCurrent' placeholder="année" value="<?php echo set_value('newCurrent'); ?>" /></td></tr>
				<tr><th colspan=2>M&eacute;thodes</th></tr>
				<tr><td>M&eacute;thode de collecte </td><td><input type="text" name="collecte" value="<?php if($methD){echo set_value('collecte', $methD->CollecteMeth);}else{set_value('collecte');} ?>" /></td></tr>
				<tr><td>M&eacute;thode de pr&eacute;servation </td><td><input type="text" name="preservation" value="<?php if($methD){echo set_value('preservation', $methD->PreservationMeth);}else{set_value('preservation');} ?>" /></td></tr>
				<tr><td>Qualit&eacute; </td><td><input type="text" name="qualite" value="<?php if($methD){echo set_value('qualite', $methD->QualityControl);}else{set_value('qualite');} ?>" /></td></tr>
				<tr><th colspan=2>Projet de recherche</th></tr>
				<?php 
				if($ProjetD)
				{
					// On découpe la variable en un tableau
					foreach ($ProjetD as $proj)
					{
						?>
						<tr><td>Titre du projet </td><td><input type="text" name="titreP" value="<?php echo set_value('titreP', $proj->TitleProject); ?>" /></td></tr>
						<tr><td>Domaine du projet </td><td><input type="text" name="domaineP" value="<?php echo set_value('domaineP', $proj->DomainProject); ?>" /></td></tr>
						<tr><td>Description du projet </td><td><textarea name="descP"><?php echo set_value('descP', $proj->DescriptionProjet); ?></textarea></td></tr>
						<tr><td>Fonds du projet </td><td><input type="text" name="fondP" value="<?php echo set_value('fondP', $proj->FundsProject); ?>" /></td></tr>
						<tr><td><input type="hidden" name="idProject" value="<?php echo $proj->IdProject; ?>"/></td></tr>
						<?php
					}
				}
				else
				{
					?>
					<tr><td>Titre du projet </td><td><input type="text" name="titreP" value="<?php echo set_value('titreP'); ?>" /></td></tr>
					<tr><td>Domaine du projet </td><td><input type="text" name="domaineP" value="<?php echo set_value('domaineP'); ?>" /></td></tr>
					<tr><td>Description du projet </td><td><textarea name="descP"><?php echo set_value('descP'); ?></textarea></td></tr>
					<tr><td>Fonds du projet </td><td><input type="text" name="fondP" value="<?php echo set_value('fondP'); ?>" /></td></tr>
					<?php
				}
				?>
				<tr><th colspan=2>Bibliographie</th></tr>
				<?php
				if($BiblioD)
				{
					// On découpe la variable en un tableau
					foreach ($BiblioD as $biblio)
					{
						?>
						<tr><td>R&eacute;f&eacute;rence </td><td><input type="text" name="refB" title="DOI, identifiant dans la source originale, lien vers un jeu de donn&eacute;es li&eacute;, etc" value="<?php echo set_value('refB', $biblio->RefBiblio); ?>" /></td></tr>
						<tr><td>Type de ressource </td><td><input type="text" name="typeB" title="publication, source originale, jeux de donn&eacute;es li&eacute;s, ressources li&eacute;es, etc " value="<?php echo set_value('typeB', $biblio->TypeRessource); ?>" /></td></tr>
						<tr><td><input type="hidden" name="idBiblio" value="<?php echo $biblio->IdBiblio; ?>"/></td></tr>
						<?php 
					}
				}
				else
				{
					?>
					<tr><td>R&eacute;f&eacute;rence </td><td><input type="text" name="refB" title="DOI, identifiant dans la source originale, lien vers un jeu de donn&eacute;es li&eacute;, etc" value="<?php echo set_value('refB'); ?>" /></td></tr>
					<tr><td>Type de ressource </td><td><input type="text" name="typeB" title="publication, source originale, jeux de donn&eacute;es li&eacute;s, ressources li&eacute;es, etc " value="<?php echo set_value('typeB'); ?>" /></td></tr>
					<?php 
				}
				?>
				<tr><th colspan=2>Stockage</th></tr>
				<?php 
				if($StockD->physique)
				{
					// On découpe la variable en un tableau
					foreach ($StockD->physique as $physique)
					{
						list($nb, $unit) = explode(' ' , $physique->phys);
						?>
						<tr><td>Stockage physique </td><td><input type="number" name="nb" title="nombre" value="<?php echo set_value('nb', $nb); ?>"/><input type="text" name="unit" title="exemple : individus, boites, planches d'herbier, etc" value="<?php echo set_value('unit', $unit); ?>"/></td></tr>
						<tr><td><input type="hidden" name="idPhysicalSize" value="<?php echo $physique->IdPhysicalSize; ?>"/></td></tr>
						<?php
					}
				}
				else
				{
					?>
					<tr><td>Stockage physique </td><td><input type="number" name="nb" title="nombre" value="<?php echo set_value('nb'); ?>"/><input type="text" name="unit" title="exemple : individus, boites, planches d'herbier, etc" value="<?php echo set_value('unit', 'unité'); ?>"/></td></tr>
					<?php
				}
				?>
				<tr><td>Stockage informatique </td>
					<td>
						<select name=IdSupport[] multiple="multiple" size=5>
						<?php
						if($StockD->FormatSupport)
						{
							// On découpe la variable en un tableau
							$format = explode(', ' , $StockD->FormatSupport);
						}
						// On parcourt la liste des supports							
						foreach ($support as $item)
							{
								echo "<option value='".$item['IdSupport']."'";
								if($StockD->FormatSupport)
								{
									// On parcourt le tableau contenant les éléments du dataset
									foreach ($format as $item2)
									{
										if ($item2 == $item['FormatSupport'])
										{
											echo " ".set_select('IdSupport[]', $item['IdSupport'], TRUE);
										}
										else
										{
											echo " ".set_select('IdSupport[]', $item['IdSupport']);
										}
									}
									// On libère la variable
									unset ($item2);
								}
								echo ">".$item['FormatSupport']."</option>";
							}
							// On libère la variable
							unset ($item);
						?>
					</select>
					</td>
				</tr>
				<?php 	
				if($StockD->bdd)	
				{	
					// On découpe la variable en un tableau
					foreach ($StockD->bdd as $bdd)
					{
						?>
						<tr><td>Base de donn&eacute;es </td><td><input type="url" name="urlbdd" value="<?php echo set_value('urlbdd', $bdd->UrlDatabase); ?>" /></td></tr>
						<tr><td>Niveau d'informatisation </td><td><input type="text" name="nivinfo" value="<?php echo set_value('nivinfo', $bdd->NivInformatisation); ?>" /></td></tr>
						<tr><td><input type="hidden" name="idInfoDatabase" value="<?php echo $bdd->IdInfoDatabase; ?>"/></td></tr>
						<?php
					}
				}
				else
				{
					?>
					<tr><td>Base de donn&eacute;es </td><td><input type="url" name="urlbdd" value="<?php echo set_value('urlbdd', 'url'); ?>" /></td></tr>
					<tr><td>Niveau d'informatisation </td><td><input type="text" name="nivinfo" value="<?php echo set_value('nivinfo'); ?>" /></td></tr>
					<?php
				}
				?>				
				<tr><th colspan=2>Personnes</th></tr>
				<?php
				foreach ($personneD as $pers)
				{
					?>
						<tr><td>Pr&eacute;fixe </td><td><input type="text" name="prefixPers" value="<?php echo set_value('prefixPers', $pers->PrefixPers); ?>" /></td></tr>
						<tr><td>Nom * </td><td><input type="text" name="nomPers" value="<?php echo set_value('nomPers', $pers->SurNamePers); ?>"/></td></tr>
						<tr><td>Pr&eacute;nom * </td><td><input type="text" name="prenomPers" value="<?php echo set_value('prenomPers', $pers->FirstNamePers); ?>"/></td></tr>
						<tr><td>Ann&eacute;e de naissance </td><td><input type="number" name="naissancePers" value="<?php echo set_value('naissancePers', $pers->BirthYear); ?>"/></td></tr>
						<tr><td>Ann&eacute;e de d&eacute;c&eacute;s </td><td><input type="number" name="decesPers" value="<?php echo set_value('decesPers', $pers->DeathYear); ?>"/></td></tr>
						<tr><td>Email </td><td><input type="email" name="mailPers" value="<?php echo set_value('mailPers', $pers->EmailPers); ?>"/></td></tr>
						<tr><td>Num&eacute;ro de t&eacute;l&eacute;phone </td><td><input type="tel" name="telPers" value="<?php echo set_value('telPers', $pers->PhonePers); ?>"/></td></tr>
						<tr><td>Adresse </td><td><input type="text" name="adressePers" value="<?php echo set_value('adressePers', $pers->AddressPers); ?>"/></td></tr>
						<tr><td><input type="hidden" name="idPers" value="<?php echo $pers->IdPersonne; ?>"/></td></tr>
						<tr>
							<td>R&ocirc;le </td>
							<td>
								<select name="IdRole">
									<?php
									// On parcourt la liste des roles
									foreach ($role as $item)
									{
										echo "<option value='".$item['IdRole']."'";
										if ($pers->IdRole == $item['IdRole'])
										{
											echo " ".set_select('IdRole', $item['IdRole'], TRUE);
										}
										else
										{
											echo " ".set_select('IdRole', $item['IdRole']);
										}
										echo ">".trim($item['NameRole'])."</option>";
									}
									// On libère la variable
									unset ($item);
								?>
							</select>
						</td>
					</tr>
					<?php
				}
				?>
				<tr><td><input type="hidden" name="idData" value="<?php echo $data->IdData; ?>"/></td></tr>
				<?php if($geoD){ ?><tr><td><input type="hidden" name="idGeo" value="<?php echo $geoD->IdGeo; ?>"/></td></tr><?php } ?>
				<?php if($taxoD){ ?><tr><td><input type="hidden" name="idTaxo" value="<?php echo $taxoD->IdTaxo; ?>"/></td></tr><?php } ?>
				<?php if($tempoD){ ?><tr><td><input type="hidden" name="idTempo" value="<?php echo $tempoD->IdTempo; ?>"/></td></tr><?php } ?>
				<?php if($methD){ ?><tr><td><input type="hidden" name="idMeth" value="<?php echo $methD->IdMethod; ?>"/></td></tr><?php } ?>
				<tr><td><input type="submit" value="Valider les modifications"/></td></tr>
			</form>
		</table>
		<?php
		}
		// Si rien, on donne le choix entre inst ou dataset
		else
		{
			?>
			<form method="post" action="modification/inst">
				<table>
					<tr><td><select name=idInst>
						<option value='0'></option>
					<?php
						// On parcourt la liste des inst
						foreach ($inst as $item)
						{
							echo "<option value='".$item['IdInst']."'>".trim($item['NameInst'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select></td>
					<td><input type="submit" value="Modifier une institution" style="width:100%" /></td></tr>
				</table>
			</form>
			<form method="post" action="modification/dataset">
				<table>				
					<tr><td><select name=idData>
						<option value='0'></option>
					<?
						// On parcourt la liste des inst
						foreach ($dataset as $item)
						{
							echo "<option value='".$item['IdData']."'>".trim($item['NameData'])."</option>";
						}
						// On libère la variable
						unset ($item);
					?>
					</select></td>
					<td><input type="submit" value="Modifier un jeu de donn&eacute;es" style="width:100%" /></td></tr>
				</table>
			</form>
			<?php
		}
		?>
</div>

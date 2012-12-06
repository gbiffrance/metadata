<div id=body >
	<p>La recherche simple vous permet de rechercher une institution, un jeu de donn&eacute;es ou une personne par le biais d'un mot cl&eacute; dont la nature est pr&eacute;cis&eacute;e entre paranth&egrave;ses pour chaque type de recherche.</p>
	<table>
<!--		<form method="post" action="resultat">
			<tr>
				<td>Mot cl&eacute; institution <br/>(nom ou type ou r&eacute;gion ou ville)</td>
				<td><input type="text" name="motcle" /></td>
				<td><input type="hidden" name="choix" value="institution" /></td>
				<td><input type="submit" value="Valider"/></td>
			</tr>
		</form>
		<form method="post" action="resultat">
			<tr>
				<td>Mot cl&eacute; dataset <br/>(nom ou type ou nature)</td>
				<td><input type="text" name="motcle" /></td>
				<td><input type="hidden" name="choix" value="dataset" /></td>
				<td><input type="submit" value="Valider"/></td>
			</tr>
		</form>
		<form method="post" action="resultat">
			<tr>
				<td>Mot cl&eacute; personne <br/>(nom ou r&ocirc;le)</td>
				<td><input type="text" name="motcle" /></td>
				<td><input type="hidden" name="choix" value="person" /></td>
				<td><input type="submit" value="Valider"/></td>
			</tr>
		</form>-->
<!-- AJOUTS TEST Nicolas -->
		<form method="post" action="resultat">
			<tr>
				<td>Mot cl&eacute; institution <br/>(nom ou type ou r&eacute;gion ou ville)</td>
				<td><input type="text" name="motcle" title="Un seul mot" /></td>
				<td><input type="hidden" name="choix" value="institution" /></td>
				<td><input type="submit" value="Valider"/></td>
			</tr>
		</form>
		<form method="post" action="resultat">
			<tr>
				<td>Mot cl&eacute; jeu de donn&eacute;es <br/>(nom ou type ou nature)</td>
				<td><input type="text" name="motcle" title="Un seul mot" /></td>
				<td><input type="hidden" name="choix" value="dataset" /></td>
				<td><input type="submit" value="Valider"/></td>
			</tr>
		</form>
		<form method="post" action="resultat">
			<tr>
				<td>Mot cl&eacute; personne <br/>(nom ou r&ocirc;le)</td>
				<td><input type="text" name="motcle" title="Un seul mot" /></td>
				<td><input type="hidden" name="choix" value="person" /></td>
				<td><input type="submit" value="Valider"/></td>
			</tr>
		</form>
<!-- FIN AJOUTS TEST Nicolas -->
	</table>
	<br/>
	<p>	La recherche avanc&eacute;e vous permet de rechercher une institution ou un jeu de donn&eacute;es &agrave; partir de plusieurs crit&egrave;res.</p>
	<a href="consultavance">Recherche avanc&eacute;e</a>
</div>

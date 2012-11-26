<?php
//include("../html/header.php");
// $connexion = pg_connect ("host=lis-02.snv.jussieu.fr dbname=ncd user=gbif_web password=d0nt4gt!");
$connexion = pg_connect ("host=lully.snv.jussieu.fr dbname=ncd user=gbif_web password=d0nt4gt!");
$Fields=array('InstitutionName', 'InstitutionType', 'Region', 'InstitutionTown', 'InstitutionKey', 'CollectionName','CollectionType', 'FamilyName', 'DateCreated', 'DateModified', 'CommonName', 'TaxonName', 'LivingPeriod', 'Geospatial', 'DateCreated', 'DateModified', 'crea', 'modif' );

function adapt ($field) {
	return trim(addslashes($_GET[$field]));
}

foreach($Fields AS $field) {
	$$field = adapt($field);
}

//echo $Region;
$idlist=array();
if ($InstitutionName) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN institutiongroup WHERE institutionname ilike '%".$InstitutionName."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($InstitutionType) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN institutiongroup WHERE institutiontypeid = $InstitutionType";
	
//	echo $query;
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
	//echo $id[0];
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($Region) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN institutiongroup WHERE regionid = $Region";
	
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	
	array_push($idlist,$cond);
}
if ($InstitutionTown) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN institutiongroup NATURAL JOIN town WHERE town ilike '%".$InstitutionTown."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($InstitutionKey) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN institutiongroup NATURAL JOIN instgrpclass NATURAL JOIN institutionclass WHERE institutionclass ilike '%".$InstitutionKey."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($CollectionName) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN descriptivegroup WHERE collectionname ilike '%".$CollectionName."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($CollectionType) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN keywords_type WHERE collectiontypeid = $CollectionType";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($FamilyName) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN persongroup NATURAL JOIN person WHERE familyname ilike '%".$FamilyName."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($CommonName) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN keywords_commonname NATURAL JOIN commonnamecoverage WHERE source ilike '%".$CommonName."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($TaxonName) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN taxoncoverage WHERE source ilike '%".$TaxonName."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($LivingPeriod) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN livingtimeperiod WHERE source ilike '%".$LivingPeriod."%' OR sourcebegin ilike '%".$LivingPeriod."%' OR sourceend ilike '%".$LivingPeriod."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($Geospatial) {
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN keywords_geospatial NATURAL JOIN geospatialcoverage WHERE source ilike '%".$Geospatial."%'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($DateCreated) {
	list($day, $month, $year) = split('[/.-]', $DateCreated);
	$DateCreated = "$month/$day/$year"; //chgt format date
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN ncdheader WHERE recordcreateddate $crea '$DateCreated'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}
if ($DateModified) {
	list($day, $month, $year) = split('[/.-]', $DateModified);
	$DateModified = "$month/$day/$year"; //chgt format date
	$query = "SELECT DISTINCT metadatacollectionid FROM metadatacollection NATURAL JOIN ncdheader WHERE recordeditdate $modif '$DateModified'";
	$result = pg_exec ($connexion, $query) ;
	$tempid=array();
	while ($id=pg_fetch_row($result)) {
		if ($id[0]) array_push($tempid,$id[0]);
	}
	if ($tempid[0]) {
		$collid = join(", ", $tempid);
		$cond = "metadatacollectionid IN ($collid)";
	}
	else {
		$cond = "metadatacollectionid = -1";
	}
	array_push($idlist,$cond);
}


if ($idlist) 
{
	$conditionid = join(" AND ", $idlist);
	$conditionid = " AND $conditionid";
}

/*
$query = "SELECT DISTINCT metadatacollectionid, collectionname, institutionname, institutionid, town FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN institutiongroup NATURAL JOIN town WHERE collectionname !='' AND institutionname != '' $conditionid";
$_SESSION['query'] = $query;

$querycount = "SELECT COUNT (DISTINCT metadatacollectionid) FROM metadatacollection NATURAL JOIN descriptivegroup NATURAL JOIN institutiongroup NATURAL JOIN town WHERE collectionname !='' AND institutionname != '' $conditionid";
$counts = pg_exec ($connexion, $querycount) ;
$count=pg_fetch_row($counts);
$_SESSION['count'] = $count;

*/
?>


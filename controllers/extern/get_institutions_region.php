<?
//include("all_functions2_2.inc");
$connexion = pg_connect ("host=lis-02.snv.jussieu.fr dbname=ncd user=gbif_web password=d0nt4gt!"); 
//$q='select count(distinct) institutionname,regionid from institutiongroup where regionid=1';
$id=$_GET['id'];
$query="select count(institutionname) from institutiongroup where regionid=$id";


$output = array();
$num_institutions = pg_query ($connexion, $query) ;
//$num_rows=pg_num_rows($institutions);


while ($row = pg_fetch_row($num_institutions)) {
$output['num_institutions']=$row[0];
}

//$query="select distinct institutionname,regionid from institutiongroup where regionid=$id";
$query="select distinct institutionname,institutionid,regionid from institutiongroup NATURAL JOIN descriptivegroup NATURAL JOIN town where institutiongroup.regionid=$id";
$list_institutions = pg_query ($connexion, $query) ;
//$num_rows=pg_num_rows($institutions);


while ($row = pg_fetch_row($list_institutions)) {
$output['list_institutions'][]=$row[0];
$output['id_institutions'][]=$row[1];
}

echo $_GET['callback'].'('.json_encode( $output ).');';


?>
<?php
/**
 * Get all informations about institutions, collections and persons
 * Return them in a JSON object
 */
//header('Content-type: application/json');
include("all_functions.inc");

$i=$_GET['i'];
$type=$_GET['type'];

$jsonArray = array();

if($type == "inst") // INSTITUTION DETAILS
{
	$jsonArray['institutions'][]=institution_result($i);
	$jsonArray['num_collections']=num_collections ($i);
	$jsonArray['pages']=round($jsonArray['num_collections']/10);
	
	if($jsonArray['num_collections'] > 0)
	{
		if (count(list_collections ($i))>0)
		{
			foreach (list_collections ($i) as $k=>$v)
			{
				$jsonArray['list_collections'][]=$v;
			}
		}
		else
		{
			$jsonArray['list_collections'][]='no info avaible about collections';
		}
	}
	else
	{
		$jsonArray['list_collections'][]='no info avaible about collections';
	}
} // if $type=="inst"
else if($type == "coll") // COLLECTION DETAILS
{
	$jsonArray['collection'][]= collection_result($_GET['i']);
	$jsonArray['institution'][]= institution_result(collection_getInstID($_GET['i']),true);
	$jsonArray['collection_details'][]= collection_details($_GET['i']);
	$jsonArray['collection_person'][]= collection_person($_GET['i']);
} // if $type=="coll"
else if($type == "pers") // PERSON DETAILS
{
	$jsonArray['person'][]= person_information($_GET['i']);
	$jsonArray['person_dataset'][]= person_dataset($_GET['i']);
} // if $type=="pers"

echo json_encode($jsonArray); 
?>

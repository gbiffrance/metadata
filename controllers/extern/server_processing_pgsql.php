<?php
/*
 * Script:    DataTables server-side script for PHP and PostgreSQL
 * Copyright: 2010 - Allan Jardine
 * License:   GPL v2 or BSD (3-point)
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

/* Array of database columns which should be read and sent back to DataTables. Use a space where
 * you want to insert a non-database field (for example a counter or static image)
 */

require("../../ci_core.php");
$ci = get_instance();
$ci->load->model('Bdd_select');
global $output2;

switch ($_GET['info']) {
	case 'institutions':
		/////////////////////////////// PERE DELETE ///////////////////////////////////
// 		$aColumns = array( 'institutionid','institutionname','institutiontype','town');
// 		/* Indexed column (used for fast and accurate table cardinality) */
// 		$sIndexColumn = "institutionid";
// 		/* DB table to use */
// 		$sTable = "institutiongroup";
// 		$joins='NATURAL JOIN metadatacollection NATURAL JOIN town NATURAL JOIN institutiontype NATURAL JOIN descriptivegroup';
		/////////////////////////////// END PERE DELETE ///////////////////////////////////
		
		$type='institutions';
		$data_ids = array('0'); // column to hide
		$searchWord = '';
		/* 
		* Filtering
		* NOTE This assumes that the field that is being searched on is a string typed field (ie. one
		* on which ILIKE can be used). Boolean fields etc will need a modification here.
		*/
		if ( $_GET['sSearch'] != "" )
		{
			$filtering=true;
			$searchWord =  $_GET['sSearch'];
		}
		
		// Look for institution corresponding to key words
		$aaData = $ci->Bdd_select->search_inst($searchWord);
		$iTotal = count($aaData);
		$iFilteredTotal = $iTotal;
		
		$aaDataPere = array();
		for($i=0;$i<sizeof($aaData);$i++)
		{
			$aaDataPere[$i] = array($aaData[$i]['IdInst'],$aaData[$i]['NameInst'],$aaData[$i]['NameTypeInst'],$aaData[$i]['NameTown']);
		}
		
		//$aaDataPere[0][1] = 'YOPPP : '.$_GET['info']; // TODO : REMOVE !
// 		$gget = 'get=';
// 		foreach( $_GET as $key => $value){
// 			$gget .= "; $key : $value ";
// 		}
// 		$aaDataPere[0][1] = $gget; // TODO : REMOVE !
		
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$aaDataPere = array_slice($aaDataPere,$_GET['iDisplayStart'],$_GET['iDisplayLength']);
		}
		$output2 = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"type"=>$type,
			"ids_to_hide"=> $data_ids,
			"aaData" => $aaDataPere,
			"ids" => array()
		);
	break;
	
	case 'collections':
		/////////////////////////////// PERE DELETE ///////////////////////////////////
		//COLUMNS, ALLWAYS FIRST IDs (invisible on tables), the institution, collection and town 
		//pay attention to the order of $aColumns! (IDs and its related field!)
// 		$aColumns = array( 'institutionid','metadatacollectionid','institutionname','collectionname','town');
// 		
// 		/* Indexed column (used for fast and accurate table cardinality) */
// 		$sIndexColumn = "metadatacollectionid";
// 		
// 		/* DB table to use */
// 		$sTable = "metadatacollection";
// 			
// 		$joins = "NATURAL JOIN descriptivegroup NATURAL JOIN institutiongroup NATURAL JOIN town";
// 		$individual_where='NOT metadatacollection.metadatacollectionid=0';
// 		$data_ids=array('0','1');
// 		$type='collections';
		/////////////////////////////// END PERE DELETE ///////////////////////////////////
		
		$type='collections';
		$data_ids = array('0','1'); // columns to hide
		$searchWord = '';
		/* 
		* Filtering
		* NOTE This assumes that the field that is being searched on is a string typed field (ie. one
		* on which ILIKE can be used). Boolean fields etc will need a modification here.
		*/
		if ( $_GET['sSearch'] != "" )
		{
			$filtering=true;
			$searchWord =  $_GET['sSearch'];
		}
		
		// Look for collection corresponding to key words 
		$aaData = $ci->Bdd_select->search_data($searchWord);
		
		$iTotal = count($aaData);
		$iFilteredTotal = $iTotal;
		
		$aaDataPere = array();
// 		$instDetails = array(); // info about all institutions owning datasets
		for($i=0;$i<sizeof($aaData);$i++)
		{
			$inst = $ci->Bdd_select->get_infoInst($aaData[$i]['IdInst']);
			$town = $ci->Bdd_select->get_townInst($inst->IdTown);
			$aaDataPere[$i] = array($aaData[$i]['IdInst'],$aaData[$i]['IdData'],$aaData[$i]['NameInst'],$aaData[$i]['NameData'],$town);
		}
// $dataset[$i]['NameTypeData'] ? $dataset[$i]['NameNature'] ?
		
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$aaDataPere = array_slice($aaDataPere,$_GET['iDisplayStart'],$_GET['iDisplayLength']);
		}
		$output2 = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"type"=>$type,
			"ids_to_hide"=> $data_ids,
			"aaData" => $aaDataPere,
			"ids" => array()
		);
		break;
	
	case 'colls_by_region': 
	
		/////////////////////////////// PERE DELETE ///////////////////////////////////
// 		$aColumns = array('institutionid','metadatacollectionid','institutionname','collectionname','town');
// 		$sIndexColumn = "metadatacollectionid";
// 		$sTable = "metadatacollection";
// 			
// 		$joins = "NATURAL JOIN descriptivegroup NATURAL JOIN institutiongroup NATURAL JOIN town";
// 		
// 		$individual_where="regionid=".$_GET['id']." AND institutionname != '' AND collectionname != ''";
// 		$data_ids=array('0','1');
// 		$type='colls_by_region';
		/////////////////////////////// END PERE DELETE ///////////////////////////////////
		break;
	
	case 'personnes':
		/////////////////////////////// PERE DELETE ///////////////////////////////////
// 		$aColumns = array( 'personid','institutiongroup.institutionid','metadatacollectionid','familyname','givennames','institutionname','collectionname','role');
// 		$sIndexColumn = "personid";
// 		$sTable = "metadatacollection";		
// 		$joins = "NATURAL JOIN descriptivegroup NATURAL JOIN persongroup 
// 		NATURAL JOIN person JOIN institutiongroup ON institutiongroup.institutionid = metadatacollection.institutionid  
// 		NATURAL JOIN role";
// 		$individual_where=" collectionname !='' AND familyname !='' AND familyname not ilike '%inconnu%'";
// 		$data_ids=array('0','1','2');
// 		$type='personnes';
		/////////////////////////////// END PERE DELETE ///////////////////////////////////
		
		$data_ids=array('0','1','2'); // columns to hide
		$type='personnes';
		$searchWord = '';
		/* 
		* Filtering
		* NOTE This assumes that the field that is being searched on is a string typed field (ie. one
		* on which ILIKE can be used). Boolean fields etc will need a modification here.
		*/
		if ( $_GET['sSearch'] != "" )
		{
			$filtering=true;
			$searchWord =  $_GET['sSearch'];
		}
		
		// Look for person corresponding to key words 
		$aaData = $ci->Bdd_select->search_pers($searchWord);
		
		$iTotal = count($aaData);
		$iFilteredTotal = $iTotal;
		
		$aaDataPere = array();
		for($i=0;$i<sizeof($aaData);$i++)
		{
			$inst = $ci->Bdd_select->get_infoInst($aaData[$i]['IdInst']);
			$aaDataPere[$i] = array($aaData[$i]['IdPersonne'],$aaData[$i]['IdInst'],$aaData[$i]['IdData'],($aaData[$i]['SurNamePers']." ".$aaData[$i]['FirstNamePers']),$inst->NameInst,$aaData[$i]['NameData'],$aaData[$i]['NameRole']);
		}
		
		if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
		{
			$aaDataPere = array_slice($aaDataPere,$_GET['iDisplayStart'],$_GET['iDisplayLength']);
		}
		$output2 = array(
			"sEcho" => intval($_GET['sEcho']),
			"iTotalRecords" => $iTotal,
			"iTotalDisplayRecords" => $iFilteredTotal,
			"type"=>$type,
			"ids_to_hide"=> $data_ids,
			"aaData" => $aaDataPere,
			"ids" => array()
		);
		
		break;
	
// 	case 'regions':
// 	
// 		/////////////////////////////// PERE DELETE ///////////////////////////////////
// 		$query="SELECT  DISTINCT regionid, region, count (distinct institutionid) as count, count (institutionid) as count_institutions 
// 			FROM region NATURAL JOIN institutiongroup NATURAL JOIN metadatacollection NATURAL JOIN descriptivegroup ";
// 		$individual_where=" institutionname != '' AND collectionname != '' GROUP BY region, regionid ";
// 		$aColumns = array( 'regionid','region','count','count_institutions');
// 		
// 		/* Indexed column (used for fast and accurate table cardinality) */
// 		$sIndexColumn = "region";
// 		
// 		/* DB table to use */
// 		$sTable = "region";
// 		
// 		$individual_where=" institutionname != '' AND collectionname != '' ";	
// 		$joins=" NATURAL JOIN institutiongroup NATURAL JOIN metadatacollection NATURAL JOIN descriptivegroup ";
// 		$data_ids=array('0');
// 		$type='regions';
// 		/////////////////////////////// END PERE DELETE ///////////////////////////////////
// 		break;
} // switch info



/////////////////////////////// PERE DELETE ///////////////////////////////////
/* Database connection information */
// $gaSql['user']       = "gbif_web";
// $gaSql['password']   = "d0nt4gt!";
// $gaSql['db']         = "ncd";
// $gaSql['server']     = "lully.snv.jussieu.fr"; // NL : TEST : works !
// //$gaSql['server']     = "localhost";
// 
// // DB connection
// $gaSql['link'] = pg_connect(
// 	" host=".$gaSql['server'].
// 	" dbname=".$gaSql['db'].
// 	" user=".$gaSql['user'].
// 	" password=".$gaSql['password']
// ) or die('Could not connect: ' . pg_last_error());
/////////////////////////////// END PERE DELETE ///////////////////////////////////


// ************* Paging : nb results to show *************
$sLimit = "";
if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
{
	$sLimit = "LIMIT ".pg_escape_string( $_GET['iDisplayLength'] )." OFFSET ".
		pg_escape_string( $_GET['iDisplayStart'] );
}

/* 
 * Filtering
 * NOTE This assumes that the field that is being searched on is a string typed field (ie. one
 * on which ILIKE can be used). Boolean fields etc will need a modification here.
 */
// $sWhere = "";
// if ( $_GET['sSearch'] != "" )
// {
// 	$filtering=true;
// 	$sWhere = "WHERE (";
// 	
// 	//$i=0 is for INTEGER values (ids); ILIKE will not (and not necessary to make work)
// 	//WILL NOT WORK FOR REGIONS!!!
// 	for ( $i=count($data_ids); $i<count($aColumns) ; $i++ )
// 	{
// 
// 		if ( $_GET['bSearchable_'.$i] == "true" )
// 		{
// 		
// 			$sWhere .= $aColumns[$i]." ILIKE '".pg_escape_string( $_GET['sSearch'] )."%' OR ";
// 		}
// 					
// 	}
// 	$sWhere = substr_replace( $sWhere, "", -3 );
// 	$sWhere .= ")";
// }


/* Individual column filtering */
// for ( $i=0 ; $i<count($aColumns) ; $i++ )
// {
// 	if ( $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
// 	{
// 		if ( $sWhere == "" )
// 		{
// 			$sWhere = " WHERE ";
// 		}
// 		else
// 		{
// 			$sWhere .= " AND ";
// 		}
// 		$sWhere .= $aColumns[$i]." ILIKE '".pg_escape_string($_GET['sSearch_'.$i])."%' ";
// 	}
// }

// ************* Filtering : order by institution name, region or type *************
// if ($sWhere=='')  //not filtering by string
// {
// 	if ($individual_where)
// 	{
// 		$sWhere.=" WHERE $individual_where ";
// 	}
// }
// 
// if ($_GET['info'] !== 'regions')
// {
// 	$sQuery = "
// 		SELECT  DISTINCT ".str_replace(" , ", " ", implode(", ", $aColumns))." 
// 		FROM $sTable $joins $sWhere
// 	
// 		$sOrder
// 		$sLimit
// 	";
// }
// else
// {
// 	$sQuery = $query.$sWhere." GROUP BY region, regionid ".$sLimit;
// }
// 
// $rResult = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
// 
// $rResultTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
// 
// $iTotal = pg_num_rows($rResultTotal);
// 
// pg_free_result( $rResultTotal );
// 
// if (!$filtering)
// {
// 	//COLLECTIONS
// 	
// 	$sQuery = "
// 		SELECT DISTINCT $sIndexColumn
// 		FROM $sTable $joins $sWhere 				
// 	";
// 	
// 	$rResultFilterTotal = pg_query( $gaSql['link'], $sQuery ) or die(pg_last_error());
// 	$iFilteredTotal = pg_num_rows($rResultFilterTotal);
// 	pg_free_result( $rResultFilterTotal );
// }
// else
// {
// 	$iFilteredTotal = $iTotal;
// }
/////////////////////////////// END PERE DELETE ///////////////////////////////////


echo $_GET['callback'].'('.json_encode( $output2 ).');';


/////////////////////////////// PERE DELETE ///////////////////////////////////
// Free resultset
// pg_free_result( $rResult );
// 
// // Closing connection
// pg_close( $gaSql['link'] );
/////////////////////////////// END PERE DELETE ///////////////////////////////////
?>

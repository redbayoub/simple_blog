<?php
	// this file is a place to store all basic functions
define('ACC_TAGS', '<p><br><h4><h5><h6><h7><ul><ol><li><table><tr><th><td><a><img><video><b><i>');

function confirm_query($conn,$res_set=true)
{
	if (!$res_set) {
		die("Query has been failed : ".mysqli_error($conn));

	}

}

function get_all($table,$limit=NULL,$ordred_col=NULL,$order_type=NULL)
{
	global $conn;
	$query="SELECT *
					FROM {$table} ";
	if(isset($ordred_col)&&isset($order_type)){
		$query.="ORDER BY {$ordred_col} {$order_type}";
	}
	if(isset($limit)){
		$query.=" LIMIT {$limit}";
	}
	$result_set=mysqli_query($conn,$query);
	confirm_query($conn);

	return $result_set;
}

function get_all_users($acc_approved)
{
	global $conn;
	$query="SELECT *
					FROM pro0inter_users ";
	if($acc_approved==0){
		$query.="WHERE account_type='W' ";
	}
	$query.="ORDER BY approved DESC";
	$result_set=mysqli_query($conn,$query);
	confirm_query($conn);

	return $result_set;
}

function redirect_to($page=NULL)
{
	if($page!=NULL){
		header("Location: {$page}");
		exit;
	}

}

function get_by_nb($table,$nb,$start=0,$ordred_col=NULL,$order_type=NULL)
{
	$res_set=get_all($table,NULL,$ordred_col,$order_type);
  $c=$start;
  while (($tab_res=mysqli_fetch_assoc($res_set))&&($c<=$nb)) {
		$res=$tab_res;
    $c++;
  }
	return $res;
}

function get_by_id($table,$id_col,$ID)
{
	global $conn;
	$query="SELECT *
					FROM {$table}
					WHERE {$id_col}='{$ID}'
					LIMIT 1 ";
	$result_set=mysqli_query($conn,$query);
	confirm_query($result_set);

	return mysqli_fetch_assoc($result_set);
}

function get_all_not_aproved_subjects()
{
	global $conn;
	$query="SELECT *
					FROM pro0inter_subjects
					WHERE subject_aproved=0";

	$result_set=mysqli_query($conn,$query);
	confirm_query($result_set);

	return $result_set;
}

function get_aproved_subjects($min_subj_id,$filed_id=NULL)
{
	global $conn;
	$query="SELECT *
					FROM pro0inter_subjects
					WHERE subject_aproved=1 AND subject_id>{$min_subj_id} " ;
	if ($filed_id!=NULL){
		$query.=" AND subject_filed_id={$filed_id} ";
	}
	$query.="ORDER BY subject_date DESC
					LIMIT 10";

	$result_set=mysqli_query($conn,$query);
	confirm_query($result_set);

	return $result_set;
}

function mysql_prep( $value ) {
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists( "mysql_real_escape_string" ); // i.e. PHP >= v4.3.0
		if( $new_enough_php ) { // PHP v4.3.0 or higher
			// undo any magic quote effects so mysql_real_escape_string can do the work
			if( $magic_quotes_active ) { $value = stripslashes( $value ); }
			$value = mysql_real_escape_string( $value );
		} else { // before PHP v4.3.0
			// if magic quotes aren't already on then add slashes manually
			if( !$magic_quotes_active ) { $value = addslashes( $value ); }
			// if magic quotes are active, then the slashes already exist
		}
		return $value;
	}

	function set_value($table,$col,$id,$new_value,$add=false)
	{
		global $conn;
		$query="UPDATE {$table} ";
		if ($add) {
			$query.=" SET {$col}={$col}+$new_value ";
		}else {
			$query.=" SET {$col}=$new_value ";
		}
		$query.=" WHERE subject_id=$id ";

		$result_set=mysqli_query($conn,$query);
		confirm_query($conn);
		if (mysqli_affected_rows($conn)==1) {
			return true;
		} else {
			return false;
		}
	}
	function display_message()
	{
		if(isset($_GET["msg"])){
			echo "<script>alert('{$_GET["msg"]}');</script>";
		}
	}

	function get_most_viewed_subjects($limit)
	{
		global $conn;
		$query="SELECT *
						FROM pro0inter_subjects
						WHERE subject_aproved=1
						ORDER BY subject_viewes DESC
						LIMIT {$limit}";

		$result_set=mysqli_query($conn,$query);
		confirm_query($conn);

		return $result_set;
	}

	function count_subjects($filed_id=NULL)
	{
		global $conn;
		$query="SELECT COUNT(`subject_id`)
		 				FROM `pro0inter_subjects` ";
		if ($filed_id!=NULL){
				$query.=" WHERE subject_filed_id={$filed_id} ";
		}
		$result_set=mysqli_query($conn,$query);
		confirm_query($conn);
		$res=mysqli_fetch_assoc($result_set);
		return $res["COUNT(`subject_id`)"];
	}
/*
function get_all_subjects()
{
	global $conn;
	$query="SELECT *
			FROM subjects
			ORDER BY position ASC";
	$subject_set=mysqli_query($conn,$query);
	confirm_query($subject_set);

	return $subject_set;
}

function get_pages_for_subject($subject_id)
{
	global $conn;
	$query="SELECT *
  			FROM pages
  			WHERE subject_id={$subject_id}
       	 	ORDER BY position ASC";
	$page_set=mysqli_query($conn,$query);
	confirm_query($page_set);
	return $page_set;
}

function get_subject_by_id($subject_id)
{
	global $conn;
	$query="SELECT * ";
	$query.= "FROM subjects ";
	$query.= "WHERE id={$subject_id} ";
	$query.= "LIMIT 1";
	$result_set=mysqli_query($conn,$query);
	confirm_query($result_set);

	// REMEMBRE :
	// if no rows are returened fetch_array_assoc will return false
	if($subject=mysqli_fetch_assoc($result_set)){
		return $subject;
	}else{
		return NULL;
	}
}

function get_page_by_id($page_id)
{
	global $conn;
	$query="SELECT * ";
	$query.= "FROM pages ";
	$query.= "WHERE id={$page_id} ";
	$query.= "LIMIT 1";
	$result_set=mysqli_query($conn,$query);
	confirm_query($result_set);

	// REMEMBRE :
	// if no rows are returened fetch_array_assoc will return false
	if($page=mysqli_fetch_assoc($result_set)){
		return $page;
	}else{
		return NULL;
	}
}

function find_selected_page()
{
	global $sel_subject;
	global $select_page;
	global $sel_subj_id;
	global $sel_page_id;
	$sel_subj_id="";
	$sel_page_id="";
	if (isset($_GET["subj"])) {
		$sel_subj_id=$_GET["subj"];
		$sel_subject=get_subject_by_id($sel_subj_id);
	}elseif (isset($_GET["page"])) {
		$sel_page_id=$_GET["page"];
		$select_page=get_page_by_id($sel_page_id);
	}
}

function navigation($sel_subject,$select_page,$sel_subj_id,$sel_page_id)
{
	$output= "<ul id=\"subjects\">";
				$subject_set=get_all_subjects();

    			while($subject = mysqli_fetch_assoc($subject_set)) {
    				if ($sel_subj_id==$subject["id"]) {
    					$classT="selected";
    				}else{$classT="";}
       	 			$output.= "<li class=\"".$classT."\"> <a href=\"content.php?subj=". urlencode($subject["id"]) .
       	 			"\"> {$subject["menu_name"]} </a> </li> ";

					$page_set=get_pages_for_subject($subject["id"]);

					if (mysqli_num_rows($page_set) > 0) {
   						$output.= "<ul class=\"pages\">";
   						while($page = mysqli_fetch_assoc($page_set)) {
   							if ($sel_page_id==$page["id"]) {
    							$classT="selected";
    						}else{$classT="";}
      	 					$output.= "<li class=\"".$classT."\"><a href=\"content.php?page=". urlencode($page["id"]) .
      	 					"\">{$page["menu_name"]}</a></li> ";
    					}
    					$output.= "</ul>";
					}
    			}



		$output.= "</ul>";

		return $output;
}
*/
?>

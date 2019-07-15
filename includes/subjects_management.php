<table class="table_list">
<tr>
  <th>N°</th>
      <th>Subject title</th>
      <th>Filed</th>
      <th>Subject writer</th>
      <th>Subject date</th>
      <th>Action</th>
</tr>
<?php
  if(isset($_GET["showSubj"])&&$_GET["showSubj"]!=0){
    if($_GET["showSubj"]==1){
      $subjects_set=get_all_not_aproved_subjects();
    }elseif ($_GET["showSubj"]==2) {
      $subjects_set=get_all("pro0inter_subjects",NUll,"subject_date","DESC");
    }
    $output="";
    $count=1;
    while ($subject_res=mysqli_fetch_assoc($subjects_set)) {
      $subj_id=$subject_res["subject_id"];
      $src_page=urlencode("admin.php?opt=subjManage&showSubj={$_GET["showSubj"]}");
      $output.= "<tr>".
       "<td>{$count}</td>".
       "<td><a href=\"view.php?subj_id={$subj_id}&src_page={$src_page}\">{$subject_res["subject_title"]}</a></td>";

       $filed=get_by_id("pro0inter_fildes","filed_id",$subject_res["subject_filed_id"]);
       $filed_name=$filed["filed_name"];
       $output.="<td>{$filed_name}</td>".
       "<td>{$subject_res["subject_writer"]}</td>".
       "<td>{$subject_res["subject_date"]}</td>";
       if($subject_res["subject_aproved"]==0){
         $output.="<td><a href=\"forms_procc/try_apr_subj.php?subj_id={$subj_id}&showSubj={$_GET["showSubj"]}\">Aprove</a>&nbsp;&nbsp;";
       }else{
         $output.="<td>";
       } // &nbsp;&nbsp;
       $output.="<ul class=\"fileds_nav actions\"><li><a href=\"edit_subj.php?subj_id={$subj_id}&src_page={$src_page}\">Edit</a></li>";
       $output.="<li><a href=\"delate_subj.php?subj_id={$subj_id}&src_page={$src_page}\" onclick=\"return confirm('Are you sure ?');\">Remove</a></li></ul>";
       $output.="</td></tr>";
      $count++;
    }
    echo $output;
  }else{
    // don't show any subject
  }

?>
</table>


<a href="add_subj.php"><h4> + Add a new Subject</h4></a>

<h4>Subject showing options</h4>
<form action="admin.php" method="get" class="form_general">
  <input type="text" name="opt" value="subjManage" hidden>
  <select name="showSubj">
    <option value="0">Don't show Subjects</option>
    <option value="1">Show Not aproved Subjects</option>
    <option value="2">Show all Subjects</option>
  </select>

  <input type="submit" name="" value="apply">
</form>

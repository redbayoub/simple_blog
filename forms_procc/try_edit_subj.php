<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  if (isset($_POST["title"])&&isset($_POST["filed_id"])&&isset($_POST["cover_img"])&&isset($_POST["content"])){
      // we have to validate everything hebrev

    }
?>

<?php
    $subj_title=mysql_prep(htmlspecialchars(strip_tags(trim($_POST["title"]))));
    $subj_content=mysql_prep(strip_tags(nl2br($_POST["content"]),"<p><br><h4><h5><h6><h7><ul><ol><li><table><tr><th><td><a><img><video><b><i>"));
 ?>
<?php
function redirect($msg)
{

  if (isset($_GET["src_page"])&&(!empty($_GET["src_page"]))) {
    $rdr_page="../".$_GET["src_page"];
    redirect_to("{$rdr_page}&msg=".urlencode($msg));
  } else {
    redirect_to("../index.php?msg=".urlencode($msg));
  }
}
?>
<?php  // i have to validate the url of cover image

?>
<?php
// Update database
      $apr=0;
      if(is_writer(1)||is_admin()){
        $apr=1;
      }
      $query="UPDATE `pro0inter_subjects`
            SET `subject_filed_id`='{$_POST["filed_id"]}',
            `subject_title`='{$subj_title}',
            `cover_img_path`='{$_POST["cover_img"]}',
            `subject_content`='{$subj_content}' ,
            subject_aproved={$apr}
            WHERE subject_id={$_POST["subj_id"]}";


            $res=mysqli_query($conn,$query);
            confirm_query($conn,$res);


              if (mysqli_affected_rows($conn)==1){
                // Succes
                redirect("Subject Edited");
              }else{
                // Failed
              redirect("Failed to edit Subject");
              }


 ?>

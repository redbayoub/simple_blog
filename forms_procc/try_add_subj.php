<?php require_once("../includes/session.php") ?>
<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php confirm_Logged_In(); ?>
<?php
  if (isset($_POST["title"])&&isset($_POST["filed_id"])&&isset($_POST["writer"])
    &&isset($_POST["cover_img"])&&isset($_POST["content"])){
      // we have to validate everything hebrev

    }
?>
<?php // i have to validate the url of cover image

?>
<?php
    $subj_title=mysql_prep(htmlspecialchars(strip_tags(trim($_POST["title"]))));
    $subj_content=mysql_prep(strip_tags(nl2br($_POST["content"]),"<p><br><h4><h5><h6><h7><ul><ol><li><table><tr><th><td><a><img><video><b><i>"));
    $subj_writer=mysql_prep($_SESSION["fullname"]);
    $subj_writer_id=$_SESSION["id"];
    $subj_aprov=$_SESSION["approved"];
 ?>
<?php
// add to database
// there is still a work here
$date=date("Y-m-d H:m:s");
    $query="INSERT INTO pro0inter_subjects ( `subject_filed_id`, `subject_title`, `cover_img_path`,
            `subject_content`, `subject_writer_id`, `subject_writer`,
            `subject_date`, `subject_viewes`, `subject_rating`, `subject_aproved`)VALUES(
              '{$_POST["filed_id"]}',
              '{$subj_title}',
              '{$_POST["cover_img"]}',
              '{$subj_content}',
              '$subj_writer_id',
              '{$subj_writer}',
              '{$date}',
              '0',
              '0',
              '{$subj_aprov}'
            )";
            $res=mysqli_query($conn,$query);
            confirm_query($conn,$res);


              if (mysqli_affected_rows($conn)==1){
                // Succes
                $_SESSION["prev"]=true;
                redirect_to("../view.php?subj_id=".mysqli_insert_id($conn));
              }else{
                // Failed
                $msg="Failed to add your subject";
                redirect_to("../add_subj.php?src_page={$_POST["src_page"]}&msg=".urlencode($msg));
              }


 ?>

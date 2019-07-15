<?php require_once("../includes/connection.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php
  $upt_filed_by_nb=$_POST["upt_filed_by_nb"];

  if (isset($_POST["filed_name"])&&($_POST["filed_name"]!="")){
    $new_filed_name=$_POST["filed_name"];
  }

  if (isset($_POST["position"])&&($_POST["position"]!="")){
    $new_position=$_POST["position"];
  }
 ?>

<?php
  $filed_res=get_by_nb("pro0inter_fildes",$upt_filed_by_nb,1,"position","ASC");
  $filed_id=$filed_res["filed_id"];
  $old_pos=$filed_res["position"];
  if (isset($new_filed_name)&&isset($new_position)) {
    if($old_pos>$new_position){
      $query="UPDATE pro0inter_fildes
                SET position=position+1
                WHERE position>={$new_position} AND position<{$old_pos}";
    }elseif ($old_pos<$new_position) {
      $query="UPDATE pro0inter_fildes
                SET position=position-1
                WHERE position>={$old_pos} AND position<={$new_position}";
    }
    mysqli_query($conn,$query);
    confirm_query($conn);

    $query="UPDATE `pro0inter_fildes`
    SET `filed_name`='{$new_filed_name}',`position`='{$new_position}'
    WHERE filed_id={$filed_id}";
    mysqli_query($conn,$query);
    confirm_query($conn);

  } elseif (isset($new_filed_name)) {
    $query="UPDATE `pro0inter_fildes`
    SET `filed_name`='{$new_filed_name}'
    WHERE filed_id={$filed_id}";

    mysqli_query($conn,$query);
    confirm_query($conn);
  }elseif (isset($new_position)) {
    if($old_pos>$new_position){
      $query="UPDATE pro0inter_fildes
                SET position=position+1
                WHERE position>={$new_position} AND position<{$old_pos}";
    }elseif ($old_pos<$new_position) {
      $query="UPDATE pro0inter_fildes
                SET position=position-1
                WHERE position>={$old_pos} AND position<={$new_position}";
    }else{
      redirect_to("../admin.php?opt=fildesManage&msg=1");
    }

    mysqli_query($conn,$query);
    confirm_query($conn);

    $query="UPDATE `pro0inter_fildes`
    SET position='{$new_position}'
    WHERE filed_id={$filed_id}";

    mysqli_query($conn,$query);
    confirm_query($conn);
  }
  // finished

      if (mysqli_affected_rows($conn)==1){
        // Succes
          $msg=urlencode("Filed updated !");
        redirect_to("../admin.php?opt=fildesManage&msg={$msg}");
      }else{
        // Failed
        $msg=urlencode("Failed to update Filed !");
        redirect_to("../admin.php?opt=fildesManage&msg={$msg}");
      }

 ?>

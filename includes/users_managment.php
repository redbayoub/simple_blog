
<table class="table_list">
<tr>
      <th>Username</th>
      <th>Account type</th>
      <th>Firstname</th>
      <th>Surname</th>
      <th>Gender</th>
      <th>Email</th>
      <th>Aproved</th>
      <th>Action</th>
</tr>
<?php
$user_set=get_all_users($_SESSION["approved"]);
$output="";
while ($user_res=mysqli_fetch_assoc($user_set)) {
  if ($_SESSION["id"]!=$user_res["ID"] ){
    $output.= "<tr>".
     "<td>{$user_res["username"]}</td>";
     if($user_res["account_type"]=="A"){
       $output.="<td>Admin</td>";
     }else{
       $output.="<td>Writer</td>";
     }
     $output.= "<td>{$user_res["firstname"]}</td>".
     "<td>{$user_res["surname"]}</td>".
     "<td>{$user_res["gender"]}</td>".
     "<td>{$user_res["email"]}</td>";
    if($user_res["approved"]==1){
      $output.= "<td>Yes</td>
                <td><ul class=\"fileds_nav actions\"><li><a href=\"actions/users_actions.php?op=deapr&sel_user={$user_res["ID"]}\">Unaprove</a></li>";
    }else {
      $output.= "<td>No</td>
                <td><ul class=\"fileds_nav actions\" ><li> <a href=\"actions/users_actions.php?op=apr&sel_user={$user_res["ID"]}\">Aprove</a></li>";
    }
    $output.="<li><a href=\"actions/users_actions.php?op=rm&sel_user={$user_res["ID"]}\" onclick=\"return confirm('Are you sure ?')\">Remove</a></li></ul>";
    $output.="</td></tr>";
  }

}
$output.="</table>";
echo $output;
?>

<h4>Add a new User</h4>

<form action="forms_procc/try_add_user.php" method="post" class="form_general">
      Username : <input type="text" name="username" required maxlength="50"> <br><br>
      Password : <input type="password" name="userpass" required maxlength="16" minlength="8"> <br><br>
      Email : <input type="email" name="email" required> <br><br>
      Firstname : <input type="text" name="firstname" required maxlength="50"> <br><br>
      Surname : <input type="text" name="surname" required maxlength="50"> <br><br>
      Gender : <select name="gender" required>
        <option value="M">Men</option>
        <option value="W">Women</option>
      </select> <br> <br>
      Account Type : <select name="acc_type" required>
        <option value="W" selected>Writer</option>
        <?php if (is_admin(1)) { ?>
            <option value="A">Admin</option>
        <?php } ?>

      </select> <br> <br>
      Image : <input type="url" name="image" value=""><br><br>
      Description: <br><textarea name="descr" maxlength="255" rows="8" cols="80" required></textarea><br><br>
      Approved : <input type="checkbox" name="approved" value=""><br><br>

      <input type="submit" name="add" value="Add User">
</form>

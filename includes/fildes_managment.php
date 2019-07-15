<table class="table_list">
<?php  $fileds_set=get_all("pro0inter_fildes",NUll,"position","ASC"); ?>
<tr>
  <th>N°</th>
      <th>Filed name</th>
      <th>Position</th>
</tr>
<?php
$output="";
$count=1;
while ($filed_res=mysqli_fetch_assoc($fileds_set)) {
  $output.= "<tr>".
   "<td>{$count}</td>".
   "<td>{$filed_res["filed_name"]}</td>".
   "<td>{$filed_res["position"]}</td>".
   "</tr>";
  $count++;
}
$output.="</table>";
echo $output;
?>

<h4>Add a new filed</h4>
<form action="forms_procc/try_add_filed.php" method="post" class="form_general">
      Filed name : <input type="text" name="filed_name" required> <br><br>
      Position : <select name="position" required>
        <?php
          $output="";
          for ($i=1; $i <=$count ; $i++) {
            $output.= "<option value=\"{$i}\">{$i}</option>";
          }
          echo $output;

         ?>
      </select> <br> <br>
      <input type="submit" name="add" value="Add Filed">
</form>

<h4>Update a filed</h4>
<form action="forms_procc/try_upt_filed.php" method="post" class="form_general">
      Select a field to update : <select name="upt_filed_by_nb" required>
        <?php
          $output="";
          for ($i=1; $i <$count ; $i++) {
            $output.= "<option value=\"{$i}\">{$i}</option>";
          }
          echo $output;
    ?> </select><br> <br>

      New Filed name : <input type="text" name="filed_name"> <br><br>
      New Position : <select name="position" >
        <?php
          $output="<option value=\"\"></option>";
          for ($i=1; $i <$count ; $i++) {
            $output.= "<option value=\"{$i}\">{$i}</option>";
          }
          echo $output;

         ?>
      </select> <br> <br>
      <input type="submit" name="upt" value="Update Filed">
</form>

<h4>Remove filed</h4>
<p class="Note">Note: all subjects related to this filed will be delated</p>
<form action="forms_procc/try_remove_filed.php" method="post" onsubmit="return confirm('Are you sure ?')" class="form_general">
      <select name="del_filed_by_nb">
        <?php
        $output="";
        for ($i=1; $i <$count ; $i++) {
          $output.= "<option value=\"{$i}\">{$i}</option>";
        }
        echo $output;

        ?>
      </select>
    <input type="submit" name="remove" value="Remove ">
    </form>

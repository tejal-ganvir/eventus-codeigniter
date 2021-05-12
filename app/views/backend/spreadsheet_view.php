<?php
// We change the headers of the page so that the browser will know what sort of file is dealing with. Also, we will tell the browser it has to treat the file as an attachment which cannot be cached.
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=exceldatausers.xls");
header("Pragma: no-cache");
header("Expires: 0");

$result_click=$this->db->query("select * from contact_click_details");
$row_click=$result_click->result();

?>
<table border='1'>
  <tr>
    <td>Vendor Name</td>
    <td>Visitor Name</td>
    <td>Visitor Email</td>
    <td>Contact number</td>
    <td>Clicks</td>
  </tr>
  <?php 
  for($i=0;$i<count($row_click);$i++)
  {
  ?>
  <?php 
        $result_vendor=$this->db->query("select * from member where id='".$row_click[$i]->vendor_id."'");
        $row_vendor=$result_vendor->result();
        ?>
   <?php 
        $result_user=$this->db->query("select * from member where id='".$row_click[$i]->user_id."'");
        $row_user=$result_user->result();
    ?>
  <?php 
  if(!empty($row_vendor) && !empty($row_user)){
  ?>
  <tr> 	
        <td><?php echo $row_vendor[0]->name;?></td>
        <td><?php echo $row_user[0]->name;?></td>
        <td><?php echo $row_user[0]->email;?></td>
        <td><?php echo $row_user[0]->phone;?></td>
        <td><?php echo $row_click[$i]->clicks;?></td>
  </tr>
  <?php 
  }}
  ?>
</table>
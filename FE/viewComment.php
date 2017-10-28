<?php 
include("connector.php");

$getcommentdata = getcomment(1);
if(!empty($getcommentdata) && is_array($getcommentdata))
{
	foreach ($getcommentdata as $i=>$row) {
		?>
			<h3><?php echo $row['name']?></h3>
			<h6><?php echo $row['date']?></h6>
			<p><?php echo $row['comment']?></p>				
		<?php
	} 
}
else
echo "No Comment";
?>
<?php
include('mysql.php');
$last_msg_id=$_GET['last_msg_id'];
$sql=$dba->query("SELECT * FROM wp_posts WHERE ID<'$last_msg_id' and post_status='publish' ORDER BY ID DESC LIMIT 5");
$last_msg_id="";
while($row=$dba->fetch_array($sql))
{
$msgID= $row['ID'];
$link=$row['post_name'];
$msg= $row['post_title']; 
?>
<div id="<?php echo $msgID; ?>" class="message_box" > 
<a href="http://www.serpito.com/<?php echo $link; ?>"><?php echo $link; ?></a>
</div>
<?php
} 
$dba->close();
?>
<style type="text/css">
*{ margin:0px; padding:0px }
body
{
font-family:'Georgia',Times New Roman, Times, serif;
font-size:18px;
}
.message_box
{
height:auto;
width:600px;
border:solid 1px #48B1D9;
padding:5px ;
}
#panel{
	color:#333;
	background-color:#C8E6E2;
	width:100%;
}
#last_msg_loader
{
text-align: right;
width: 920px;
margin: -125px auto 0 auto;
}
.number
{
float:right;
background-color:#48B1D9;
color:#000;
font-weight:bold;
}
</style>
<?php
include('mysql.php');
$last_msg_id=$_GET['last_msg_id'];
$action=$_GET['action'];

if($action <> "get")
{
?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function()
{
function last_msg_funtion()
{
var ID=$(".message_box:last").attr("id");
$('div#last_msg_loader').html('<img src="wait.gif">');
$.post("scroll.php?action=get&last_msg_id="+ID,

function(data){
if (data != "") {
$(".message_box:last").after(data);
}
$('div#last_msg_loader').empty();
});
};

$(window).scroll(function(){
if ($(window).scrollTop() == $(document).height() - $(window).height()){
last_msg_funtion();
}
});
});
</script>
<title>Serpito.Com - Scroll Load Demo</title>
<div id="panel">
<center><h2>Serpito.com</h2>
	Bu demo <a href="http://www.serpito.com/scroll-down-auto-load-data/">PHP:Jquery: Scroll Down Auto Load Data</a>  icin hazirlanmistir.
</center>
</div>
<?php
//Include load_first.php
$sql=$dba->query("SELECT ID,post_title,post_name FROM wp_posts WHERE post_status='publish' ORDER BY ID DESC LIMIT 25");
while($row=$dba->fetch_array($sql))
{
	$msgID= $row['ID'];
	$msg= $row['post_title'];
	$link=$row['post_name'];
?>
<div id="<?php echo $msgID; ?>" class="message_box" > 
<a href="http://www.serpito.com/<?php echo $link; ?>/"><?php echo $link; ?></a>
</div> 
<?php
} 

?>
	<div id="last_msg_loader"></div>
<?php
}else{
	include('scroll.php'); //include load_second.php
}
$dba->close();
?>
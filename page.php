<?php
require_once("db.php");
if($connection == false){
	echo "Error!";
	echo mysqli_connect_errno();
	exit();
}
$page = $_GET['id'];
$query = mysqli_query($connection, "SELECT * FROM news WHERE id='$page' ");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Документ без названия</title>
</head>
<style>
	h1{
		margin-block-start: 0.0em;
    margin-block-end: 0.0em;
	}
	 html{
        display: flex;
        justify-content: center;
        background:#808080;
    }
	 .news{
        max-width: 1000px;
        padding: 3%;
        background: white;
    }
    .stipple{
        border-width:1px 0px 1px 0px;
border-style:dashed dashed dashed dashed;
border-color:#808080;
    }
    .margin{
        display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    
	}
	</style>
<body>

<div class="news">
<?php 
$article = mysqli_fetch_assoc($query);
	
echo '<h1>'.$article['title'].'</h1><br>';
echo '<div class="stipple	">';
	echo $article['content'].'<br>';
	echo '</div>';
?>
<p> <a href="index%20.php">Все новости &gt;&gt;</a></p>
</div>
    </div>
</body>
</html>


<?php
//ini_set('display_errors', 0);
//ini_set('display_startup_errors', 0);
//error_reporting(E_ALL);
require_once("db.php");
if($connection == false){
	echo "Error!";
	echo mysqli_connect_errno();
	exit();
}
if (isset($_GET['page'])){
	$page = $_GET['page'];
} else {
	$page = 1;
}
$limit = 5;
$number = ($page * $limit) - $limit;
$res_count = mysqli_query($connection, "SELECT COUNT(*) FROM `news` ");
$row = mysqli_fetch_row($res_count);
$total = $row[0];
$str_pag = ceil($total / $limit);

$query = mysqli_query($connection, "SELECT * FROM $dbarticles ORDER BY STR_TO_DATE('idate','d.m.Y' ) ASC LIMIT $number, $limit");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>News</title>
</head>
<style>
   
    	h1{
		margin-block-start: 0.0em;
    margin-block-end: 0.0em;
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
    .margin_page{
        display: flex;
    }
	.art{
	width: 800px;
	}
    .style_date{
        width: 80px;
        color: white;
        background: #9f2b68;
    }
    html{
        display: flex;
        justify-content: center;
        background:#808080;
    }
  a{
    text-decoration: none;
   }
   .style_{
    display: inline-block;
    text-decoration: underline;
   }
   .style_block{
    display: block;
   }
    button{
        width: 40px;
        height: 20px;
        border: 2px double #999999; 
       
    }
    button:hover,
    button:focus,
    button:active {
        color: white;
        background: #9f2b68;
}
    div{
    display: inline-block;
    margin: 5px;
}
	</style>
<body>
<div class="news">
<h1>Новости</h1> 
<div class="stipple">
<?php 
if(mysqli_num_rows($query) == 0){
	echo "Error!";
}	else {
    while($article = mysqli_fetch_assoc($query)){

        echo '<div class="margin">';
        echo '<div class="art">';
        echo '<div class="style_date">'; 
            $date = $article['idate'];
            $formatDate = date("d.m.Y", strtotime($date));
        echo $formatDate;
        echo '</div>';
        echo '<div class="style_">';
        echo ' <a href=page.php?id='.$article['id'].'>'.$article['title'].'</a><br>';
        echo '</div>';
        echo '<div class="style_block">';
        echo $article['announce'].'<br>';
        echo '</div></div></div>'; 
    

}
	} 
?> 
</div>
<h1>Страницы:</h1>    <?
    for ($i = 1; $i <=$str_pag; $i++){
        echo '<div class="style_page">';
    echo "<button >   <a href=index%20.php?page=".$i.">  ".$i."</a> </button>";
    echo '</div>';
}	
	?>
    </div>
    </div>
    
</body>
</html>



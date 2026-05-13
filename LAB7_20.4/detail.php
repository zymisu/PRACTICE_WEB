<?php
include("data.php");

$who = isset($_GET["who"]) ? $_GET["who"] : "";

if(isset($data[$who])){
    $p = $data[$who];
?>
<div class="detail">
    <h1><?php echo $p["name"]; ?></h1>
    <br>
    <img src="<?php echo $p["img"]; ?>" style="width:280px; height:280px; object-fit:cover;">
    <br><br>
    <p><?php echo $p["desc"]; ?></p>
</div>

<?php
}else{
    header("location:index.php");
}
?>
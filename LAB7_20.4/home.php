<?php
include("data.php");

foreach($data as $key => $row){
?>

<div class="box">  
    <a href="index.php?page=detail&who=<?php echo $key; ?>">
        <img src="<?php echo $row["img"]; ?>">
        <br>
        <h3><?php echo $row["name"]; ?></h3>
    </a>
</div>

<?php
}
?>
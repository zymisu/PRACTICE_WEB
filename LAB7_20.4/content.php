<?php

$page = isset($_GET["page"]) ? $_GET["page"] : "home";

if($page=="detail")
    include("detail.php");
else
    include("home.php");

?>
<?php
require_once 'data.php';
$page = $_GET['page'] ?? 'home';
$who  = $_GET['who'] ?? '';
if ($page === 'detail' && !isset($data[$who])) {
    header('Location: index.php?page=home'); exit;
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="referrer" content="no-referrer">
<title>Nhân vật nổi tiếng thế giới</title>
<style>
* { box-sizing:border-box; }
body { margin:0; font-family:Arial,sans-serif; }
#container { width:1000px; margin:0 auto; }
#banner  { height:100px; background:red; }
#homebar { height:30px; background:#ccc; line-height:30px; padding-left:15px; }
#homebar a { color:#000; text-decoration:none; }
#main    { display:flex; }
#left    { width:200px; flex-shrink:0; background:green; padding:10px; min-height:300px; }
#left a  { color:#fff; text-decoration:none; display:block; margin-bottom:5px; }
#content { flex:1; padding:15px; background:#0CF; min-height:300px; overflow:hidden; }
#right   { width:200px; flex-shrink:0; background:orange; min-height:300px; }
#footer  { height:100px; background:#333; }


.box { width:180px; float:left; margin:5px; text-align:center; background:#636; padding:10px; color:#fff;height:220px; }
.box:nth-child(3n+1) { clear:left; }
.box img { width:150px; height:160px; object-fit:cover; border-radius:4px; }
.box h3  { color:yellow; margin:8px 0 0; font-size:15px; }
.box a   { text-decoration:none; }
.detail img { width:280px; height:280px; object-fit:cover; }
</style>
</head>

<body>
<div id="container">
    <div id="banner"></div>
    <div id="homebar"><a href="index.php?page=home">Home</a></div>
    <div id="main">
        <div id="left"><?php include 'lmenu.php'; ?></div>
        <div id="content"><?php include 'content.php'; ?></div>
        <div id="right"></div>
    </div>
    <div id="footer"></div>
</div>
</body>
</html>
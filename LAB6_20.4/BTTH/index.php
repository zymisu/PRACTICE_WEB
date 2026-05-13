<?php
include __DIR__ . "/data.php";
$keys = array_keys($data);
$cag = $_GET['gr'] ?? $keys[0];
if (!array_key_exists($cag, $data)) $cag = $keys[0];
?>
<!DOCTYPE html>
<html>
<head>
    <title>BÀI TẬP TỔNG HỢP</title>

    <style>
        body {
            margin: 0;
            background: #e6e6e6; /* nền xám ngoài */
            font-family: Arial;
        }
        /* KHUNG CHÍNH */
        .wrapper {
            width: 1000px;
            margin: auto;
            background: white;
        }
        .banner {
            height: 140px;
            background: #3c8dbc;
        }
        .menu {
            height: 35px;
            background: red;
        }
        .container {
            display: flex;
        }

        /* MENU TRÁI */
        .left {
            width: 180px;
            background: #f4c266;
            padding: 10px;
        }
        .left ul {
            padding-left: 20px;
            margin: 0;
        }
        .left li {
            margin: 5px 0;
        }

        /* CONTENT */
        .content {
            flex: 1;
            background: #ccc;
            padding: 10px;
        }
        .footer {
            height: 150px;
            background: #0f9960;
        }
        .company {
            margin-bottom: 10px;
        }
        .company-title {
            background: #0b3a66;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
        }
        .products {
            display: flex;
            gap: 10px;
            padding: 10px;
            background: #bfbfbf;
        }
        .item {
            background: #3b3b6d;
            color: white;
            padding: 8px 15px;
            min-width: 100px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="wrapper">
    <div class="banner"></div>
    <div class="menu"></div>

    <div class="container">
        <div class="left">
            <?php include "lmenu.php"; ?>
        </div>

        <div class="content">
            <?php include "content.php"; ?>
        </div>
    </div>

    <div class="footer"></div>
</div>

</body>
</html>
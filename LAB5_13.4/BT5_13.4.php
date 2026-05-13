<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Lab 05</title>
<style>
body { font-family: Arial; }
table {
    border-collapse: collapse;
    margin-bottom: 20px;
}
th, td {
    border: 1px solid black;
    padding: 5px;
    text-align: center;
    width:100px;
}
.random-table td{
    width:40px;
}

/* BIỂU ĐỒ */
.chart {
    width: 700px;
}
.row {
    display: flex;
    align-items: center;
    margin: 6px 0;
}
.label {
    width: 80px;
    text-align: right;
    margin-right: 10px;
}
.bar-container {
    flex: 1;
    background: #eee;
}
.bar {
    height: 30px;
    background: linear-gradient(45deg,#6c63ff,#7b6ee6);
}
.value {
    width: 40px;
    margin-left: 10px;
}
</style>
</head>

<body>
<h2>Câu 1: Tổng S = 1+2+…+n</h2>
<?php
$n = 100;
$sum = $n * ($n + 1) / 2;
?>
<p>S (n = 100) = <?= $sum ?></p>

<h2>Câu 2: Bộ ba Pythagore < 20</h2>
<table>
<tr>
<th>a</th>
<th>b</th>
<th>c</th>
</tr>
<?php
for ($a = 1; $a < 20; $a++) {
    for ($b = $a; $b < 20; $b++) {
        for ($c = $b; $c < 20; $c++) {
            if ($a*$a + $b*$b == $c*$c) {
                echo "<tr>
                        <td>$a</td>
                        <td>$b</td>
                        <td>$c</td>
                      </tr>";
            }
        }
    }
}
?>
</table>

<h2>Câu 3: Sinh 1000 số ngẫu nhiên < 99</h2>
<table class="random-table">
<tr>
<?php
$data = [];
for ($i = 1; $i <= 1000; $i++) {
    $num = rand(1, 98);
    $data[] = $num;
    echo "<td>$num</td>";
    if (($i) % 50 == 0) {
        echo "</tr><tr>";
    }
}
?>
</tr>
</table>

<h2>Câu 4: Thống kê</h2>
<?php
$tanso = [];
for ($i = 0; $i < 10; $i++) {
    if ($i == 0) {
        $start = 1;
        $end = 9;
    } else {
        $start = $i * 10;
        $end = $start + 9;
    }

    $tanso["$start-$end"] = 0;
}
foreach ($data as $n) {
    if ($n <= 9) {
        $key = "1-9";
    } else {
        $start = floor($n / 10) * 10;
        $end = $start + 9;
        $key = "$start-$end";
    }
    $tanso[$key]++;
}

$mean = array_sum($data) / count($data);

$variance = 0;
foreach ($data as $n) {
    $variance += pow($n - $mean, 2);
}
$variance /= count($data);
?>

<p>Mean: <?= round($mean,2) ?></p>
<p>Variance: <?= round($variance,2) ?></p>
<table>
<tr>
<th>Khoảng</th>
<th>Tần số</th>
</tr>
<?php
foreach ($tanso as $khoang => $soLan) {
    echo "<tr>
            <td>$khoang</td>
            <td>$soLan</td>
          </tr>";
}
?>
</table>

<h3>Biểu đồ tần số</h3>
<?php $max = max($tanso); ?>
<div class="chart">
<?php
foreach ($tanso as $khoang => $soLan) {
    $width = ($soLan / $max) * 500; //Tỉ lệ chiều rộng
    echo "<div class='row'>
    <span class='label'>$khoang</span>
    <div class='bar-container'>
    <div class='bar' style='width: {$width}px'></div>
    </div>
    <span class='value'>$soLan</span>
</div>";
}
?>
</div>
</body>
</html>
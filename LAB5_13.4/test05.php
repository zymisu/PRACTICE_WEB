<?php
// ============================================================
// 1. CÁC HÀM
// ============================================================

// Tính S = 1 + 2 + ... + 100
function tinhTong($n) {
    $s = 0;
    for ($i = 1; $i <= $n; $i++) $s += $i;
    return $s;
}

// Liệt kê bộ ba Pythagore nhỏ hơn 20
function pythagore($max) {
    $result = [];
    for ($a = 1; $a <= $max; $a++)
        for ($b = $a; $b <= $max; $b++)
            for ($c = $b; $c <= $max; $c++)
                if ($a*$a + $b*$b == $c*$c)
                    $result[] = [$a, $b, $c];
    return $result;
}

// Sinh 1000 số ngẫu nhiên nhỏ hơn 99
function sinhNgauNhien() {
    $arr = [];
    for ($i = 0; $i < 1000; $i++)
        $arr[] = rand(0, 98);
    return $arr;
}

// Thống kê: tần số theo khoảng, mean, variance
function thongKe($arr) {
    $tanso = [];
    for ($start = 0; $start < 99; $start += 10) {
        $end = min($start + 9, 98);
        $dem = 0;
        foreach ($arr as $n)
            if ($n >= $start && $n <= $end) $dem++;
        $tanso["$start-$end"] = $dem;
    }

    $mean     = array_sum($arr) / count($arr);
    $variance = array_sum(array_map(fn($n) => ($n - $mean) ** 2, $arr)) / count($arr);

    return ['tanso' => $tanso, 'mean' => round($mean, 2), 'variance' => round($variance, 2)];
}

// ============================================================
// 2. CHẠY CÁC HÀM
// ============================================================
$tong    = tinhTong(100);
$pyth    = pythagore(20);
$so      = sinhNgauNhien();
$tk      = thongKe($so);
$maxFreq = max($tk['tanso']);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="UTF-8">
<title>Lab 05</title>
<style>
    body { font-family: monospace; background: #111; color: #eee; padding: 2rem; }
    h2   { color: #00e5a0; margin: 2rem 0 .8rem; }

    /* Bảng dùng div + CSS (không dùng table) */
    .bang        { display: grid; gap: 2px; max-width: 500px; }
    .hang        { display: grid; gap: 2px; }
    .hang > div  { background: #1e1e2e; padding: .4rem .8rem; }
    .dau         { background: #252540 !important; color: #aaa; font-weight: bold; }
    .col3        { grid-template-columns: repeat(3, 1fr); }
    .col2        { grid-template-columns: 1fr 2fr; }

    /* Biểu đồ bar */
    .bieudo      { display: flex; align-items: flex-end; gap: 4px; height: 180px; margin-top: 1rem; }
    .cot         { display: flex; flex-direction: column; align-items: center; flex: 1; }
    .thanh       { width: 100%; background: #7c6fff; border-radius: 3px 3px 0 0; }
    .nhan        { font-size: .6rem; color: #888; margin-top: 3px; }
    .solan       { font-size: .65rem; color: #aaa; margin-bottom: 2px; }

    /* Stat box */
    .statrow     { display: flex; gap: 1rem; }
    .stat        { background: #1e1e2e; padding: 1rem 1.5rem; border-radius: 8px; }
    .stat small  { color: #888; display: block; margin-bottom: .3rem; }
    .stat span   { font-size: 1.6rem; color: #7c6fff; }
</style>
</head>
<body>

<h1 style="color:#00e5a0">Lab 05 – PHP</h1>

<!-- KẾT QUẢ 1: TỔNG S -->
<h2>1. Tổng S = 1+2+…+100</h2>
<div class="statrow">
    <div class="stat"><small>S =</small><span><?= $tong ?></span></div>
</div>

<!-- KẾT QUẢ 2: PYTHAGORE -->
<h2>2. Bộ ba Pythagore &lt; 20 (<?= count($pyth) ?> bộ)</h2>
<div class="bang">
    <div class="hang col3">
        <div class="dau">a</div><div class="dau">b</div><div class="dau">c</div>
    </div>
    <?php foreach ($pyth as [$a, $b, $c]): ?>
    <div class="hang col3">
        <div><?= $a ?></div><div><?= $b ?></div><div><?= $c ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- KẾT QUẢ 3: MEAN & VARIANCE -->
<h2>3. Mean & Variance (1000 số ngẫu nhiên)</h2>
<div class="statrow">
    <div class="stat"><small>Mean</small><span><?= $tk['mean'] ?></span></div>
    <div class="stat"><small>Variance</small><span><?= $tk['variance'] ?></span></div>
</div>

<!-- BẢNG TẦN SỐ -->
<h2>4. Tần số theo khoảng</h2>
<div class="bang">
    <div class="hang col2">
        <div class="dau">Khoảng</div><div class="dau">Tần số</div>
    </div>
    <?php foreach ($tk['tanso'] as $khoang => $f): ?>
    <div class="hang col2">
        <div><?= $khoang ?></div><div><?= $f ?></div>
    </div>
    <?php endforeach; ?>
</div>

<!-- BIỂU ĐỒ BAR -->
<h2>5. Biểu đồ tần số</h2>
<div class="bieudo">
    <?php foreach ($tk['tanso'] as $khoang => $f):
        $cao = round($f / $maxFreq * 150); // chiều cao tỉ lệ với tần số lớn nhất
    ?>
    <div class="cot">
        <div class="solan"><?= $f ?></div>
        <div class="thanh" style="height:<?= $cao ?>px"></div>
        <div class="nhan"><?= $khoang ?></div>
    </div>
    <?php endforeach; ?>
</div>

</body>
</html>
<?php
include __DIR__ . "/data.php";

$keys = array_keys($data);

// lấy giá trị gr (nếu không có thì lấy mặc định)
$gr = $_GET['gr'] ?? $keys[0];

// nếu sai thì fallback
if (!array_key_exists($gr, $data)) {
    $gr = $keys[0];
}
?>

<?php foreach ($data[$gr] as $company => $products): ?>
    <div class="company">
        <div class="company-title"><?php echo $company; ?></div>

        <div class="products">
            <?php foreach ($products as $p): ?>
                <div class="item"><?php echo $p; ?></div>
            <?php endforeach; ?>
        </div>
    </div>
<?php endforeach; ?>
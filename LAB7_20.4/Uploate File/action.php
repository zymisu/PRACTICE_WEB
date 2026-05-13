<?php
include "file_module.php";

$dir = "./_files/";
$msg = "";
$f   = $_GET['file_chon'] ?? "data.txt";

if (isset($_POST['action'])) {
    $f    = !empty($_POST['fname']) ? $_POST['fname'] : $f;
    $fnew = $_POST['fnew'];
    $path = $dir . $f;

    switch ($_POST['action']) {
        case "Lưu":
            luuTapTinVanBan($path, $_POST['data'])
                ? $msg = "<div class='rb ok'>✓ Đã lưu <b>$f</b>.</div>"
                : null;
            break;
        case "Xóa":
            if (xoaTapTin($path)) {
                $msg = "<div class='rb fail'>✗ Đã xóa <b>$f</b>.</div>";
                $f   = "";
            }
            break;
        case "Đổi Tên":
        case "Di Chuyển":
            if (!empty($fnew) && doiTenTapTin($path, $dir . $fnew)) {
                $msg = "<div class='rb ok'>✓ Đổi tên thành <b>$fnew</b>.</div>";
                $f   = $fnew;
            } else {
                $msg = "<div class='rb fail'>✗ Nhập tên mới để thực hiện!</div>";
            }
            break;
    }
}

$content = docTapTinVanBan($dir . $f);
?>
<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Quản Lý Tập Tin</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f2faf4; font-family:'Segoe UI',sans-serif; }
.wrap { background:#fff; border-radius:10px; border:1px solid #d0ead8; padding:36px 40px; }
.ttl  { font-size:1.1rem; font-weight:700; color:#3a9a5c; text-transform:uppercase; letter-spacing:.05em; margin-bottom:4px; }
.sub  { font-size:.82rem; color:#aaa; margin-bottom:20px; }
.back { font-size:.83rem; color:#5cb87a; text-decoration:none; font-weight:600; border-bottom:1px solid #a8d8b8; }
.back:hover { color:#3a9a5c; }
hr   { border:none; border-top:1px solid #eee; margin:18px 0; }
.lbl { font-size:.78rem; font-weight:700; color:#777; text-transform:uppercase; letter-spacing:.04em; margin-bottom:5px; }
.fi  { width:100%; padding:9px 13px; font-size:.9rem; border:1px solid #d0ead8; border-radius:7px; background:#f9fdf9; color:#444; outline:none; }
.fi:focus  { border-color:#5cb87a; }
.fi:disabled { background:#f3f3f3; color:#999; }
textarea.fi { border-style:dashed; font-family:'Courier New',monospace; resize:vertical; }
textarea.fi:focus { border-style:solid; border-color:#5cb87a; }
.b1 { background:#5cb87a; color:#fff; border:none; border-radius:7px; padding:9px 24px; font-size:.88rem; font-weight:600; cursor:pointer; }
.b1:hover { background:#3a9a5c; }
.b2 { background:none; border:1px solid #f0b429; border-radius:7px; padding:9px 20px; font-size:.88rem; font-weight:600; color:#b07d00; cursor:pointer; }
.b2:hover { background:#fffbeb; }
.b3 { background:none; border:1px solid #f5c6cb; border-radius:7px; padding:9px 20px; font-size:.88rem; font-weight:600; color:#c0392b; cursor:pointer; }
.b3:hover { background:#fff5f5; }
.rb  { border-radius:7px; padding:11px 15px; font-size:.88rem; margin-bottom:18px; }
.ok  { background:#f2faf4; border:1px solid #c0e4cb; color:#2e7d4f; }
.fail{ background:#fff5f5; border:1px solid #f5c6cb; color:#c0392b; }
</style>
</head>
<body>
<div class="container mt-5 mb-5">
<div class="row justify-content-center">
<div class="col-lg-7 col-md-9">

  <div class="mb-3"><a href="index.php" class="back">← Quay lại Upload</a></div>

  <div class="wrap">
    <div class="ttl">Quản lý tập tin</div>
    <div class="sub">Đọc, lưu, đổi tên hoặc xóa tập tin trên máy chủ.</div>

    <?= $msg ?>
    <hr>

    <form method="post">
      <div class="row g-3 mb-3">
        <div class="col-md-6">
          <div class="lbl">File đang thao tác</div>
          <input class="fi" type="text" value="<?= htmlspecialchars($f) ?>" disabled>
          <input type="hidden" name="fname" value="<?= htmlspecialchars($f) ?>">
        </div>
        <div class="col-md-6">
          <div class="lbl">Tên mới (Đổi Tên)</div>
          <input class="fi" type="text" name="fnew" placeholder="VD: data_moi.txt">
        </div>
      </div>

      <div class="mb-4">
        <div class="lbl">Nội dung văn bản</div>
        <textarea class="fi" name="data" rows="9"><?= htmlspecialchars($content) ?></textarea>
      </div>

      <div class="d-flex gap-2">
        <button class="b1" name="action" value="Lưu">Lưu</button>
        <button class="b2" name="action" value="Đổi Tên">Đổi Tên</button>
        <button class="b3" name="action" value="Xóa">Xóa</button>
      </div>
    </form>
  </div>

</div>
</div>
</div>
</body>
</html>
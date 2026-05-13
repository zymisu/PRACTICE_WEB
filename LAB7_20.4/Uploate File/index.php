<!DOCTYPE html>
<html lang="vi">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Upload File</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background:#f2faf4; font-family:'Segoe UI',sans-serif; min-height:100vh; display:flex; align-items:center; }
.wrap { background:#fff; border-radius:10px; border:1px solid #d0ead8; padding:36px 40px; }
.ttl  { font-size:1.1rem; font-weight:700; color:#3a9a5c; text-transform:uppercase; letter-spacing:.05em; margin-bottom:4px; }
.sub  { font-size:.82rem; color:#aaa; margin-bottom:22px; }
hr    { border:none; border-top:1px solid #eee; margin:18px 0; }
.lbl  { font-size:.78rem; font-weight:700; color:#777; text-transform:uppercase; letter-spacing:.04em; margin-bottom:6px; }
input[type=file] { display:block; width:100%; padding:10px 13px; font-size:.9rem; border:1px dashed #a8d8b8; border-radius:7px; background:#f9fdf9; color:#444; cursor:pointer; outline:none; }
input[type=file]:hover { border-color:#5cb87a; }
.b1 { background:#5cb87a; color:#fff; border:none; border-radius:7px; padding:10px 28px; font-size:.9rem; font-weight:600; cursor:pointer; transition:background .2s; }
.b1:hover { background:#3a9a5c; }
.b2 { background:none; border:1px solid #ddd; border-radius:7px; padding:10px 20px; font-size:.9rem; color:#888; cursor:pointer; transition:.2s; }
.b2:hover { border-color:#aaa; color:#555; }
.rb  { border-radius:7px; padding:13px 16px; font-size:.88rem; margin-bottom:20px; }
.ok  { background:#f2faf4; border:1px solid #c0e4cb; color:#2e7d4f; }
.ok td:first-child { font-weight:600; color:#3a9a5c; width:110px; }
.ok table { width:100%; border-collapse:collapse; margin-top:8px; }
.ok td { padding:3px 0; color:#444; }
.ok a { display:inline-block; margin-top:10px; font-size:.82rem; color:#5cb87a; font-weight:600; border-bottom:1px solid #a8d8b8; text-decoration:none; }
.ok a:hover { color:#3a9a5c; }
.fail{ background:#fff5f5; border:1px solid #f5c6cb; color:#c0392b; font-weight:600; text-align:center; }
</style>
</head>
<body>
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6 col-lg-5">
<div class="wrap">
  <div class="ttl">Upload File</div>
  <div class="sub">Chọn file từ máy tính và xác nhận để tải lên máy chủ.</div>

  <?php if (isset($_GET['msg'])): ?>
    <?php if ($_GET['msg'] == 'done' && isset($_GET['ten'], $_GET['kichthuoc'], $_GET['mime'])): ?>
      <?php $f = htmlspecialchars($_GET['ten']); ?>
      <div class="rb ok">
        <b>✓ Upload thành công</b>
        <table>
          <tr><td>Tên file</td><td><?= $f ?></td></tr>
          <tr><td>Kích thước</td><td><?= htmlspecialchars($_GET['kichthuoc']) ?> bytes</td></tr>
          <tr><td>Định dạng</td><td><?= htmlspecialchars($_GET['mime']) ?></td></tr>
        </table>
        <a href="action.php?file_chon=<?= $f ?>">→ Quản lý file này</a>
      </div>
    <?php else: ?>
      <div class="rb fail">✗ Upload không thành công. Vui lòng thử lại.</div>
    <?php endif; ?>
  <?php endif; ?>

  <hr>

  <form method="post" action="xuly.php" enctype="multipart/form-data">
    <div class="lbl">Chọn tập tin</div>
    <input type="file" name="uploadfile" required>
    <div class="d-flex gap-2 mt-4">
      <button class="b1" type="submit">Xác nhận</button>
      <button class="b2" type="reset">Hủy</button>
    </div>
  </form>
</div>
</div>
</div>
</div>
</body>
</html>
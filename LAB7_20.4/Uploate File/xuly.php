<?php
require_once 'upload_module.php';

$TMChuaFileUpload = "uploads/"; // thư mục chứa file upload (phải tồn tại trên server)

// Tạo thư mục nếu chưa có
if (!is_dir($TMChuaFileUpload)) {
    mkdir($TMChuaFileUpload, 0777, true);
}

$filename       = "";
$result_upload  = uploadFileTo($TMChuaFileUpload, $filename);

if ($result_upload) {
    // Upload thành công → gửi thông tin file về index.php
    $fullpath  = $TMChuaFileUpload . $filename;
    $kichthuoc = filesize($fullpath);               // kích thước (byte)
    $mime      = mime_content_type($fullpath);      // loại file

    header("Location: index.php?msg=done"
         . "&ten="       . urlencode($filename)
         . "&kichthuoc=" . $kichthuoc
         . "&mime="      . urlencode($mime));
} else {
    // Upload thất bại
    header("Location: index.php?msg=fail");
}
exit;
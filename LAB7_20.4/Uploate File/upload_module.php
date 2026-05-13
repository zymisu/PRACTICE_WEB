<?php
// ==========================================
// HÀM 1: UPLOAD VÀ GIỮ NGUYÊN TÊN FILE GỐC
// Lý thuyết: Viết hàm để tái sử dụng code nhiều lần thay vì viết lại từ đầu.
// Tham số &$ten_tap_tin_cu có dấu '&' (tham chiếu) nghĩa là: nếu bên trong hàm này cái tên file bị thay đổi, thì biến đó ở ngoài hàm cũng bị đổi theo.
// ==========================================
function uploadFileTo($thu_muc_tai_len, &$ten_tap_tin_cu) {
    
    // $_FILES là mảng siêu toàn cục của PHP tự sinh ra khi form có gửi file.
    // ['uploadfile'] là tên (name) của ô chọn file trong HTML.
    // ['tmp_name'] là đường dẫn của thư mục TẠM THỜI trên máy chủ đang giam giữ file này.
    $tap_tin_tam = $_FILES['uploadfile']['tmp_name'];
    
    // ['name'] lấy ra tên gốc của file trên máy tính người dùng (VD: hinh.png).
    $ten_tap_tin_cu = $_FILES['uploadfile']['name'];
    
    // move_uploaded_file() là hàm cốt lõi nhất. Ý nghĩa: Dời file từ chỗ tạm ($tap_tin_tam) 
    // sang nhà mới ($thu_muc_tai_len nối với tên gốc). Trả về true nếu thành công, false nếu xịt.
    return move_uploaded_file($tap_tin_tam, $thu_muc_tai_len . $ten_tap_tin_cu);
}

// ==========================================
// HÀM 2: UPLOAD VÀ ĐỔI THÀNH TÊN MỚI
// Ý nghĩa: Tương tự hàm 1, nhưng ta tự truyền cái tên mới vào chứ không xài tên gốc nữa.
// ==========================================
function uploadAndRenameFile($thu_muc_tai_len, $ten_tap_tin_moi) {
    $tap_tin_tam = $_FILES['uploadfile']['tmp_name'];
    
    // Lưu thẳng vào thư mục đích với cái tên mới mà người dùng nhập vào.
    return move_uploaded_file($tap_tin_tam, $thu_muc_tai_len . $ten_tap_tin_moi);
}
?>
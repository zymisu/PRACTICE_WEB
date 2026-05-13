<?php
// LÝ THUYẾT CHUNG: Khối try { ... } catch { ... } dùng để bắt lỗi. 
// Nếu code trong ngoặc 'try' bị lỗi (ví dụ file bị xóa mất rồi không tìm thấy), nó sẽ tự nhảy vào 'catch' báo false chứ không làm sập (crash) toàn bộ trang web.

// ==========================================
// HÀM ĐỌC FILE
// ==========================================
function docTapTinVanBan($ten_tap_tin) {
    try {
        if (!file_exists($ten_tap_tin)) return ""; // file_exists kiểm tra file có tồn tại không.
        
        // fopen() mở file ra. Chế độ "r+" là quyền Read (Chỉ đọc). Trả về một kết nối ($trinh_xu_ly).
        $trinh_xu_ly = fopen($ten_tap_tin, "r+");
        $kich_thuoc = filesize($ten_tap_tin);
        
        // fread() quét đọc nội dung bên trong file với độ dài bằng đúng kích thước của file.
        $noi_dung = ($kich_thuoc > 0) ? fread($trinh_xu_ly, $kich_thuoc) : "";
        
        // fclose() đóng kết nối lại để giải phóng bộ nhớ. Rất quan trọng!
        fclose($trinh_xu_ly);
        return $noi_dung;
    } catch(Exception $e) { return false; }
}

// ==========================================
// HÀM GHI (LƯU) FILE
// ==========================================
function luuTapTinVanBan($ten_tap_tin, $noi_dung) {
    try {
        // Chế độ "w+" (Write): Mở ra để ghi. Nếu file chưa có thì nó tự tạo file mới. 
        // Nếu file có rồi thì xóa sạch chữ cũ để chuẩn bị ghi chữ mới.
        $trinh_xu_ly = fopen($ten_tap_tin, "w+");
        
        // fwrite() bơm cái $noi_dung mới vào thẳng trong file.
        fwrite($trinh_xu_ly, $noi_dung);
        fclose($trinh_xu_ly); // Ghi xong thì đóng sổ.
        return true;
    } catch(Exception $e) { return false; }
}

// ==========================================
// HÀM ĐỔI TÊN / DI CHUYỂN
// ==========================================
function doiTenTapTin($ten_tap_tin, $ten_moi) {
    try { 
        // rename() là hàm có sẵn của PHP, không cần mở file ra, đổi tên cái rụp trực tiếp ở ngoài ổ cứng.
        return rename($ten_tap_tin, $ten_moi); 
    } 
    catch(Exception $e) { return false; }
}

// ==========================================
// HÀM XÓA FILE
// ==========================================
function xoaTapTin($ten_tap_tin) {
    try { 
        // unlink() là hàm xóa vĩnh viễn tệp tin đó khỏi máy chủ (không vào thùng rác).
        return unlink($ten_tap_tin); 
    } 
    catch(Exception $e) { return false; }
}
?>
<?php
$str = "  Hello PHP World  ";

// 1. Độ dài xâu
echo "Length: " . strlen($str) . "<br>";

// 2. Chữ thường
echo "Lower: " . strtolower($str) . "<br>";

// 3. Chữ hoa
echo "Upper: " . strtoupper($str) . "<br>";

// 4. Cắt chuỗi
echo "Substr: " . substr($str, 2, 5) . "<br>";

// 5. Tách chuỗi
$arr = explode(" ", trim($str));
echo "Explode: ";
print_r($arr);
echo "<br>";

// 6. Đếm từ
echo "Word count: " . str_word_count($str) . "<br>";

// 7. Cắt bỏ khoảng trắng thừa
echo "Trim: '" . trim($str) . "'<br>";

// 8. Định dạng số
echo number_format(1234567.891, 2);    // 1,234,567.89
 
// 9. So sánh xâu
echo strcmp("abc", "abc");          // 0 (bằng nhau)
echo strcmp("abc", "xyz");         // âm (abc < xyz)
echo strcasecmp("ABC", "abc");    // 0 (không phân biệt hoa/thường)
?>
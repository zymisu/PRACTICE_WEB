<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <title>Captcha Demo</title>
    <style>
        body { margin: 0; background: #e6e6e6; font-family: Arial; }
        .wrapper {
            width: 600px; margin: 60px auto; background: white;
            padding: 30px; border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.15);
        }
        h2 {
            background: #3c8dbc; color: white;
            margin: -30px -30px 25px -30px;
            padding: 15px 30px; border-radius: 6px 6px 0 0;
        }
        .captcha-box { display: flex; align-items: center; gap: 15px; margin-bottom: 15px; }
        .captcha-box img { border: 1px solid #ccc; cursor: pointer; }
        .captcha-box small { color: #888; font-size: 12px; }
        input[type="text"] {
            width: 100%; padding: 8px 10px; box-sizing: border-box;
            border: 1px solid #ccc; border-radius: 4px;
            font-size: 15px; margin-bottom: 15px;
        }
        button {
            background: #3c8dbc; color: white; border: none;
            padding: 10px 25px; border-radius: 4px;
            font-size: 15px; cursor: pointer;
        }
        button:hover { background: #2e6d94; }
        .result { margin-top: 15px; padding: 10px; border-radius: 4px; font-weight: bold; }
        .ok  { background: #dff0d8; color: #3c763d; }
        .err { background: #f2dede; color: #a94442; }
    </style>
</head>
<body>
<div class="wrapper">
    <h2>Kĩ Thuật Tạo Captcha</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $input   = trim($_POST['captcha_input'] ?? '');
        $correct = $_SESSION['captcha'] ?? '';
        if (strcasecmp($input, $correct) === 0) {
            echo '<div class="result ok">✔ Captcha đúng!</div>';
        } else {
            echo '<div class="result err">✘ Captcha sai, vui lòng thử lại.</div>';
        }
    }
    ?>

    <form method="post">
        <p>Nhập lại mã bên dưới:</p>
        <div class="captcha-box">
            <img src="captcha.php?r=<?php echo rand(); ?>"
                 width="200" height="50"
                 title="Click để tải lại"
                 onclick="this.src='captcha.php?r='+Math.random()">
            <small>(click ảnh để tải lại)</small>
        </div>
        <input type="text" name="captcha_input" placeholder="Nhập captcha..." autocomplete="off">
        <button type="submit">Xác nhận</button>
    </form>
</div>
</body>
</html>
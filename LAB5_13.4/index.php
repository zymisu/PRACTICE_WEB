<html>  
    <body>
        <?php
            $a = "Nam";
            $b = "Bình";
            $c = "Minh";
            $i = 1;
        ?>
        <table>
            <thead>
                <tr>
                    <td>STT</td>
                    <td>Tên</td>
                </tr>
            </head>
            <tbody>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $a; ?></td>
                </tr>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $b; ?></td>
                </tr>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php echo $c; ?></td>
                </tr>
        </table>
    </body>
</html>

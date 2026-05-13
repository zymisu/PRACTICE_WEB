<?php
include __DIR__ . "/data.php";
?>

<ul>
<?php foreach ($data as $menuitem => $value): ?>
    <li><a href="index.php?gr=<?php echo $menuitem; ?>"><?php echo $menuitem; ?></a></li>
<?php endforeach; ?>
</ul>

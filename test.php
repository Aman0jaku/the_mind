<?php $flag=1; ?>
<form action=<?php if($flag){print'test1.php';}else{print'test2.php';} ?> method="post">
 <input type="submit" value="テスト">
</form>

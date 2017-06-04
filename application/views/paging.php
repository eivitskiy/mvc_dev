<?php
    $url = $_SERVER['REQUEST_URI'];
    $sign = (preg_match('/\?/', $url) ? '&' : '?');

    $current = (isset($_GET['page']) ? $_GET['page'] : 1);
    $min = ($current > 3 ? ($current-3) : 1);
    $max = (($page_count - $current) > 3 ? ($current+3) : $page_count)
?>

<ul class="pagination">
    <li><a href="<?=$url.$sign?>page=1">«</a></li>

    <? for($i = $min; $i <= $max; $i++): ?>
    <li class="<?=($i==$current ? 'active' : '')?>"><a href="<?=$url.$sign?>page=<?=$i?>"><?=$i?></a></li>
    <? endfor ?>

    <li><a href="<?=$url.$sign?>page=<?=$page_count?>">»</a></li>
</ul>
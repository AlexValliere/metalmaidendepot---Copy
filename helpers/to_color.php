<?php
function to_color($n) {
    $n = crc32($n);
    $n &= 0xffffffff;
    return("#".substr("000000".dechex($n),-6));
}
?>
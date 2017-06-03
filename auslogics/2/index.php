<?php

function duplicate_value($array) {
    return array_search(2, array_count_values($array));
}

?>

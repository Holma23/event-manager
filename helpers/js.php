<?php
function redirectJs($page){
    echo "<script>";
    echo sprintf(
        "document.location.href='%s'",
        $page
    );
    echo "</script>";
}
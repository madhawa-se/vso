<?php
$zip = new ZipArchive;
if ($zip->open('villamykonosaquapearl.zip') === TRUE) {
    $zip->extractTo('/');
    $zip->close();
    echo 'ok';
} else {
    echo 'failed';
}
?>
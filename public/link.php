<?php
$targetFolder = __DIR__ . '/../storage/app/public';
$linkFolder = __DIR__ . '/storage';
if(symlink($targetFolder, $linkFolder)) {
    echo "Storage berhasil di-link!";
} else {
    echo "Gagal atau sudah pernah di-link.";
}
?>
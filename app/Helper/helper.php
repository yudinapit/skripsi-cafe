<?php

use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

function uploadImage($image, $path, $old_path = null) {
    if ($image) {
        if (file_exists($old_path)) {
            unlink($old_path);
        }

        $image_name = date('YmdHis').'.'.$image->extension();
        $url = $path.$image_name;

        if (!File::isDirectory(public_path($path))) {
            File::makeDirectory(public_path($path), 0777, true, true);
        }

        Image::make($image)->save(public_path($path).$image_name);

        return $url;
    }
}

function getStatusOrder($order) {
    $badge = '';
    $status = '';
    switch($order) {
        case 1 :
            $status = 'Belum Diproses';
            $badge = 'primary';
            break;
        case 2 :
            $status = 'Sudah Diproses';
            $badge = 'secondary';
            break;
        case 3 :
            $status = 'Dibayar';
            $badge = 'success';
            break;
        case 4  :
            $status = 'Selesai';
            $badge = 'dark';
            break;
        case 5 :
            $status = 'Cancel';
            $badge = 'danger';
            break;
    }

    return "<span class='badge badge-$badge'>$status</span>";
}

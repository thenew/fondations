<?php

add_filter('jpeg_quality', 'fon_jpeg_quality');
function fon_jpeg_quality($arg) {
    return FON_JPEG_QUALITY;
}
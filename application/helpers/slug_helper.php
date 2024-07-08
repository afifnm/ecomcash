<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('create_slug')) {
    function create_slug($string) {
        // Mengubah string menjadi huruf kecil
        $slug = strtolower($string);
        
        // Menghapus karakter yang tidak diperlukan
        $slug = preg_replace('/[^a-z0-9\s-]/', '', $slug);
        
        // Mengganti spasi dengan tanda hubung
        $slug = preg_replace('/[\s-]+/', '-', $slug);
        
        // Menghapus tanda hubung ganda
        $slug = preg_replace('/-+/', '-', $slug);
        
        // Menghapus tanda hubung di awal dan akhir string
        $slug = trim($slug, '-');
        
        return $slug;
    }
}

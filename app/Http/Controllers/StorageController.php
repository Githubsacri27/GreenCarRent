<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class StorageController extends Controller
{
     /**
     * Guardar una imagen dentro del sistema de archivos
     */
    public static function storeImage($file, $name, $dir) {
        $filename = $name . "." . $file->getClientOriginalExtension();
        $foto = $file->storeAs($dir, $filename , 'public');
        return  "storage/" . $foto;
    }


    /**
     * Actualizar la imagen dentro del sistema de archivos.
     */
    public static function updateImage($file, $name, $dir) {
        self::findAndDeleteImage($name, $dir);
        return self::storeImage($file, $name, $dir);
    }


    /**
     * Busca y elimina una imagen dentro del sistema de archivos independientemente de su extensión.
     */
    public static function findAndDeleteImage($name, $dir) {
        $pattern = "storage/" . $dir . "/" . $name . ".*";
        $searchResult = File::glob($pattern);
        if (! empty($searchResult)) {
            File::delete($searchResult[0]);
        }
    }


    /**
     * Eliminar un directorio dentro del sistema de archivos
     */
    public static function deleteDirectory($dir) {
        if (File::exists($dir)) {
            File::deleteDirectory($dir);
        }
    }
}

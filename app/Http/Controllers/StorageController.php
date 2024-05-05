<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

/**
 * Controlador para la gestión de almacenamiento de archivos.
 * Proporciona métodos para almacenar, actualizar y eliminar imágenes,
 * así como para eliminar directorios.
 */
class StorageController extends Controller
{
    /**
     * Guarda una imagen en un directorio especificado.
     *
     * @param \Illuminate\Http\UploadedFile $file El archivo de imagen a guardar.
     * @param string $name El nombre para el archivo de imagen.
     * @param string $dir El directorio donde se guardará la imagen.
     *
     * @return string La ruta relativa de la imagen guardada.
     */
    public static function storeImage($file, $name, $dir)
    {
        $filename = $name . "." . $file->getClientOriginalExtension();
        $foto = $file->storeAs($dir, $filename, 'public');
        return "storage/" . $foto;
    }

    /**
     * Actualiza una imagen existente en un directorio especificado.
     *
     * @param \Illuminate\Http\UploadedFile $file El nuevo archivo de imagen.
     * @param string $name El nombre para el archivo de imagen.
     * @param string $dir El directorio donde se almacenará la nueva imagen.
     *
     * @return string La ruta relativa de la imagen actualizada.
     */
    public static function updateImage($file, $name, $dir)
    {
        self::findAndDeleteImage($name, $dir);
        return self::storeImage($file, $name, $dir);
    }

    /**
     * Busca y elimina una imagen existente con un nombre y directorio especificados.
     *
     * @param string $name El nombre del archivo de imagen a eliminar.
     * @param string $dir El directorio donde se encuentra la imagen.
     *
     * @return void
     */
    public static function findAndDeleteImage($name, $dir)
    {
        $pattern = "storage/" . $dir . "/" . $name . ".*";
        $searchResult = File::glob($pattern);
        if (!empty($searchResult)) {
            File::delete($searchResult[0]);
        }
    }

    /**
     * Elimina un directorio especificado y su contenido.
     *
     * @param string $dir El directorio que se va a eliminar.
     *
     * @return void
     */
    public static function deleteDirectory($dir)
    {
        if (File::exists($dir)) {
            File::deleteDirectory($dir);
        }
    }
}
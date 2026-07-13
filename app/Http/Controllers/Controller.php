<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use RuntimeException;

abstract class Controller
{
    protected function storeWithUniqueName(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        $filesystem = Storage::disk($disk);
        $directory = trim($directory, '/');

        if (! $filesystem->exists($directory) && ! $filesystem->makeDirectory($directory)) {
            throw new RuntimeException("Unable to create the upload directory [{$directory}] on disk [{$disk}].");
        }

        $originalName = $file->getClientOriginalName();
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME) ?: 'image';
        $filename = $originalName;
        $suffix = 1;

        while ($filesystem->exists($directory.'/'.$filename)) {
            $filename = $baseName.'-'.$suffix.($extension !== '' ? '.'.$extension : '');
            $suffix++;
        }

        $path = $file->storeAs($directory, $filename, $disk);

        if (! is_string($path) || ! $filesystem->exists($path)) {
            throw new RuntimeException("Unable to save the uploaded file to [{$directory}] on disk [{$disk}].");
        }

        return $path;
    }
}

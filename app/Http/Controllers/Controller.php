<?php

namespace App\Http\Controllers;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

abstract class Controller
{
    protected function storeWithUniqueName(UploadedFile $file, string $directory, string $disk = 'public'): string
    {
        $originalName = $file->getClientOriginalName();
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME) ?: 'image';
        $filename = $originalName;
        $suffix = 1;

        while (Storage::disk($disk)->exists($directory.'/'.$filename)) {
            $filename = $baseName.'-'.$suffix.($extension !== '' ? '.'.$extension : '');
            $suffix++;
        }

        return $file->storeAs($directory, $filename, $disk);
    }
}

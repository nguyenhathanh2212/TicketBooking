<?php

namespace App\Services;

use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageService extends BaseService
{
    /**
     * CompanyService constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->model = $image;
    }

    public function createImage($modelMorph, $files)
    {
        foreach ($files as $file) {
            $a = Storage::disk('local')->put('public', $file);
            $arrayName = explode('/', $a);
            $arrayName[0] = 'storage';
            $fileName = implode('/', $arrayName);
            $modelMorph->images()->create(['url' => "/{$fileName}"]);
        }
    }

    public function deleteImageExcept($modelMorph, $oldImage)
    {
        foreach($oldImage as $key => $image) {
            $oldImage[$key] = "/storage/{$image}";
        }

        $modelMorph->images()->whereNotIn('url', $oldImage)->delete();
    }
}

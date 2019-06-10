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
        foreach (array_wrap($files) as $file) {
            $image = Storage::disk('local')->put('public', $file);
            $arrayName = explode('/', $image);
            $arrayName[0] = 'storage';
            $fileName = implode('/', $arrayName);
            $modelMorph->images()->create(['url' => "/{$fileName}"]);
        }
    }

    public function deleteImageExcept($modelMorph, $oldImage = [])
    {
        foreach($oldImage as $key => $image) {
            $oldImage[$key] = "/storage/{$image}";
        }

        foreach($modelMorph->images()->whereNotIn('url', $oldImage)->pluck('url') as $url) {
            $arrayName = explode('/', $url);
            $url = end($arrayName);
            
            if (Storage::disk('local')->exists('public\\' . $url)) {
                Storage::disk('local')->delete('public\\' . $url);
            }
        }

        $modelMorph->images()->whereNotIn('url', $oldImage)->delete();
    }
}

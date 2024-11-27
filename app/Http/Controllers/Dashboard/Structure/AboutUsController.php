<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Structure\AboutUsRequest;
use App\Http\Requests\Dashboard\Structure\ContactUsRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AboutUsController extends StructureController
{
    protected string $structureKey = 'about-us';
    protected FileManagerService $fileManager;

    public function __construct(StructureRepositoryInterface $structureRepository, FileManagerService $fileManagerService)
    {
        $this->fileManager = $fileManagerService;
        parent::__construct($structureRepository);
    }

    public function store(AboutUsRequest $request) {
        return parent::_store($request);
    }

    protected function copy($request)
    {
        $image = url($request->old_image);
        if(!is_null($request->image)) {
            $this->fileManager->deleteFile(str_replace(url('/'), '', $image));
            $image = url($this->fileManager->upload('image', 'structure/about-us'));
        }
        return $request->merge([
            'en' => [
                'main_title' => $request->en['main_title'],
                'content' => [
                    'title' => $request->en['content']['title'],
                    'content' => $request->en['content']['content'],
                    'image' => $image,
                ],
            ],
            'ar' => [
                'main_title' => $request->ar['main_title'],
                'content' => [
                    'title' => $request->ar['content']['title'],
                    'content' => $request->ar['content']['content'],
                    'image' => $image,
                ],
            ],
        ]);
    }
}

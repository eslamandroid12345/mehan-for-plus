<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Structure\AboutUsRequest;
use App\Http\Requests\Dashboard\Structure\CreditsRequest;
use App\Http\Requests\Dashboard\Structure\TermsAndConditionsRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Http\Request;

class CreditsController extends StructureController
{
    protected string $structureKey = 'credits';
    protected FileManagerService $fileManager;

    private StructureRepositoryInterface $structureRepository;


    public function __construct(StructureRepositoryInterface $structureRepository, FileManagerService $fileManagerService)
    {
        $this->structureRepository = $structureRepository;
        $this->fileManager = $fileManagerService;
        parent::__construct($structureRepository);
    }

    public function store(CreditsRequest $request) {
        $data = json_encode(safeArray($this->copy($request)));
        $this->structureRepository->publish($this->structureKey, $data);
        return redirect()->back()->with('success', __('messages.Content published successfully'));
    }

    protected function copy($request)
    {
        $data = $request->toArray();
        $i = 0;
        foreach ($data['en'] as $content) {
            $image = url($request->{'old_image_' . $i});
            if(!is_null($request->{'image_' . $i})) {
                $this->fileManager->deleteFile(str_replace(url('/'), '', $image));
                $image = url($this->fileManager->upload('image_' . $i, 'structure/credits'));
            }
            $data['en'][$i]['image'] = $image == url() ? '' : $image;
            unset($data['image_' . $i]);
            unset($data['old_image_' . $i]);
            $i++;
        }
        unset($data['_token']);
        $data['ar'] = $data['en'];
        return $data;
    }
}

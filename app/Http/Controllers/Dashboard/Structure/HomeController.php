<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Structure\AboutUsRequest;
use App\Http\Requests\Dashboard\Structure\ContactUsRequest;
use App\Http\Requests\Dashboard\Structure\HomeRequest;
use App\Http\Services\Mutual\FileManagerService;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class HomeController extends StructureController
{
    protected string $structureKey = 'home';
    protected FileManagerService $fileManager;

    private StructureRepositoryInterface $structureRepository;


    public function __construct(StructureRepositoryInterface $structureRepository, FileManagerService $fileManagerService)
    {
        $this->structureRepository = $structureRepository;
        $this->fileManager = $fileManagerService;
        parent::__construct($structureRepository);
    }

    public function store(HomeRequest $request) {
        $data = json_encode(safeArray($this->copy($request)));
        $this->structureRepository->publish($this->structureKey, $data);
        return redirect()->back()->with('success', __('messages.Content published successfully'));
    }

    protected function copy($request)
    {
        $data = $request->toArray();

        $section_1_video = url($request->old_video_section_1);
        if(!is_null($request->section_1_video)) {
            $this->fileManager->deleteFile(str_replace(url('/'), '', $section_1_video));
            $section_1_video = url($this->fileManager->upload('section_1_video', 'structure/home'));
        }
        $data['en']['section_1']['video'] = $section_1_video;
        $data['ar']['section_1']['video'] = $section_1_video;

        $section_1_image = url($request->old_image_section_1);
        if(!is_null($request->section_1_image)) {
            $this->fileManager->deleteFile(str_replace(url('/'), '', $section_1_image));
            $section_1_image = url($this->fileManager->upload('section_1_image', 'structure/home'));
        }
        $data['en']['section_1']['image'] = $section_1_image;
        $data['ar']['section_1']['image'] = $section_1_image;

        $section_2 = [
            url($request->old_image_1_section_2),
            url($request->old_image_2_section_2),
            url($request->old_image_3_section_2),
            url($request->old_image_4_section_2),
        ];
        for($i = 1; $i <= 4; $i++) {
            if(!is_null($request->{'section_2_image_'.$i})) {
                $this->fileManager->deleteFile(str_replace(url('/'), '', $section_2[$i - 1]));
                $section_2[$i - 1] = url($this->fileManager->upload('section_2_image_' . $i, 'structure/home'));
            }
            $data['en']['section_2']['content'][$i - 1]['number'] = $i;
            $data['ar']['section_2']['content'][$i - 1]['number'] = $i;
            $data['en']['section_2']['content'][$i - 1]['image'] = $section_2[$i - 1];
            $data['ar']['section_2']['content'][$i - 1]['image'] = $section_2[$i - 1];
        }
        unset($data['_token']);
        unset($data['old_image_section_1']);
        unset($data['old_image_1_section_2']);
        unset($data['old_image_2_section_2']);
        unset($data['old_image_3_section_2']);
        unset($data['old_image_4_section_2']);
        return $data;
    }
}

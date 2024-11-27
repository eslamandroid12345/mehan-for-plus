<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Controllers\Controller;
use App\Repository\StructureRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

abstract class StructureController extends Controller
{
    protected string $structureKey;

    private StructureRepositoryInterface $structureRepository;

    public function __construct(StructureRepositoryInterface $structureRepository)
    {
        $this->middleware('auth:admin');
        $this->structureRepository = $structureRepository;
    }

    public function index()
    {
        $structure = json_decode($this->structureRepository->structure($this->structureKey)->first()->content);
        return view('dashboard.site.structures.'.$this->structureKey, compact('structure'));
    }

    public function _store(Request $request)
    {
        $this->copy($request);
        $safeData = $request->toArray();
        unset($safeData['_token']);
        unset($safeData['old_image']);
        $data = json_encode(safeArray($safeData));
        $this->structureRepository->publish($this->structureKey, $data);
        return redirect()->back()->with('success', __('messages.Content published successfully'));
    }

    abstract protected function copy($request);

}

<?php

namespace App\Http\Controllers\Dashboard\Structure;

use App\Http\Requests\Dashboard\Structure\ContactUsRequest;

class ContactUsController extends StructureController
{
    protected string $structureKey = 'contact-us';

    public function store(ContactUsRequest $request) {
        return parent::_store($request);
    }

    protected function copy($request)
    {
        $request = $request->merge([
            'ar' => [
                'main_title' => $request->ar['main_title'],
                'content' => [
                    'contacts' => [
                        'message' => $request->ar['content']['contacts']['message'],
                        'content' => $request->en['content']['contacts']['content']
                    ],
                    'social' => [
                        'message' => $request->ar['content']['social']['message'],
                        'content' => $request->en['content']['social']['content']
                    ]
                ]
            ]
        ]);
        return $request->except('_token');
    }
}

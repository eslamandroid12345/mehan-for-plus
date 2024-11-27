<?php

namespace App\Http\Resources\Structures\Main;

use Illuminate\Http\Resources\Json\JsonResource;

class MainStructureResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "en" => [
                "main_title" => "Contact Us",
                "content" => [
                    "contacts" => [
                        "message" => "How can we help you?",
                        "content" => [
                            [
                                "key" => "phone",
                                "value" => "+966 1234 1234"
                            ],
                            [
                                "key" => "whatsapp",
                                "value" => "+966 1234 1234"
                            ]
                        ]
                    ],
                    "social" => [
                        "message" => "You can follow us:",
                        "content" => [
                            [
                                "key" => "snapchat",
                                "value" => "https://www.snapchat.com"
                            ],
                            [
                                "key" => "gmail",
                                "value" => "https://www.gmail.com"
                            ],
                            [
                                "key" => "instagram",
                                "value" => "https://www.instagram.com"
                            ]
                        ]
                    ]
                ]
            ],
            "ar" => [
                "main_title" => "تواصل معنا",
                "content" => [
                    "contacts" => [
                        "message" => "كيف يمكننا مساعدتك؟",
                        "content" => [
                            [
                                "key" => "phone",
                                "value" => "+966 1234 1234"
                            ],
                            [
                                "key" => "whatsapp",
                                "value" => "+966 1234 1234"
                            ]
                        ]
                    ],
                    "social" => [
                        "message" => "يمكنك أن تتابعنا على",
                        "content" => [
                            [
                                "key" => "snapchat",
                                "value" => "https://www.snapchat.com"
                            ],
                            [
                                "key" => "gmail",
                                "value" => "https://www.gmail.com"
                            ],
                            [
                                "key" => "instagram",
                                "value" => "https://www.instagram.com"
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}

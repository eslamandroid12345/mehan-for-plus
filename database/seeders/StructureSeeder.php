<?php

namespace Database\Seeders;

use App\Models\Structure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        Structure::query()->updateOrCreate(
//            ['key' => 'terms-and-conditions'],
//            ['content' => json_encode([
//                'en' => [
//                    'main_title' => 'Terms and Conditions',
//                    'content' => [
//                        [
//                            'title' => 'Registration Policy',
//                            'content' => 'There are many variants of Lorem Ipsum texts available, but the majority have been modified in some way through the introduction of some anecdotes or random words into the text. If you want to use a Lorem Ipsum text, you must first check that there are no embarrassing or inappropriate words or phrases hidden in it. While all Lorem Ipsum text generators on the Internet repeat passages of the same Lorem Ipsum text as many times as needed, our generator uses words from a dictionary of over 200 Latin words'
//                        ],
//                        [
//                            'title' => 'Communication Policy',
//                            'content' => 'There are many variants of Lorem Ipsum texts available, but the majority have been modified in some way through the introduction of some anecdotes or random words into the text. If you want to use a Lorem Ipsum text, you have to check first that there are no words'
//                        ],
//                    ],
//                ],
//                'ar' => [
//                    'main_title' => 'الشروط والأحكام',
//                    'content' => [
//                        [
//                            'title' => 'سياسة التسجيل',
//                            'content' => 'هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية'
//                        ],
//                        [
//                            'title' => 'سياسة التواصل',
//                            'content' => 'هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات'
//                        ],
//                    ],
//                ],
//            ])]
//        );
//
        Structure::query()->updateOrCreate(
            ['key' => 'contact-us'],
            ['content' => json_encode([
                'en' => [
                    'main_title' => 'Contact Us',
                    'content' => [
                        'contacts' => [
                            'message' => 'How can we help you?',
                            'content' => [
                                [
                                    'key' => 'phone',
                                    'value' => '+966 1234 1234',
                                ],
                                [
                                    'key' => 'whatsapp',
                                    'value' => '+966 1234 1234',
                                ],
                            ],
                        ],
                        'social' => [
                            'message' => 'You can follow us:',
                            'content' => [
                                [
                                    'key' => 'snapchat',
                                    'value' => 'https://www.snapchat.com',
                                ],
                                [
                                    'key' => 'gmail',
                                    'value' => 'https://www.gmail.com',
                                ],
                                [
                                    'key' => 'instagram',
                                    'value' => 'https://www.instagram.com',
                                ],
                            ],
                        ],
                    ],
                ],
                'ar' => [
                    'main_title' => 'تواصل معنا',
                    'content' => [
                        'contacts' => [
                            'message' => 'كيف يمكننا مساعدتك؟',
                            'content' => [
                                [
                                    'key' => 'phone',
                                    'value' => '+966 1234 1234',
                                ],
                                [
                                    'key' => 'whatsapp',
                                    'value' => '+966 1234 1234',
                                ],
                            ],
                        ],
                        'social' => [
                            'message' => 'يمكنك أن تتابعنا على',
                            'content' => [
                                [
                                    'key' => 'snapchat',
                                    'value' => 'https://www.snapchat.com',
                                ],
                                [
                                    'key' => 'gmail',
                                    'value' => 'https://www.gmail.com',
                                ],
                                [
                                    'key' => 'instagram',
                                    'value' => 'https://www.instagram.com',
                                ],
                            ],
                        ],
                    ],
                ],
            ])]
        );
//
//        Structure::query()->updateOrCreate(
//            ['key' => 'privacy-policy'],
//            ['content' => json_encode([
//                'en' => [
//                    'main_title' => 'Privacy Policy',
//                    'content' => [
//                        [
//                            'title' => 'Introduction:',
//                            'content' => 'There are many variants of Lorem Ipsum texts available, but the majority have been modified in some way through the introduction of some anecdotes or random words into the text. If you want to use a Lorem Ipsum text, you must first check that there are no embarrassing or inappropriate words or phrases hidden in it. While all Lorem Ipsum text generators on the Internet repeat passages of the same Lorem Ipsum text as many times as needed, our generator uses words from a dictionary of over 200 Latin words, plus a set of model sentences, to create the Lorem text Ipsum has a logical form close to the real text. Thus, the resulting text is free of repetition, or any inappropriate words or phrases, or the like. This is what makes it the first true Lorem Ipsum text generator on the internet.'
//                        ],
//                        [
//                            'title' => 'Submission Terms:',
//                            'content' => 'There are many variants of Lorem Ipsum texts available, but the majority have been modified in some way through the introduction of some anecdotes or random words into the text. If you want to use a Lorem Ipsum text, you must first check that there are no embarrassing or inappropriate words or phrases hidden in it. While all Lorem Ipsum text generators on the Internet repeat passages of the same Lorem Ipsum text as many times as needed, our generator uses words from a dictionary of over 200 Latin words, plus a set of model sentences, to create the Lorem text Ipsum has a logical form close to the real text. Thus, the resulting text is free of repetition, or any inappropriate words or phrases, or the like. This is what makes it the first true Lorem Ipsum text generator on the internet.'
//                        ],
//                        [
//                            'title' => 'Communication Policy:',
//                            'content' => 'There are many variants of Lorem Ipsum texts available, but the majority have been modified in some way through the introduction of some anecdotes or random words into the text. If you want to use a Lorem Ipsum text, you have to check first that there are no words'
//                        ],
//                    ],
//                ],
//                'ar' => [
//                    'main_title' => 'الشروط والأحكام',
//                    'content' => [
//                        [
//                            'title' => 'المقدمة:',
//                            'content' => 'هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلمات أو عبارات غير لائقة أو ما شابه. وهذا ما يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.'
//                        ],
//                        [
//                            'title' => 'شروط التقديم:',
//                            'content' => 'هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلمات أو عبارات غير لائقة أو ما شابه. وهذا ما يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.'
//                        ],
//                        [
//                            'title' => 'سياسة التواصل:',
//                            'content' => 'هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية.'
//                        ],
//                    ],
//                ],
//            ])]
//        );
//
//        Structure::query()->updateOrCreate(
//            ['key' => 'about-us'],
//            ['content' => json_encode([
//                'en' => [
//                    'main_title' => 'About Us',
//                    'content' => [
//                        'title' => 'About Platform:',
//                        'content' => 'There are many variants of Lorem Ipsum texts available, but the majority have been modified in some way through the introduction of some anecdotes or random words into the text. If you want to use a Lorem Ipsum text, you must first check that there are no embarrassing or inappropriate words or phrases hidden in it. While all Lorem Ipsum text generators on the Internet repeat passages of the same Lorem Ipsum text as many times as needed, our generator uses words from a dictionary of over 200 Latin words, plus a set of model sentences, to create the Lorem text Ipsum has a logical form close to the real text. Thus, the resulting text is free of repetition, or any inappropriate words or phrases, or the like. This is what makes it the first true Lorem Ipsum text generator on the internet.',
//                        'image' => 'https://www.image.com/img.png',
//                    ],
//                ],
//                'ar' => [
//                    'main_title' => 'من نحن',
//                    'content' => [
//                        'title' => 'عن المنصة:',
//                        'content' => 'هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي. وبالتالي يكون النص الناتح خالي من التكرار، أو أي كلمات أو عبارات غير لائقة أو ما شابه. وهذا ما يجعله أول مولّد نص لوريم إيبسوم حقيقي على الإنترنت.',
//                        'image' => 'https://www.image.com/img.png',
//                    ],
//                ],
//            ])]
//        );
//        Structure::query()->updateOrCreate(
//            ['key' => 'home'],
//            ['content' => json_encode([
//                'en' => [
//                    'section_1' => [
//                        'title' => 'Register an account and let the job find you',
//                        'content' => 'A platform that specializes in job search and also in searching for employees if you are an employer',
//                        'image' => 'https://www.image.com/img.png',
//                        'video' => 'https://www.image.com/img.png',
//                    ],
//                    'section_2' => [
//                        'title' => 'Steps to find a job',
//                        'content' => [
//                            [
//                            'number' => 1,
//                            'image' => 'https://www.image.com/img.png',
//                            'title' => 'Create New Account'
//                            ],
//                            [
//                                'number' => 2,
//                                'image' => 'https://www.image.com/img.png',
//                                'title' => 'Subscribe to Ads'
//                            ],
//                            [
//                                'number' => 3,
//                                'image' => 'https://www.image.com/img.png',
//                                'title' => 'Profile will be shown'
//                            ],
//                            [
//                                'number' => 4,
//                                'image' => 'https://www.image.com/img.png',
//                                'title' => 'Someone will communicate with you'
//                            ],
//                        ]
//                    ],
//                    'section_3' => [
//                        'title' => 'Search for best employees',
//                        'content' => 'Register now and find the best employees for your company and take advantage of our various services'
//                    ]
//                ],
//                'ar' => [
//                    'section_1' => [
//                        'title' => 'سجل حساب ودع الوظيفة تجدك',
//                        'content' => 'منصة متخصصة في البحث عن العمل وأيضاً في البحث عن الموظفين إذا كنت صاحب عمل',
//                        'image' => 'https://www.image.com/img.png',
//                        'video' => 'https://www.image.com/img.png',
//                    ],
//                    'section_2' => [
//                        'title' => 'خطوات البحث عن عمل',
//                        'content' => [
//                            [
//                            'number' => 1,
//                            'image' => 'https://www.image.com/img.png',
//                            'title' => 'أنشئ حساب جديد'
//                            ],
//                            [
//                                'number' => 2,
//                                'image' => 'https://www.image.com/img.png',
//                                'title' => 'اشترك في الإعلانات'
//                            ],
//                            [
//                                'number' => 3,
//                                'image' => 'https://www.image.com/img.png',
//                                'title' => 'سيتم عرض بروفايلك'
//                            ],
//                            [
//                                'number' => 4,
//                                'image' => 'https://www.image.com/img.png',
//                                'title' => 'سيقوم أحد بالتواصل معك'
//                            ],
//                        ]
//                    ],
//                    'section_3' => [
//                        'title' => 'ابحث عن أفضل الموظفين',
//                        'content' => 'قم بالتسجيل الآن وابحث عن أفضل الموظفين لشركتك واستفد من خدماتنا المتنوعة'
//                    ]
//                ],
//            ])]
//        );
        Structure::query()->updateOrCreate(
            ['key' => 'credits'],
            ['content' => json_encode([
                'en' => [
                    [
                        'image' => 'https://www.image.com/img.png',
                        'url' => 'https://www.credit.com'
                    ],
                    [
                        'image' => 'https://www.image.com/img.png',
                        'url' => 'https://www.credit.com'
                    ],
                    [
                        'image' => 'https://www.image.com/img.png',
                        'url' => 'https://www.credit.com'
                    ],
                ],
                'ar' => [
                    [
                        'image' => 'https://www.image.com/img.png',
                        'url' => 'https://www.credit.com'
                    ],
                    [
                        'image' => 'https://www.image.com/img.png',
                        'url' => 'https://www.credit.com'
                    ],
                    [
                        'image' => 'https://www.image.com/img.png',
                        'url' => 'https://www.credit.com'
                    ],
                ],
            ])],
        );
    }
}

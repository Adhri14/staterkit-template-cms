<?php

function navigation()
{
    // ! Add Icons to file resources/js/Utils/icons.js
    return  [
        "title" => env('APP_NAME'),
        // "logo"  => "/images/logo.svg",
        "link" => "/",
        "sections" => [
            [
                "title" => "",
                "menus" => [
                    [
                        "title" => "Dashboard",
                        "link" => route('dashboard'),
                        "icon" => "FaChartLine",
                        "submenu" => [],
                        "method"=> 'get'
                    ],
                    // [
                    //     "title" => "Redeems",
                    //     "link" => route('redeem.index', ['type' => 'redeem']),
                    //     "icon" => "fa-gifts",
                    //     "submenu" => [],
                    //     "method"=> 'get'
                    // ],
                    // [
                    //     "title" => "Redeem Party",
                    //     "link" => route('redeem-party.index'),
                    //     "icon" => "fa-gifts",
                    //     "submenu" => [],
                    //     "method"=> 'get'
                    // ],
                    // [
                    //     "title" => "Orders",
                    //     "link" => route('redeem.index', ['type' => 'order']),
                    //     "icon" => "fa-cart-shopping",
                    //     "submenu" => [],
                    //     "method"=> 'get'
                    // ],
                ],
            ],

            // [
            //     "title" => "Inboxes",
            //     "menus" => [
            //         [
            //             "title" => "Faq Submissions",
            //             "link" => route('faq-submission.index'),
            //             "icon" => "fa-question-circle",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Subscriptions",
            //             "link" => route('subscription.index'),
            //             "icon" => "fa-bell",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Template Email",
            //             "link" => route('template-email.index'),
            //             "icon" => "fa-envelope",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],

            // [
            //     "title" => "Pages",
            //     "menus" => [
            //         [
            //             "title" => "Home",
            //             "link" => route('page.index',['type'=>'home']),
            //             "icon" => "fa-file",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         // [
            //         //     "title" => "Static Pages",
            //         //     "link" => route('page.index',['type'=>'static']),
            //         //     "icon" => "fa-file",
            //         //     "submenu" => [],
            //         //     "method"=> 'get'
            //         // ],
            //         // [
            //         //     "title" => "Faq",
            //         //     "link" => route('page.index',['type'=>'faq']),
            //         //     "icon" => "fa-file",
            //         //     "submenu" => [],
            //         //     "method"=> 'get'
            //         // ],
            //         // [
            //         //     "title" => "How To",
            //         //     "link" => route('page.index',['type'=>'how-to']),
            //         //     "icon" => "fa-file",
            //         //     "submenu" => [],
            //         //     "method"=> 'get'
            //         // ],
            //     ]
            // ],

            // [
            //     "title" => "Product, Receipe & Outlet",
            //     "menus" => [
            //         [
            //             "title" => "Product",
            //             "link" => route('product.index'),
            //             "icon" => "fa-martini-glass-citrus",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Receipe",
            //             "link" => route('receipe.index'),
            //             "icon" => "fa-receipt",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Outlet",
            //             "link" => route('outlet.index'),
            //             "icon" => "fa-store",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Merchandise",
            //             "link" => route('merchandise.index'),
            //             "icon" => "fa-gift",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Voucher",
            //             "link" => route('voucher.index'),
            //             "icon" => "fa-ticket",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],

            // [
            //     "title" => "Blog",
            //     "menus" => [
            //         [
            //             "title" => "Blog",
            //             "link" => route('post.index',['type'=>'blog']),
            //             "icon" => "fa-newspaper",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Tag",
            //             "link" => route('tag.index',['type'=>'blog']),
            //             "icon" => "fa-cube",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],

            // [
            //     "title" => "Quiz",
            //     "menus" => [
            //         [
            //             "title" => "Quiz",
            //             "link" => route('quiz.index'),
            //             "icon" => "fa-newspaper",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Question",
            //             "link" => route('question.index'),
            //             "icon" => "fa-cube",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Quiz Participants",
            //             "link" => route('quiz-participant.index'),
            //             "icon" => "fa-question",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],
            // [
            //     "title" => "Event",
            //     "menus" => [
            //         [
            //             "title" => "Event",
            //             "link" => route('event.index'),
            //             "icon" => "fa-star",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Tag",
            //             "link" => route('tag.index',['type'=>'event']),
            //             "icon" => "fa-cube",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],
            // [
            //     "title" => "User",
            //     "menus" => [
            //         [
            //             "title" => "User",
            //             "link" => route('user.index'),
            //             "icon" => "fa-user",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "User Not Verify",
            //             "link" => route('user-not-verify.index'),
            //             "icon" => "fa-user-xmark",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Member Party",
            //             "link" => route('group-party.index'),
            //             "icon" => "fa-user-group",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],
            // [
            //     "title" => "Log",
            //     "menus" => [
            //         [
            //             "title" => "Log Admin",
            //             "link" => route('log-admin.index'),
            //             "icon" => "fa-history",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Log User",
            //             "link" => route('log-user.index'),
            //             "icon" => "fa-history",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],


            // [
            //     "title" => "Settings",
            //     "menus" => [
            //         [
            //             "title" => "Main Menu",
            //             "link" => route('page.index',['type'=>'main-menu']),
            //             "icon" => "fa-bars",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Footer Menu",
            //             "link" => route('page.index',['type'=>'footer-menu']),
            //             "icon" => "fa-bars",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Payment Method",
            //             "link" => route('payment-method.index'),
            //             "icon" => "fa-building",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Country",
            //             "link" => route('country.index'),
            //             "icon" => "fa-earth-asia",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "Province",
            //             "link" => route('province.index'),
            //             "icon" => "fa-mountain-city",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "City",
            //             "link" => route('city.index'),
            //             "icon" => "fa-city",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //         [
            //             "title" => "District",
            //             "link" => route('district.index'),
            //             "icon" => "fa-building",
            //             "submenu" => [],
            //             "method"=> 'get'
            //         ],
            //     ]
            // ],
            [
                "title" => "Menu",
                "menus" => [
                    [
                        "title" => "User",
                        "link" => route('user.index'),
                        "icon" => "FaUser",
                        "submenu" => [],
                        "method"=> 'get'
                    ],
                    [
                        "title" => "Product",
                        "link" => route('product.index'),
                        "icon" => "FaSeedling",
                        "submenu" => [],
                        "method"=> 'get'
                    ],
                    [
                        "title" => "Transaction",
                        "link" => route('transaction.index'),
                        "icon" => "FaReceipt",
                        "submenu" => [],
                        "method"=> 'get'
                    ],
                ]
            ],
            [
                "title" => "Log",
                "menus" => [
                    [
                        "title" => "Log Admin",
                        "link" => route('log-admin.index'),
                        "icon" => "FaHistory",
                        "submenu" => [],
                        "method"=> 'get'
                    ],
                    [
                        "title" => "Log User",
                        "link" => route('log-user.index'),
                        "icon" => "FaHistory",
                        "submenu" => [],
                        "method"=> 'get'
                    ],
                ]
            ],
            [
                "title" => "",
                'class' => '',
                "menus" => [
                    [
                        "title" => "Logout",
                        "link" => route('logout'),
                        "icon" => "FaArrowRightFromBracket",
                        "submenu" => [],
                        "method"=> 'post',
                        "as"=> 'button'
                    ],
                ]
            ],
        ]
        ];
}
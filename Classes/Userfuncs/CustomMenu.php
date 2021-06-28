<?php

declare(strict_types=1);

namespace T3docs\Examples\Userfuncs;

class CustomMenu
{

    public function makeMenuArray(string $content, array $conf) : array
    {
        return [
            [
                'title' => 'Contact',
                '_OVERRIDE_HREF' => 'index.php?id=10',
                '_SUB_MENU' => [
                    [
                        'title' => 'Offices',
                        '_OVERRIDE_HREF' => 'index.php?id=11',
                        '_OVERRIDE_TARGET' => '_top',
                        'ITEM_STATE' => 'ACT',
                        '_SUB_MENU' => [
                            [
                                'title' => 'Copenhagen Office',
                                '_OVERRIDE_HREF' => 'index.php?id=11&officeId=cph',
                            ],
                            [
                                'title' => 'Paris Office',
                                '_OVERRIDE_HREF' => 'index.php?id=11&officeId=paris',
                            ],
                            [
                                'title' => 'New York Office',
                                '_OVERRIDE_HREF' => 'http://www.example.com',
                                '_OVERRIDE_TARGET' => '_blank',
                            ]
                        ]
                    ],
                    [
                        'title' => 'Form',
                        '_OVERRIDE_HREF' => 'index.php?id=10&cmd=showform',
                    ],
                    [
                        'title' => 'Thank you',
                        '_OVERRIDE_HREF' => 'index.php?id=10&cmd=thankyou',
                    ],
                ],
            ],
            [
                'title' => 'Products',
                '_OVERRIDE_HREF' => 'index.php?id=14',
            ]
        ];
    }
}

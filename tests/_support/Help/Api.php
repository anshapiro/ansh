<?php

namespace Help;

use App\Patient\Model\Status\StatusInterface;

final class Api
{
    #################### USERS ####################

    public static $admin = [
        'username' => 'admin',
        'email' => 'ansh.web.dev@gmail.com',
        'password' => 123,
        'fullName' => [
            'name' => 'Andrey',
            'surname' => 'Shapiro',
            'patronymic' => 'Alexandrovich',
        ],
    ];

    public static $viewer = [
        'username' => 'viewer',
        'email' => 'viewer@example.com',
        'password' => 123,
        'fullName' => [
            'name' => 'Viewer',
            'surname' => 'Viewer',
        ],
    ];

    public static $editor = [
        'username' => 'editor',
        'email' => 'editor@example.com',
        'password' => 123,
        'fullName' => [
            'name' => 'Editor',
            'surname' => 'Editor',
        ],
    ];

    #################### END OF USERS ####################

    #################### CLIENTS ####################

    public static $clients = [];

    #################### END OF CLIENTS ####################

    #################### REGIONS ####################

    public static $testRegionOne = [
        'id' => '6444bbdd-5421-4508-8d38-12975ad50818',
        'name' => 'TestRegion1',
    ];

    public static $testRegionTwo = [
        'id' => '62c043b0-b0f1-4dba-bef1-36d58762e603',
        'name' => 'TestRegion2',
    ];

    #################### END OF REGIONS ####################

    #################### INIT ####################

    public static function init(): void
    {
        self::$clients = self::initClients();
    }

    /** @return array */
    public static function initClients(): array
    {
        $clients = [];

        for ($i = 1; $i <= 100; ++$i) {
            $clients[] = [
                'fullName' => [
                    'name' => 'Name' . $i,
                    'surname' => 'Surname' . $i,
                    'patronymic' => 'Patronymic' . $i,
                ],
                'address' => [
                    'postcode' => (string) (224000 + $i),
                    'city' => 'City' . $i,
                    'street' => 'Street' . $i,
                    'houseNumber' => (string) ($i % 10 !== 0 ? random_int(1, 9) : null),
                ],
                'status' => StatusInterface::DEFAULT_STATUS_NAME,
            ];
        }

        return $clients;
    }

    #################### END OF INIT ####################
}

Api::init();

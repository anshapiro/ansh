<?php

namespace Help;

use Help\Api\ClientApi;

final class Api
{
    #################### USERS ####################

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
        self::$clients = ClientApi::initClients();
    }

    #################### END OF INIT ####################
}

Api::init();

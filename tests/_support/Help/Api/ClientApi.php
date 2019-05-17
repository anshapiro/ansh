<?php

namespace Help\Api;

use App\Patient\Model\Status\StatusInterface;

final class ClientApi
{
    /** @return array */
    public static function initClients(): array
    {
        $clients = [];

        for ($i = 1; $i <= 100; ++$i) {
            $clients[] = [
                'fullName' => self::createFullName($i),
                'address' => self::createAddress($i),
                'phone' => self::createPhone($i),
                'status' => StatusInterface::DEFAULT_STATUS_NAME,
            ];
        }

        return $clients;
    }

    /**
     * @param int $i
     *
     * @return array
     */
    private static function createFullName(int $i): array
    {
        return [
            'name' => 'Name' . $i,
            'surname' => 'Surname' . $i,
            'patronymic' => 'Patronymic' . $i,
        ];
    }

    /**
     * @param int $i
     *
     * @return array
     */
    private static function createAddress(int $i): array
    {
        $postcode = '';

        for ($j = 0; $j <= 6 - strlen($i); ++$j) {
            $postcode .= '0';
        }

        return [
            'postcode' => $postcode . $i,
            'city' => 'City' . $i,
            'street' => 'Street' . $i,
            'houseNumber' => (string) ($i % 10 !== 0 ? $i : null),
        ];
    }

    /**
     * @param int $i
     *
     * @return array
     */
    private static function createPhone(int $i): array
    {
        $phoneNumber = '';

        for ($j = 0; $j <= 6 - strlen($i); ++$j) {
            $phoneNumber .= '0';
        }

        return [
            'countryCode' => '375',
            'phoneCode' => '33',
            'phoneNumber' => $phoneNumber . $i,
        ];
    }
}

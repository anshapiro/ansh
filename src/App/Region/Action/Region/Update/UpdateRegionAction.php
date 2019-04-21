<?php

namespace App\Region\Action\Region\Update;

use App\Region\Model\Region\RegionInterface;
use Base\Utils\Serializer\SerializerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Region\Exception\RegionNotFoundException;
use App\Region\Action\Region\RegionActionInterface;

final class UpdateRegionAction implements RegionActionInterface
{
    /** @var ObjectManager */
    private $om;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * UpdateRegionAction constructor.
     *
     * @param ObjectManager $om
     * @param SerializerInterface $serializer
     */
    public function __construct(ObjectManager $om, SerializerInterface $serializer)
    {
        $this->om = $om;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param RegionInterface|null $region
     *
     * @throws RegionNotFoundException
     *
     * @return RegionInterface
     */
    public function perform(array $data, ?RegionInterface $region = null): RegionInterface
    {
        if ($region === null) {
            throw new RegionNotFoundException();
        }

        $region = $this->serializer->deserialize($data, self::OBJECT_CLASS, [
            'object_to_populate' => $region,
        ]);
        $this->om->persist($region);

        return $region;
    }
}

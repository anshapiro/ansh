<?php

namespace App\Region\Action\Region\Create;

use App\Region\Model\Region\RegionInterface;
use Base\Utils\Serializer\SerializerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Region\Action\Region\RegionActionInterface;

final class CreateRegionAction implements RegionActionInterface
{
    /** @var ObjectManager */
    private $om;

    /** @var SerializerInterface */
    private $serializer;

    /**
     * CreateRegionAction constructor.
     *
     * @param ObjectManager $om
     * @param SerializerInterface $serializer
     */
    public function __construct(
        ObjectManager $om,
        SerializerInterface $serializer
    ) {
        $this->om = $om;
        $this->serializer = $serializer;
    }

    /**
     * @param array $data
     * @param RegionInterface|null $region
     *
     * @return RegionInterface
     */
    public function perform(array $data, ?RegionInterface $region = null): RegionInterface
    {
        $newRegion = $this->serializer->deserialize($data, self::OBJECT_CLASS);
        $this->om->persist($newRegion);

        return $newRegion;
    }
}

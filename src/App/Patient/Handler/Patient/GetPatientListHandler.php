<?php

namespace App\Patient\Handler\Patient;

use Base\Exception\MissingValueException;
use Base\Exception\MethodNotFoundException;
use Base\Utils\Pagination\AbstractPagination;
use App\Patient\Exception\RegionNotFoundException;
use App\Patient\Model\Region\RegionRepositoryInterface;
use App\Patient\Model\Patient\PatientRepositoryInterface;

final class GetPatientListHandler extends AbstractPagination
{
    private const REQUIRED = ['regionId'];

    /** @var PatientRepositoryInterface */
    private $patientRepository;

    /** @var RegionRepositoryInterface */
    private $regionRepository;

    /** @var string */
    private $regionId;

    /**
     * GetPatientListHandler constructor.
     *
     * @param PatientRepositoryInterface $patientRepository
     * @param RegionRepositoryInterface $regionRepository
     */
    public function __construct(
        PatientRepositoryInterface $patientRepository,
        RegionRepositoryInterface $regionRepository
    ) {
        $this->patientRepository = $patientRepository;
        $this->regionRepository = $regionRepository;
    }

    /**
     * @param array $query
     *
     * @return array
     */
    public function handle(array $query): array
    {
        $this->handleQuery($query);

        $this->isThereARegion();

        return [
            'numberOfItems' => $this->patientRepository->countTheNumberByRegionId($this->getRegionId()),
            'items' => $this->patientRepository->getClientListDataByRegionId(
                $this->getRegionId(),
                $this->getLimit(),
                $this->getPage()
            ),
        ];
    }

    /**
     * @param array $query
     *
     * @throws MethodNotFoundException
     * @throws MissingValueException
     */
    private function handleQuery(array $query): void
    {
        foreach (self::REQUIRED as $required) {
            if (!\array_key_exists($required, $query)) {
                throw new MissingValueException(
                    sprintf(
                        'Required value "%s" is missing',
                        MissingValueException::createPlaceholder('required')
                    ),
                    ['required' => $required]
                );
            }
        }

        foreach ($query as $property => $value) {
            $methodName = 'set' . ucfirst($property);

            if (!method_exists($this, $methodName)) {
                throw new MethodNotFoundException(
                    sprintf(
                        'Method "%s" not found in %s',
                        MethodNotFoundException::createPlaceholder('method'),
                        MethodNotFoundException::createPlaceholder('class')
                    ),
                    [
                        'method' => $methodName,
                        'class' => self::class,
                    ]
                );
            }

            $this->$methodName($value);
        }
    }

    /** @throws RegionNotFoundException */
    public function isThereARegion(): void
    {
        if ($this->regionRepository->find($this->getRegionId()) === null) {
            throw new RegionNotFoundException(
                sprintf(
                    'Region with id "%s" not found',
                    RegionNotFoundException::createPlaceholder('regionId')
                ),
                ['regionId' => $this->getRegionId()]
            );
        }
    }

    /** @return string */
    private function getRegionId(): string
    {
        return $this->regionId;
    }

    /** @param string $regionId */
    private function setRegionId(string $regionId): void
    {
        if ($this->regionId !== $regionId) {
            $this->regionId = $regionId;
        }
    }

    /** @param int $limit */
    protected function setLimit(int $limit): void
    {
        if ($this->limit !== $limit) {
            $this->limit = $limit;
        }
    }

    /** @param int $page */
    protected function setPage(int $page): void
    {
        if ($this->page !== $page) {
            $this->page = $page;
        }
    }
}

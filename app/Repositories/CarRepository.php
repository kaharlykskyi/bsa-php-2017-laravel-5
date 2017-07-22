<?php

namespace App\Repositories;

use App\Car;
use App\Repositories\Contracts\AbstractRepository;
use App\Repositories\Contracts\CarRepositoryInterface;

/**
 * Class CarRepository
 * @package App\Repositories
 */
class CarRepository extends AbstractRepository implements CarRepositoryInterface
{
    /**
     * @var array
     */
    protected $itemsData = [
        [
            'id' => 1,
            'model' => 'Mercedes C-Classe',
            'color' => 'White',
            'registration_number' => 'MB1234',
            'mileage' => 102568,
            'year' => '2012',
            'price' => 50,
        ], [
            'id' => 2,
            'model' => 'Hyundai Elantra',
            'color' => 'Silver',
            'registration_number' => 'HE3214',
            'mileage' => 45856,
            'year' => '2015',
            'price' => 30,
        ], [
            'id' => 3,
            'model' => 'Skoda Octavia',
            'color' => 'Blue',
            'registration_number' => 'SO1342',
            'mileage' => 75821,
            'year' => '2013',
            'price' => 35,
        ], [
            'id' => 4,
            'model' => 'BMW Series 7',
            'color' => 'Black',
            'registration_number' => 'BMW789',
            'mileage' => 125522,
            'year' => '2010',
            'price' => 60,
        ]
    ];

    public function __construct()
    {
        parent::__construct();
        $this->fillRepository();
    }

    /**
     * Creates entity
     * @param array $data
     * @return Car
     */
    protected function createEntity(array $data): Car
    {
        return new Car($data);
    }

    /**
     * Fills repository with entities
     */
    protected function fillRepository()
    {
        foreach ($this->itemsData as $data) {
            $item = $this->createEntity($data);
            $this->itemsCollection->push($item);
        }
    }
}
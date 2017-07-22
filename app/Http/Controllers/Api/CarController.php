<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Entity\Car;
use Illuminate\Http\JsonResponse;
use App\Manager\CarManager;

class CarController extends Controller
{
    protected $carsData;

    public function __construct(CarManager $carsData)
    {
        $this->carsData = $carsData;
    }

    /**
     * Method return all cars data in json format
     *
     * @return JsonResponse
     */
    public function getCars() : JsonResponse
    {
        $cars = $this->carsData->findAll();
        $allCars = [];
        foreach ($cars as $oneCar) {
            array_push($allCars, [
                'id' => $oneCar->id,
                'color' => $oneCar->color,
                'model' => $oneCar->model,
                'year' => $oneCar->year,
                'price' => $oneCar->price,
            ]);
        }

        return response()->json($allCars);
    }

    /**
     * Method returns car info by id and cars owner (if it exists).
     * If car with id not found 404 response returned
     *
     * @param $id
     * @return JsonResponse
     */
    public function getOneCar($id) : JsonResponse
    {
        $car = $this->carsData->findById($id);
        if ($car === null) return response()->json(['error' => "car with id={$id} not found"], 404);

        if (isset($car->user)) {
            $userInfo = [
                'id' => $car->user->id,
                'first_name' => $car->user->first_name,
                'last_name' => $car->user->last_name,
                'is_active' => $car->user->is_active,
            ];
        } else {
            $userInfo = [];
        }

        return response()->json(
                [
                    'id' => $car->id,
                    'model' => $car->model,
                    'year' => $car->year,
                    'mileage' => $car->mileage,
                    'registration_number' => $car->registration_number,
                    'color' => $car->color,
                    'price' => $car->price,
                    'user' => $userInfo,
                ]
        );
    }
}
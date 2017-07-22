<?php

namespace App\Http\Controllers\Api\Admin;

use App\Manager\CarManager;
use App\Request\SaveCar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminCarController
{
    protected $carsData;

    public function __construct(CarManager $carData)
    {
        $this->carsData = $carData;
    }

    /**
     * Method return all cars data in json format
     *
     * @return JsonResponse
     */
    public function index() : JsonResponse
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
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id)
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

    /**
     * Save a new car from request
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        $data = new SaveCar($request);
        $car = $this->carsData->saveCar($data);
        $id = $car->id;
        return $this->show($id);
    }

    /**
     * Delete car by id
     *
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(int $id)
    {
        try {
            $this->carsData->deleteCar($id);
         } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'car not found'], 404);
         }
    }

    /**
     * Updating an existing car by id.
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id)
    {
        $data = new SaveCar($request);
        $car = $this->carsData->findById($id);
        if ($car === null) {
            return response()->json(['error' => "car with id={$id} not found"], 404);
        } else {
            $data->setCar($car);
            return $this->show($this->carsData->saveCar($data)->id);
        }
    }
}
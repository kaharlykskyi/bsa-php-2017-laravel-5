<?php

namespace App\Request;

use App\Request\Contract\SaveCarRequest;
use Illuminate\Http\Request;
use App\Entity\Car;
use App\Entity\User;

class SaveCar implements SaveCarRequest
{
    protected $car = null;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return Car
     */
    public function getCar(): Car
    {
        return $this->car ?: new Car();
    }
    /**
     * @param Car $car
     */
    public function setCar(Car $car)
    {
        $this->car = $car;
    }

    /**
     * @return string|null
     */
    public function getColor()
    {
        return $this->request->color;
    }

    /**
     * @return string|null
     */
    public function getModel()
    {
        return $this->request->model;
    }

    /**
     * @return string|null
     */
    public function getRegistrationNumber()
    {
        return $this->request->registration_number;
    }

    /**
     * @return int|null
     */
    public function getYear()
    {
        return $this->request->year;
    }

    /**
     * @return float|null
     */
    public function getMileage()
    {
        return $this->request->mileage;
    }

    /**
     * @return float|null
     */
    public function getPrice()
    {
        return $this->request->price;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        $userId = (int)$this->request->user;
        return User::find($userId) ?: new User;
    }
}
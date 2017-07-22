<?php

namespace App;

use Illuminate\Contracts\Support\Arrayable;

class Car extends AbstractEntity implements Arrayable
{
    protected $id;
    protected $model;
    protected $year;
    protected $mileage;
    protected $registration_number;
    protected $color;
    protected $price;

    protected $fillable = ['id', 'model', 'year', 'mileage', 'registration_number', 'color', 'price'];

    public function __construct(array $data = null)
    {
        return $this->fromArray($data);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     * @return Car
     */
    public function setYear($year)
    {
        $this->year = $year;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMileage()
    {
        return $this->mileage;
    }

    /**
     * @param mixed $mileage
     * @return Car
     */
    public function setMileage($mileage)
    {
        $this->mileage = $mileage;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRegistrationNumber()
    {
        return $this->registration_number;
    }

    /**
     * @param mixed $registration_number
     * @return Car
     */
    public function setRegistrationNumber($registration_number)
    {
        $this->registration_number = $registration_number;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     * @return Car
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Car
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'id' => $this->getId(),
            'model' => $this->getModel(),
            'year' => $this->getYear(),
            'mileage' => $this->getMileage(),
            'registration_number' => $this->getRegistrationNumber(),
            'color' => $this->getColor(),
            'price' => $this->getPrice()
        ];
    }

}
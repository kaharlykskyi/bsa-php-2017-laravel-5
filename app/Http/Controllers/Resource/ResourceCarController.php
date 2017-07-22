<?php

namespace App\Http\Controllers\Resource;

use App\Http\Controllers\Controller;
use App\Manager\CarManager;
use App\Manager\UserManager;
use App\Request\CarStoreFormRules;
use App\Request\SaveCar;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ResourceCarController extends Controller
{
    protected $carsData;
    protected $usersData;

    public function __construct(CarManager $carsData, UserManager $usersData)
    {
        $this->carsData = $carsData;
        $this->usersData = $usersData;
    }

    /**
     * Returns a view with list of all cars.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $carList = $this->carsData->findAll();
        return view('cars/index', ['cars' => $carList->toArray()]);
    }

    /**
     * Returns a view with car info by id.
     * If car with id not fount returns 404 page
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(int $id)
    {
        $car = $this->carsData->findById($id);
        if ($car === null) {
            abort(404);
        } else {
            return view('cars/show', ['car' => $car->toArray()]);
        }
    }

    /**
     * Delete car with id and redirecting to /cars.
     * If car with id not found a new exception throws
     *
     * @param int $id
     * @throws ModelNotFoundException
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id)
    {
        if ($this->carsData->findById($id) === null) {
            throw new ModelNotFoundException();
            //abort(404);
        } else {
            $this->carsData->deleteCar($id);
            return redirect('/cars');
        }
    }

    /**
     * Returns a view to create a new car with users list (to select them).
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $users = $this->usersData->findAll();
        return view('cars/create', ['user' => $users]);
    }

    /**
     * Returns a view to edit an existing car with user list (to select them).
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $car = $this->carsData->findById($id);
        if ($car === null) abort(404);
        $users = $this->usersData->findAll();
        return view('cars/edit', [
            'car' => $car,
            'user' => $users,
            ]);
    }

    /**
     * Save a new car using request with validation rules
     *
     * @param CarStoreFormRules $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(CarStoreFormRules $request)
    {
        $data = new SaveCar($request);
        $this->carsData->saveCar($data);
        return redirect('/cars');
    }

    /**
     * Update a car with id if it exists.
     *
     * @param CarStoreFormRules $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(CarStoreFormRules $request, int $id)
    {
        $car = $this->carsData->findById($id);

        if ($car === null) {
            abort(404);
        } else {
            $data = new SaveCar($request);
            $data->setCar($car);
            $this->carsData->saveCar($data);
            return $this->show($id);
        }
    }

}
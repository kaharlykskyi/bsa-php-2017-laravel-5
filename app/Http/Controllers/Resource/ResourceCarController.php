<?php

namespace App\Http\Controllers\Resource;

use App\Entity\Car;
use App\Http\Controllers\Controller;
use App\Manager\CarManager;
use App\Manager\UserManager;
use App\Request\CarStoreFormRules;
use App\Request\SaveCar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Gate;

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
     * @param $msg
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index($msg = null)
    {
        $carList = $this->carsData->findAll();
        return view('cars/index', [
            'cars' => $carList->toArray(),
            'message' => $msg
            ]);
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
            $owner = $this->usersData->findById($car->toArray()['user_id']);
            return view('cars/show', [
                'car' => $car->toArray(),
                'owner' => $owner['first_name'].' '.$owner['last_name'],
                'carObj' => $car
                ]);
        }
    }

    /**
     * Delete car with id and redirecting to /cars.
     * If car with id not found a new exception throws
     * This action is allowed only for admins.
     *
     * @param int $id
     * @throws ModelNotFoundException
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(int $id)
    {
        $car = new Car();
        if (Gate::denies('deleteCar', $car)) {
            return redirect()->route('index');
        } else {
            try {
                $this->carsData->deleteCar($id);
            }
            catch(ModelNotFoundException $e) {}
            return redirect()->route('cars.index');
        }
    }

    /**
     * Returns a view to create a new car with users list (to select them).
     * This action is allowed only for admins.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $car = new Car();
        if (Gate::denies('createCar', $car)) {
            return redirect()->route('index');
        } else {
            $users = $this->usersData->findAll();
            return view('cars/create', ['user' => $users]);
        }
    }

    /**
     * Returns a view to edit an existing car with user list (to select them).
     * This action is allowed only for admins.
     *
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(int $id)
    {
        $car = $this->carsData->findById($id);
        if (Gate::denies('editCar', $car)) {
            return redirect()->route('index');
        } else {
            if ($car === null) abort(404);
            $users = $this->usersData->findAll();
            return view('cars/edit', [
                'car' => $car,
                'user' => $users,
            ]);
        }
    }

    /**
     * Save a new car using request with validation rules
     * This action is allowed only for admins.
     *
     * @param CarStoreFormRules $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function store(CarStoreFormRules $request)
    {
        $car = new Car();
        if (Gate::denies('createCar', $car)) {
            return redirect()->route('index');
        } else {
            $data = new SaveCar($request);
            $this->carsData->saveCar($data);
            return $this->index('Car successfully added!');
        }
    }

    /**
     * Update a car with id if it exists.
     * This action is allowed only for admins.
     *
     * @param CarStoreFormRules $request
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function update(CarStoreFormRules $request, int $id)
    {
        $car = $this->carsData->findById($id);

        if (Gate::denies('editCar', $car)) {
            return redirect()->route('index');
        } else {
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

}
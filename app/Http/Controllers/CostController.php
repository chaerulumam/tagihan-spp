<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCostRequest;
use App\Http\Requests\UpdateCostRequest;
use App\Models\Cost as Model;
use Facade\Ignition\ErrorPage\ErrorPageViewModel;
use Illuminate\Http\Request;

class CostController extends Controller
{
    private $viewIndex = 'cost_index';
    private $viewCreate = 'cost_form';
    private $viewEdit = 'cost_form';
    private $viewShow = 'cost_show';
    private $routePrefix = 'cost';

    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::with('user')->search($request->q)->paginate(20);
        } else {
            $models = Model::with('user')->latest()->paginate(5);
        }

        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Cost Module List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SUBMIT',
            'title' => 'Create Module Student Record'
        ];
        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCostRequest $request)
    {
        $requestData = $request->validated();
        $requestData['user_id'] = auth()->user()->id;
        // dd($requestData);
        Model::create($requestData);
        flash('Successfully create new record');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function show(Model $cost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Update Module Student'
        ];
        return view('operator.' . $this->viewEdit, $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCostRequest  $request
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCostRequest $request, $id)
    {
        $requestData = $request->validated();
        $model = Model::findOrFail($id);

        $requestData['user_id'] = auth()->user()->id;
        $model->fill($requestData);
        // dd($requestData);
        $model->save();
        flash('Data successfully updated');
        return redirect()->route($this->routePrefix . '.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cost  $cost
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
        $model->delete();

        flash('Successfully deleted record');
        return redirect()->route($this->routePrefix . '.index');
    }
}

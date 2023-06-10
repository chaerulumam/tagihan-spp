<?php

namespace App\Http\Controllers;

use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WaliController extends Controller
{
    private $viewIndex = 'user_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'user_show';
    private $routePrefix = 'wali';
    
    public function index()
    {
        return view('operator.' . $this->viewIndex, [
            'models' => Model::where('access', 'wali')
                ->latest()
                ->paginate(20),
            'routePrefix' => $this->routePrefix,
            'title' => 'List Wali Data'
        ]);
    }
  
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SUBMIT',
            'title' => 'Create new Wali record'
        ];
        return view('operator.' . $this->viewCreate, $data);
    }
    
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'password' => 'required',
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['access'] = 'wali';
        Model::create($requestData);
        flash('Data successfully recorded');
        return redirect()->route($this->routePrefix . '.index');
    }

    public function edit($id)
    {
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix . '.update', $id],
            'button' => 'UPDATE',
            'title' => 'Update Wali record'
        ];
        return view('operator.' . $this->viewEdit, $data);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'nohp' => 'required|unique:users,nohp,' . $id,
            'password' => 'nullable'
        ]);
        $model = Model::findOrFail($id);
        if ($requestData['password'] == '') {
            unset($requestData['password']);
        } else {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        $model->fill($requestData);
        $model->save();
        flash('Data successfully update');
        return redirect()->route($this->routePrefix . '.index');
    }
   
    public function destroy($id)
    {
        $model = Model::where('access', 'wali')->firstOrFail();
        $model->delete();

        flash('Successfully deleted the record');
        return redirect()->route($this->routePrefix . '.index');
    }
}

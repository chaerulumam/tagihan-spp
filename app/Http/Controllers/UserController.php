<?php

namespace App\Http\Controllers;

use App\Models\User as Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $viewIndex = 'user_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'user_show';
    private $routeFolder = 'operator';
    private $routePrefix = 'user';
    
    public function index()
    {
        return view($this->routeFolder . '.' . $this->viewIndex, [
            'models' => Model::where('access', '<>', 'wali')
                ->latest()
                ->paginate(20),
            'title' => 'List User Data'
        ]);
    }
  
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix . '.store',
            'button' => 'SUBMIT'
        ];
        return view($this->routeFolder . '.' . $this->viewCreate, $data);
    }
    
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'access' => 'required|in:operator,admin',
            'password' => 'required',
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
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
            'button' => 'UPDATE'
        ];
        return view($this->routeFolder . '.' . $this->viewEdit, $data);
    }

    public function update(Request $request, $id)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'nohp' => 'required|unique:users,nohp,' . $id,
            'access' => 'required|in:operator,admin',
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
        $model = Model::findOrFail($id);
        $loggedInUser = Auth::user();
        if ($model->id == $loggedInUser->id) {
            flash('Can not delete the data where are logged in! Please contact support if you need assistance.')->error();
            return back();
        }
        $model->delete();

        flash('Successfully deleted the record');
        return redirect()->route($this->routePrefix . '.index');
    }
}

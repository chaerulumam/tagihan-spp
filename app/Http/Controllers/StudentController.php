<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student as Model;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $viewIndex = 'student_index';
    private $viewCreate = 'student_form';
    private $viewEdit = 'student_form';
    private $viewShow = 'student_show';
    private $routePrefix = 'student';
    
    public function index(Request $request)
    {
        if ($request->filled('q')) {
            $models = Model::search($request->q)->paginate(50);
        } else {
            $models = Model::latest()->paginate(50);
        }

        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Student List',
            
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
            'title' => 'Create Student Record',
            'wali' => User::where('access', 'wali')->pluck('name', 'id')
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStudentRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'wali_id' => 'nullable',
            'name' => 'required',
            'nisn' => 'required|unique:students',
            'jurusan' => 'required',
            'kelas' => 'required',
            'angkatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,jpg,png|max:2000'
        ]);

        if ($request->hasFile('foto')) {
            $requestData['foto'] = $request->file('foto')->store('public');
        }

        if ($request->filled('wali_id')) {
            $requestData['wali_status'] = 'ok';
        }
        
        $requestData['user_id'] = auth()->user()->id;
        Model::create($requestData);
        flash('Successfully create new record');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('operator.' . $this->viewShow, [
            'title' => 'Details Student Info',
            'model' => Model::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStudentRequest  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStudentRequest $request, Model $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $student)
    {
        //
    }
}

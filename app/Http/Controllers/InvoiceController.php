<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice as Model;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;
use App\Models\Cost;
use App\Models\Student;
use Carbon\Carbon;

class InvoiceController extends Controller
{
    private $viewIndex = 'invoice_index';
    private $viewCreate = 'invoice_form';
    private $viewEdit = 'invoice_form';
    private $viewShow = 'invoice_show';
    private $routePrefix = 'invoice';
    
    public function index(Request $request)
    {

        if ($request->filled('q')) {
            $models = Model::with('user', 'student')->search($request->q)->paginate(50);
        } else {
            $models = Model::with('user', 'student')->latest()->paginate(5);
        }

        return view('operator.' . $this->viewIndex, [
            'models' => $models,
            'routePrefix' => $this->routePrefix,
            'title' => 'Invoice List'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $studentQuery = Student::all();
        $data = [
            'model' => new Model(),
            'method' => 'GET',
            'route' => $this->routePrefix . '.store',
            'button' => 'SUBMIT',
            'title' => 'Create Invoice Record',
            'angkatan' => $studentQuery->pluck('angkatan', 'angkatan'),
            'kelas' => $studentQuery->pluck('kelas', 'kelas'),
            'amount' => Cost::get()
        ];

        return view('operator.' . $this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvoiceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvoiceRequest $request)
    {
        $requestData = $request->validated();
        $amountIdArray = $requestData['amount_id'];

        $student = Student::query();
        if ($requestData['kelas'] != '') {
            $student->where('kelas', $requestData['kelas']);
        }
        if ($requestData['angkatan'] != '') {
            $student->where('angkatan', $requestData['angkatan']);
        }
        $student = $student->get();
        foreach ($student as $item ) {
            $itemStudent = $item;
            $amount = Cost::whereIn('id', $amountIdArray)->get();
            foreach ($amount as $itemAmount) {
                $dataInvoice = [
                    'student_id' => $itemStudent->id,
                    'angkatan' => $requestData['angkatan'],
                    'kelas' => $requestData['kelas'],
                    'invoice_date' => $requestData['invoice_date'],
                    'expired_date' => $requestData['expired_date'],
                    'nama_biaya' => $itemAmount->name,
                    'jumlah_biaya' => $itemAmount->quantity,
                    'description' => $requestData['description'],
                    'status' => 'baru'
                ];
                $expiredDate = Carbon::parse($requestData['expired_date']);
                $invoiceDate = Carbon::parse($requestData['invoice_date']);
                $invoiceMonth = $invoiceDate->format('m');
                $invoiceYear = $invoiceDate->format('Y');
                $invoiceCheck = Model::where('student_id', $itemStudent->id)
                    ->where('nama_biaya', $itemAmount->name)
                    ->whereMonth('invoice_date', $invoiceMonth)
                    ->whereYear('invoice_date', $invoiceYear)
                    ->first();
                if ($invoiceCheck == null) {
                    Model::create($dataInvoice);
                }
            }
        }
        flash('Invoice successfully recorded')->success();
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Model $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Model $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvoiceRequest  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceRequest $request, Model $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $invoice)
    {
        //
    }
}

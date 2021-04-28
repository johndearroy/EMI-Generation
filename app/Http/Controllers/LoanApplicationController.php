<?php

namespace App\Http\Controllers;

use App\Models\LoanApplication;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Integer;

class LoanApplicationController extends Controller
{
    protected $model;

    public function __construct(LoanApplication $loanApplication)
    {
        $this->model = $loanApplication;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $applications = auth()->user()->is_admin
                        ? $this->model->all()
                        : $this->model->where('user', auth()->user()->id)->get();

        return view('loan', compact('applications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'duration' => 'required|numeric|between:1,12',
            'interest_rate' => 'required|numeric'
        ]);

        try {

            $request['user'] = auth()->user()->id;

            $this->model->create($request->only(['amount', 'duration', 'interest_rate', 'user']));

            return response()->json('Application submitted successfully!', 200);

        } catch (\Exception $exception) {

            return response()->json($exception, 500);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function show(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(LoanApplication $loanApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Integer $id
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, Request $request)
    {
        try {

            $this->model->whereId($id)->update($request->only('status'));

            return response()->json('Status updated!', 200);

        } catch (\Exception $exception) {

            return response()->json($exception, 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanApplication  $loanApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(LoanApplication $loanApplication)
    {
        //
    }
}

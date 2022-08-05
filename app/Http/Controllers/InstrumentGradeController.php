<?php

namespace App\Http\Controllers;

use App\Models\InstrumentGrade;
use App\Http\Requests\StoreInstrumentGradeRequest;
use App\Http\Requests\UpdateInstrumentGradeRequest;

class InstrumentGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreInstrumentGradeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInstrumentGradeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstrumentGrade  $instrumentGrade
     * @return \Illuminate\Http\Response
     */
    public function show(InstrumentGrade $instrumentGrade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstrumentGrade  $instrumentGrade
     * @return \Illuminate\Http\Response
     */
    public function edit(InstrumentGrade $instrumentGrade)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInstrumentGradeRequest  $request
     * @param  \App\Models\InstrumentGrade  $instrumentGrade
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInstrumentGradeRequest $request, InstrumentGrade $instrumentGrade)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstrumentGrade  $instrumentGrade
     * @return \Illuminate\Http\Response
     */
    public function destroy(InstrumentGrade $instrumentGrade)
    {
        //
    }
}

<?php

namespace Liamtseva\Cinema\Http\Controllers;

use Liamtseva\Cinema\Http\Requests\StoreStudioRequest;
use Liamtseva\Cinema\Http\Requests\UpdateStudioRequest;
use Liamtseva\Cinema\Models\Studio;

class StudioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudioRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Studio $studio)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Studio $studio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudioRequest $request, Studio $studio)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Studio $studio)
    {
        //
    }
}

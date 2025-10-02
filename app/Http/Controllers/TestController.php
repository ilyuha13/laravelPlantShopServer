<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTestRequest;
use App\Http\Requests\UpdateTestRequest;
use App\Models\Test;
use App\Services\ImageService;

class TestController extends Controller
{
    protected $imageService;

    public function __construct(ImageService $imageService)
    {
        $this->imageService = $imageService; // Внедрение зависимости
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTestRequest $request)
    {
        $species = Test::create($request->only(['name', 'description']));
        $imagePaths = [];
        foreach($request->input('images') as $image) {
            $imagePath = $this->imageService->saveImageFile($image);
            if ($imagePath) {
                $imagePaths[] = $imagePath;
            }
        }
        $species->image_paths = $imagePaths;
        $species->save();

        return response()->json($species, 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Test $test)
    {
        return $test;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTestRequest $request, Test $test)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        //
    }
}

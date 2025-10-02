<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePlantRequest;
use App\Http\Requests\UpdatePlantRequest;
use App\Models\Plant;
use App\Services\ImageService;

class PlantController extends Controller
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
        return Plant::all();
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlantRequest $request)
    {

        $validated = $request->validated();
        $plant = Plant::create($request->safe()->only(['description', 'varieties_id', 'price']));
        $imagePaths = [];
        foreach($request->safe()->only('images') as $image) {
            $imagePath = $this->imageService->saveBase64Image($image);
            if ($imagePath) {
                $imagePaths[] = $imagePath;
            }
        }
        $plant->image_paths = $imagePaths;
        return response()->json($plant, 201);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plant $plant)

    {
        $showPlant = Plant::with('variety.species')->find($plant->id);
        return $showPlant;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlantRequest $request, Plant $plant)
    {
        $plant->update($request->only(['description', 'images', 'varieties_id', 'price']));
        return response()->json($plant, 200);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plant $plant)
    {
        $plant->delete();
        return response()->json(null, 204);
        //
    }
}

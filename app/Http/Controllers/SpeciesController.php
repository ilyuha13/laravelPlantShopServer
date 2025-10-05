<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSpeciesRequest;
use App\Http\Requests\UpdateSpeciesRequest;
use App\Models\Species;
use App\Services\ImageService;

class SpeciesController extends Controller
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
        return Species::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSpeciesRequest $request) {
        $species = Species::create($request->only(['name', 'description']));

        foreach($request->images as $image) {
            $imagePath = $this->imageService->saveImageFile($image);
            if ($imagePath) {
                $imagePaths[] = $imagePath;
            }
        }
        $species->image_paths = $imagePaths;
        $species->save();

        return response()->json($species, 201);

        
    }

    /**
     * Display the specified resource.
     */
    public function show(Species $species)
    {
        return $species;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSpeciesRequest $request, Species $species)
    {
        // $species->update($request->only(['name', 'description']));
        // $imagePaths = [];
        // foreach($request->input('images') as $image) {
        //     $imagePath = $this->imageService->saveBase64Image($image);
        //     if ($imagePath) {
        //         $imagePaths[] = $imagePath;
        //     }
        // }
        // $species->image_paths = $imagePaths;
        // $species->save();
        
        return response()->json($species, 200);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Species $species)
    {
        $species->delete();
        return response()->json(null, 204);

    }
}

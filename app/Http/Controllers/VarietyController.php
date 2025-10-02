<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVarietyRequest;
use App\Http\Requests\UpdateVarietyRequest;
use App\Models\Variety;
use App\Services\ImageService;

class VarietyController extends Controller
{

    protected $imageService;

    public function __construct(ImageService $imageService) 
    {
        $this->imageService = $imageService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        return Variety::all();
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVarietyRequest $request)
    {
       $variety = Variety::create(
            $request->only(['name', 'description', 'species_id', 'image_urls', 'life_form', 'variegation']));
        
        $imagePaths = [];
        foreach($request->input('images') as $image) {
            $imagePath = $this->imageService->saveBase64Image($image);
            if ($imagePath) {
                $imagePaths[] = $imagePath;
            }
        }
        $variety->image_paths = $imagePaths;
        $variety->save();

        
        return response()->json($variety, 201);

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Variety $variety)

    {
        $showVariety = Variety::with('species')->find($variety->id);
        return $showVariety;
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVarietyRequest $request, Variety $variety)
    {
        $variety->update(
            $request->only(['name', 'description', 'species_id', 'image_urls', 'life_form', 'variegation']));
        return response()->json($variety, 200);
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Variety $variety)
    {
        $variety->delete();
        return response()->json(null, 204);
        //
    }
}

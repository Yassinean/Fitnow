<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Progression;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Validator;
use App\Http\Resources\ProgressionResource;
use App\Http\Controllers\API\BaseController as BaseController;

class ProgressionController extends BaseController
{
    public function __invoke()
    {
        // Your controller logic here
    }

    public function index()
    {
        // $progressions = Progression::where('user_id', auth()->id());

        // return $this->sendResponse($progressions, 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'poids' => 'required',
            'taille' => 'required',
            'performances' => 'required',
        ]);

        // Get the authenticated user's ID
        $progressionID = auth()->id();

        // Create a new Progression instance with user_id
        $progression = Progression::create([
            'user_id' => $progressionID,
            'poids' => $validateData['poids'],
            'taille' => $validateData['taille'],
            'performances' => $validateData['performances'],
        ]);


        return $this->sendResponse(new ProgressionResource($progression), 'Progression created successfully.');
        // return response()->json(['msg' => 'Progression created successfully', 'data' => new ProgressionResource($progression)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progression $progression)
    {
        $validatedData = $request->validate([
            'poids' => 'required',
            'taille' => 'required',
            'performances' => 'required'
        ]);

        $progression->update($validatedData);

        return $this->sendResponse(new ProgressionResource($progression), 'Progression update successfully.');
        // return response()->json(['msg' => 'Progression updated successfully', 'data' => new ProgressionResource($progression)]);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Progression $progression): JsonResponse
    {
        $progression->delete();

        // return $this->sendResponse([], 'Progression deleted successfully.');
        return response()->json(['msg' => 'Progression deleted successfully']);
    }
}
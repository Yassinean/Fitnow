<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Progression;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
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
        $progressions = Progression::where('user_id', auth()->id());

        return $this->sendResponse($progressions, 'Products retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $input = $request->all();

        $validateData = $request->validate([
            'poids' => 'required',
            'taille' => 'required',
            'performances' => 'required'
        ]);

        // if ($validator->fails()) {
        //     return $this->sendError('Validation Error.', $validator->errors());
        // }
        // $validatedData['user_id'] = auth()->id();

        $progression = Progression::create($validateData);

        // return $this->sendResponse(new ProgressionResource($progression), 'Progression created successfully.');
        return response()->json(['msg' => 'Progression created successfully', 'data' => new ProgressionResource($progression)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Progression $progression): JsonResponse
    {
        // Validation des données de la requête
        $validatedData = $request->validate([
            'poids' => 'required',
            'taille' => 'required',
            'performances' => 'required'
        ]);

        $progression->update($validatedData);

        return response()->json(['msg' => 'Progression updated successfully', 'data' => new ProgressionResource($progression)]);
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
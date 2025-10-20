<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function index()
    {
        return Company::select('id', 'name', 'logo')->get();
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|string', // Change to 'image' if uploading files
            'name' => 'required|string|max:255',
            'descripiton' => 'nullable|string', // typo kept as-is to match your DB field
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company = Company::create($validator->validated());

        return response()->json($company, 201);
    }


    // GET /api/companies/{id}
    public function show($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        return response()->json($company, 200);
    }

    // PUT /api/companies/{id}
    public function update(Request $request, $id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'logo' => 'nullable|string',
            'name' => 'sometimes|required|string|max:255',
            'descripiton' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $company->update($validator->validated());

        return response()->json($company, 200);
    }

    // DELETE /api/companies/{id}
    public function destroy($id)
    {
        $company = Company::find($id);

        if (!$company) {
            return response()->json(['message' => 'Company not found'], 404);
        }

        $company->delete();

        return response()->json(['message' => 'Company deleted successfully'], 200);
    }
}

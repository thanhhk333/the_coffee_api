<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    public function index($id = null)
    {
        try {
            if ($id) {
                $category = ProductCategory::findOrFail($id);
                return response()->json($category);
            } else {
                $categories = ProductCategory::all();
                return response()->json($categories);
            }
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|unique:product_category|max:255',
                'desc' => 'sometimes|max:255',
            ]);

            $category = ProductCategory::create($validatedData);
            return response()->json($category, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $category = ProductCategory::findOrFail($id);

            $validatedData = $request->validate([
                'name' => 'required|unique:product_category,name,' . $category->id . '|max:255',
            ]);

            $category->update($validatedData);

            return response()->json($category);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $category = ProductCategory::findOrFail($id);
            $category->delete();
            return response()->json(['message' => 'Category deleted successfully']);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Category not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function search(Request $request)
    {
        Log::info('Search method called with query: ' . $request->input('query'));

        $query = strtolower($request->input('query'));

        $categories = ProductCategory::whereRaw('LOWER(`name`) LIKE ?', ["%{$query}%"])
            ->orWhereRaw('LOWER(`desc`) LIKE ?', ["%{$query}%"])
            ->get();


        if (is_numeric($query)) {
            $idCategories = ProductCategory::where('id', $query)->get();
            $categories = $categories->concat($idCategories);
        }

        return response()->json($categories);
    }
}

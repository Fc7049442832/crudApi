<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            // Fetch all contacts
            $contacts = Contact::all();

            // Return a structured response
            return response()->json([
                'message' => 'Contacts retrieved successfully!',
                'total' => $contacts->count(),
                'data' => $contacts,
            ], 200);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'message' => 'An unexpected error occurred while fetching contacts',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validate the input
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:60', // Corrected typo from 'eamil' to 'email'
                'address' => 'nullable|string',
            ]);
    
            // Create the contact
            $contact = Contact::create($validated);
    
            // Return success response
            return response()->json([
                'message' => 'Contact created successfully!',
                'data' => $contact,
            ], 201);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $contact = Product::findOrFail($id);
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Find the contact or throw a 404 error if not found
            $contact = Contact::findOrFail($id);
    
            // Validate the input data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:60', // Corrected typo from 'eamil' to 'email'
                'address' => 'nullable|string',
            ]);
    
            // Update the contact with validated data
            $contact->update($validated);
    
            // Return success response
            return response()->json([
                'message' => 'Contact updated successfully!',
                'data' => $contact,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the contact is not found
            return response()->json([
                'message' => 'Contact not found',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            return response()->json([
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the contact or throw a 404 error if not found
            $contact = Contact::findOrFail($id);
    
            // Delete the contact
            $contact->delete();
    
            // Return success response with no content
            return response()->json([
                'message' => 'Contact deleted successfully!',
            ], 204);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the contact is not found
            return response()->json([
                'message' => 'Contact not found',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            // Handle unexpected errors
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
}

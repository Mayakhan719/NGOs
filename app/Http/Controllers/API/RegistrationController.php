<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    /**
     * Register a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'name_vswa' => 'required|string|max:255',
            'abbrevation_vswa' => 'required|string|max:255',
            'vswa_email' => 'required|string|email|max:255|unique:users,vswa_email',
            'vswa_phone' => 'required|string|max:15',
            'applicant_name' => 'required|string|max:255',
            'applicant_email' => 'required|string|email|max:255|unique:users,applicant_email',
            'applicant_mobile_no' => 'required|string|max:15',
            'applicant_type' => 'required|string|max:50',
            'password' => 'required|string|min:8|confirmed',
            'thematic_id' => 'required|exists:thematic_areas,id',
            'vswa_hq_id' => 'required|exists:vswa_head_quarters,id',
        ]);

        // If validation fails, return error response
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Create the user
        $user = User::create([
            'name_vswa' => $request->name_vswa,
            'abbrevation_vswa' => $request->abbrevation_vswa,
            'vswa_email' => $request->vswa_email,
            'vswa_phone' => $request->vswa_phone,
            'applicant_name' => $request->applicant_name,
            'applicant_email' => $request->applicant_email,
            'applicant_mobile_no' => $request->applicant_mobile_no,
            'applicant_type' => $request->applicant_type,
            'password' => Hash::make($request->password),
            'thematic_id' => $request->thematic_id,
            'vswa_hq_id' => $request->vswa_hq_id,
        ]);

        // Return success response with user data
        return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    }
    public function login(Request $request)
    {
        // Validate the request data
        $request->validate([
            'applicant_name' => 'required|string',
            'password' => 'required|string',
        ]);

        // Find the user by applicant_name
        $user = User::where('applicant_name', $request->applicant_name)->first();

        // Check if user exists and password is correct
        if ($user && Hash::check($request->password, $user->password)) {
            // Generate a new API token
            $token = $user->createToken('API Token')->plainTextToken;

            return response()->json([
                'message' => 'Login successful',
                'token' => $token,
                'user' => $user
            ], 200);
        }

        // Return error response if login fails
        return response()->json(['message' => 'Invalid credentials'], 401);
    }
}

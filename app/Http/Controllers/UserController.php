<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function login(Request $req)
    {
        // Find the user by email
        $user = User::where('email', $req->email)->first();

        // Check if user exists and if password matches
        if ($user || Hash::check($req->password, $user->password)) {
            // Redirect to home page if credentials are correct
            return redirect('/');
        } else {
            $req->session()->put('user',$user);
            // Return error message if credentials are incorrect
            return "Username or Password is not matched";
        }
    }
}

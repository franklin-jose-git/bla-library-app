<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function dashboard()
    {
        try {
            $currentUser = Auth::user();
            if ($currentUser->isLibrarian()){
                return response()->json([
                    'total_books'=> Book::total(),
                    'total_borrowed' => Book::totalBorrowed()->get()->count(),
                    'due_today_books' => Book::hasDueToday()->get(),
                    'overdue_books' => User::hasOverdueBooks()->get(),
                ], 200);
            }
            else {
                return response()->json([
                  //  ''=> '',
                    'overdue_books' => $currentUser->listOverdueBooks()->get(),
                ], 200);
            }
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

}

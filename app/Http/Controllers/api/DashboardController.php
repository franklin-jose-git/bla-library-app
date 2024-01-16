<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;

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
                $all_borrowings = $currentUser->borrowings()->with('book')->get();
                $borrowed_books = $all_borrowings->pluck('book');
                $borrowed_due_books = $all_borrowings->filter(function($item) {
                    return Carbon::parse($item['due_date'])->startOfDay() <= Carbon::now()->startOfDay() && $item['delivered'] == false;
                })->pluck('book');
                $borrowed_overdue_books = $all_borrowings->filter(function($item) {
                    return Carbon::parse($item['due_date'])->startOfDay() > Carbon::now()->startOfDay() && $item['delivered'] == false;
                })->pluck('book');
                return response()->json([
                    'borrowed_books' => $borrowed_books,
                    'borrowed_due_books' => $borrowed_due_books,
                    'borrowed_overdue_books' => $borrowed_overdue_books
                ], 200);
            }
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

}

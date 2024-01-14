<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;

class BorrowingController extends Controller
{
    public function get()
    {
        try {
            $data = Borrowing::all();
            return response()->json($data, 200);
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        try {
            $data['book_id']         = $request['book_id'];
            $data['user_id']         = $request['user_id'];

            $borrowing_date =  Carbon::now();
            $due_date =  Carbon::parse($borrowing_date)->addDays(20);
            $delivered = false;
            $delivered_date =  null;

            $data['borrowing_date']  = $borrowing_date;
            $data['due_date']        = $due_date;
            $data['delivered_date']  = $delivered_date;
            $data['delivered']       = $delivered;

            $book = Book::find($data['book_id'] );
            $user = User::find($data['user_id'] );

            $response = ["status"=>404,"message"=>"Wrong Data"];

            if ($book && $user)
            {
                $res = Borrowing::create($data);
                return response()->json($data, 200);
            }
            else {
                return response()->json($response, 500);
            }
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id)
    {
        try {
            $data = Borrowing::find($id);

            $response = ["status"=>404,"message"=>"Data not found"];

            if ($data)
            {
                return response()->json($data, 200);
            }
            else {
                return response()->json($response, 404);
            }

        }
        catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data['book_id']         = $request['book_id'];
            $data['user_id']         = $request['user_id'];
            $data['borrowing_date']  = $request['borrowing_date'];
            $data['due_date']        = $request['due_date'];
            $data['delivered_date']  = $request['delivered_date'];
            $data['delivered']       = $request['delivered'];

            $response = ["status"=>404,"message"=>"Data not found"];
            $res= Borrowing::find($id);

            if ($res)
            {
                Borrowing::find($id)->update($data);
                $response["status"] = 200;
                $response["message"]= "Updated Succesfully";
                return response()->json($response, 200);
            }
            else {
                $response["status"] = 404;
                $response["message"]= "Data not found";
                return response()->json($response, 404);
            }
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $data = Borrowing::find($id);
            if ($data)
            {
                $res = Borrowing::find($id)->delete();
                $response["status"] = 200;
                $response["message"]= "Deleted Succesfully";
                return response()->json($response, 200);
            }
            else {
                $response["status"] = 404;
                $response["message"]= "Data not found";
                return response()->json($response, 404);
            }
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}

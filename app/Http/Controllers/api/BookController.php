<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function get()
    {
        try {
            $data = Book::get();
            return response()->json($data, 200);
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function create(Request $request)
    {
        $this->authorize('add', Book::class);
        try {
            $data['title']          = $request['title'];
            $data['author']         = $request['author'];
            $data['genre']          = $request['genre'];
            $data['isbn']           = $request['isbn'];
            $data['total_copies']   = $request['total_copies'];

            $res = Book::create($data);
            return response()->json( $res, 201);
        }
        catch (\Throwable $th)
        {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }

    public function getById($id)
    {
        try {
            $data = Book::find($id);

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
        $this->authorize('edit', Book::class);
        try {
            $data['title']          = $request['title'];
            $data['author']         = $request['author'];
            $data['genre']          = $request['genre'];
            $data['isbn']           = $request['isbn'];
            $data['total_copies']   = $request['total_copies'];

            $res = Book::find($id);
            if ($res)
            {
                Book::find($id)->update($data);
                $response["status"] = 200;
                $response["message"]= "Updated Succesfully";
                return response()->json($response, 204);
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
        $this->authorize('delete', Book::class);
        try {
            $data = Book::find($id);
            if ($data)
            {
                $res = Book::find($id)->delete();
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

    public function search(Request $request)
    {
        try {
            $term = $request->input('term');

            $data = Book::where('title','like',"%$term%")
                ->orWhere('author','like',"%$term%")
                ->orWhere('genre','like',"%$term%")
                ->get();

            return response()->json($data, 200);
        }
        catch (\Throwable $th) {
            return response()->json([ 'error' => $th->getMessage()], 500);
        }
    }
}

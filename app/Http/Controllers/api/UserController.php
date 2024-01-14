<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function get()
    {
        try {
            $data = User::get();
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
            $data['name']          = $request['name'];
            $data['email']         = $request['email'];
            $data['password']      = Hash::make($request['password']);
            $data['usertype']      = $request['usertype'];

            $res = User::create($data);
            if ($res){
                return response()->json( $res, 200);
            }
            else{
                return response()->json( $res, 500);
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
            $data = User::find($id);

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
            $data['name']          = $request['name'];
            $data['email']         = $request['email'];
            $data['password']      = Hash::make($request['password']);
            $data['usertype']      = $request['usertype'];

            $res = User::find($id);
            if ($res)
            {
                User::find($id)->update($data);
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
            $data = User::find($id);
            if ($data)
            {
                $res = User::find($id)->delete();
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

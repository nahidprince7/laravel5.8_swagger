<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class ApiTestController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/api/testing/{mytest}/{name}",
     *   summary="Get Testing",
     *   operationId="testing",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     *		@SWG\Parameter(
     *          name="mytest",
     *          in="path",
     *          required=true,
     *          type="string"
     *      ),
     *     @SWG\Parameter(
     *          name="name",
     *          in="path",
     *          required=true,
     *          type="string"
     *      )
     * )
     *
     */
    public function index(Request $request){
//        dd($request);
        echo $request->mytest." ".$request->name;
    }
    /**
     * @SWG\Post(
     *   path="/api/users",
     *   summary="Get Testing",
     *   operationId="users",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=406, description="not acceptable"),
     *   @SWG\Response(response=500, description="internal server error"),
     * )
     *
     */
    public function getUser(){
        $users = User::all();
        return response($users);
    }
}

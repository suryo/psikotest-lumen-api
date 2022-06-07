<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Models\Vis_user;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{  
    
    protected $vis_provinsi;
    protected $vis_users;
    public function __construct(Vis_user $vis_users)
    {
        $this->vis_user = $vis_users;
    }
   
    public function index(Request $request)
    {
        if (!null == $this->vis_users->all()) {
            $result = app('db')->select('SELECT * FROM vis_users as u inner join peserta_models p on u.id = p.id_login');
            return response()->json(
                [
                    'data' => $result,
                    'message' => 'success'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'data' => 'null'
                ],
                200
            );
        }
    }
    
    public function getuserlogin(Request $request): JsonResponse
    {
        $username = ($request->username);
        $password = md5(($request->pwd));
        
        $arrayprovinsi = [];
        if (!null == $this->vis_user->all()) {
           
            
            $result = app('db')->select('SELECT * FROM vis_users as u inner join peserta_models p on u.id = p.id_login
        where u.username ="' . $username. '" AND u.password ="'. $password.'"');
      
            return response()->json(
                [
                    'data' => $result,
                    'message' => 'success'
                ],
                200
            );
        } else {
            return response()->json(
                [
                    'data' => 'null',
                    'message' => 'failed'
                ],
                200
            );
        }
    }
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $user = vis_user::create([
            'username'     => $request->username,
            'password'     => md5($request->password)
        ]);

        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  vis_user $user
     * @return \Illuminate\Http\Response
     */
    public function show(vis_user $user)
    {
        return new UserResource($user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  vis_user $user
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Put(
     *      path="/user/{id}",
     *      operationId="updateUser",
     *      tags={"Users"},
     *      summary="Update existing user",
     *      description="Returns updated user data",
     *      @OA\Parameter(
     *          name="id",
     *          description="User id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent()
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(Request $request, vis_user $user)
    {
        //  dd($request->username);
        //set validation
        // $validator = Validator::make($request->all(), [
        //     'username' => 'required',
        //     'password'   => 'required'
        // ]);

        // //response error validation
        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }

        //update to database
        $user->update([
            'username'     => $request->username,
            'password'     => md5($request->password)
        ]);

        return new UserResource($user);
    }
    public function getRequest(Request $request)
    {
        $req = $request->username;
        return $req;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  vis_user $user
     * @return \Illuminate\Http\Response
     */

     /**
     * @OA\Delete(
     *      path="/user/{id}",
     *      operationId="deleteUser",
     *      tags={"Users"},
     *      summary="Delete existing user",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(
     *          name="id",
     *          description="Users id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation",
     *          @OA\JsonContent()
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(vis_user $user)
    {
        $user->delete();

        return new UserResource($user);
    }
}

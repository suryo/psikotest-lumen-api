<?php

namespace App\Http\Controllers;

use Illuminate\Http\{Request, JsonResponse};
use App\Models\Peserta_model;
use App\Http\Controllers\Controller;
use App\Http\Resources\PesertaResource;
use Illuminate\Support\Facades\Validator;
// use App\Models\Provinsi;
use Illuminate\Support\Facades\DB;


class PesertaController extends Controller
{  
    
    protected $vis_provinsi;
    protected $peserta_models;
    public function __construct(Peserta_model $peserta_models)
    {
        
        $this->peserta_models = $peserta_models;
        
    }
   
    public function index(Request $request)
    {
        $checkuser = app('db')->select("SELECT * FROM peserta_models");
        if (!null == $checkuser) {
            $result = app('db')->select('SELECT * FROM peserta_models 
            -- as u inner join peserta_models p on u.id = p.id_login
            ');
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
        $checkuser = app('db')->select("SELECT * FROM peserta_models");
        // dump(!null ==$checkuser);
        // die;
        // dump($this->peserta_models->all());
        // die;
        $arrayprovinsi = [];
        if (!null == $checkuser) {
           
            
            $result = app('db')->select('SELECT * FROM peserta_models as u inner join peserta_models p on u.id = p.id_login
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
        $result = [];
        $data = ($request->json("data"));

        if (count($data) == 0) {
            $validator = Validator::make($request->all(), [
                'no_pendaftaran'   => 'required'
            ]);


            //response error validation
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }
        } else {
            for ($d = 0; $d < count($data); $d++) {
                //save to database
                $papi = papi_model::create([
                    'no_pendaftaran'     => $data[$d]["no_pendaftaran"],
                    'jwb1' => $data[$d]['jwb1'],
                    'jwb2' => $data[$d]['jwb2'],
                    'jwb3' => $data[$d]['jwb3'],
                    'jwb4' => $data[$d]['jwb4'],
                    'jwb5' => $data[$d]['jwb5']

                ]);
                $p = [
                    'name' => 'Insert Papi',
                    'no_pendaftaran' => $data[$d]["no_pendaftaran"],
                    'jwb1' => $data[$d]['jwb1'],
                    'jwb2' => $data[$d]['jwb2'],
                    'jwb3' => $data[$d]['jwb3'],
                    'jwb4' => $data[$d]['jwb4'],
                    'jwb5' => $data[$d]['jwb5'],
                    'status' => 'success', 'code' => 200
                ];
                array_push($result, $p);
            }
        }

        return new PapiResource($result);
    }

    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  vis_user $user
    //  * @return \Illuminate\Http\Response
    //  */
    // public function show(vis_user $user)
    // {
    //     return new UserResource($user);
    // }


    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @param  vis_user $user
    //  * @return \Illuminate\Http\Response
    //  */

    //  /**
    //  * @OA\Put(
    //  *      path="/user/{id}",
    //  *      operationId="updateUser",
    //  *      tags={"Users"},
    //  *      summary="Update existing user",
    //  *      description="Returns updated user data",
    //  *      @OA\Parameter(
    //  *          name="id",
    //  *          description="User id",
    //  *          required=true,
    //  *          in="path",
    //  *          @OA\Schema(
    //  *              type="integer"
    //  *          )
    //  *      ),
    //  *      @OA\RequestBody(
    //  *          required=true,
    //  *          @OA\JsonContent()
    //  *      ),
    //  *      @OA\Response(
    //  *          response=202,
    //  *          description="Successful operation",
    //  *          @OA\JsonContent()
    //  *       ),
    //  *      @OA\Response(
    //  *          response=400,
    //  *          description="Bad Request"
    //  *      ),
    //  *      @OA\Response(
    //  *          response=401,
    //  *          description="Unauthenticated",
    //  *      ),
    //  *      @OA\Response(
    //  *          response=403,
    //  *          description="Forbidden"
    //  *      ),
    //  *      @OA\Response(
    //  *          response=404,
    //  *          description="Resource Not Found"
    //  *      )
    //  * )
    //  */
    // public function update(Request $request, vis_user $user)
    // {
    //     //  dd($request->username);
    //     //set validation
    //     // $validator = Validator::make($request->all(), [
    //     //     'username' => 'required',
    //     //     'password'   => 'required'
    //     // ]);

    //     // //response error validation
    //     // if ($validator->fails()) {
    //     //     return response()->json($validator->errors(), 400);
    //     // }

    //     //update to database
    //     $user->update([
    //         'username'     => $request->username,
    //         'password'     => md5($request->password)
    //     ]);

    //     return new UserResource($user);
    // }
    // public function getRequest(Request $request)
    // {
    //     $req = $request->username;
    //     return $req;
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  vis_user $user
    //  * @return \Illuminate\Http\Response
    //  */

    //  /**
    //  * @OA\Delete(
    //  *      path="/user/{id}",
    //  *      operationId="deleteUser",
    //  *      tags={"Users"},
    //  *      summary="Delete existing user",
    //  *      description="Deletes a record and returns no content",
    //  *      @OA\Parameter(
    //  *          name="id",
    //  *          description="Users id",
    //  *          required=true,
    //  *          in="path",
    //  *          @OA\Schema(
    //  *              type="integer"
    //  *          )
    //  *      ),
    //  *      @OA\Response(
    //  *          response=204,
    //  *          description="Successful operation",
    //  *          @OA\JsonContent()
    //  *       ),
    //  *      @OA\Response(
    //  *          response=401,
    //  *          description="Unauthenticated",
    //  *      ),
    //  *      @OA\Response(
    //  *          response=403,
    //  *          description="Forbidden"
    //  *      ),
    //  *      @OA\Response(
    //  *          response=404,
    //  *          description="Resource Not Found"
    //  *      )
    //  * )
    //  */
    // public function destroy(vis_user $user)
    // {
    //     $user->delete();

    //     return new UserResource($user);
    // }
}

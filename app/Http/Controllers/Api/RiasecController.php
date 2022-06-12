<?php

namespace App\Http\Controllers\Api;

use App\Models\riasec_model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RiasecResource;
use Illuminate\Support\Facades\Validator;
use DB;

class RiasecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @OA\Get(
     *      path="/api/riasec",
     *      operationId="getRiasecList",
     *      tags={"RIASEC"},
     *      summary="Get list of riasec",
     *      description="Returns list of riasec",
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation",
     *          )
     *       )
     *     )
     */
    public function index()
    {
        $result = [];
        $result = app('db')->select('select * from riasec_models');
        // $result =  DB::select('select * from riasec_models');


        return response()->json(['data' => $result]);
    }

    public function getRiasecUserResult(Request $request)
    {   
          
  $r =  array(1, 7, 14, 22, 30, 32, 37);
  $i =  array(2, 11, 18, 21, 26, 33, 39);
  $a =  array(3, 8, 17, 23, 27, 31, 41);
  $s =  array(4, 12, 13, 20, 28, 34, 40);
  $e =  array(5, 10, 16, 19, 29, 36, 42);
  $c =  array(6, 9, 15, 24, 25, 35, 38);


        $result = app('db')->select( 'select no_pendaftaran as nop,username from `user` as us ORDER BY username ASC');

 $response=[];
for ($d = 0; $d < count($result); $d++) {
   
    $ss = 0;

    $rowriasec = app('db')->select('select * from `riasec_result` where no_pendaftaran = '.$result[$d]->nop);
    for ($j = 0; $j < count($rowriasec); $j++) {
        $rs =  0;
        $is =  0;
        $as =  0;
        $ss =  0;
        $es =  0;
        $cs =  0;
        $desk = " ";

        for ($x=0; $x<count($r); $x++)
        {
           
            $varrs = ('jawab'.$r[$x]);
            // dump(($varrs));
            // dump(($rowriasec[$j]->$varrs));
           
            if (($rowriasec[$j]->$varrs)=="x")
            {
                $rs = $rs + 1;
            }

        }


        // dump("is");
        for ($x=0; $x<count($i); $x++)
        {
            $varis = ('jawab'.$i[$x]);
            // dump(($varis));
            // dump(($rowriasec[$j]->$varis));
            if (($rowriasec[$j]->$varis)=="x")
            {
                $is = $is + 1;
            }
        }
        // dump("as");
        for ($x=0; $x<count($a); $x++)
        { 
            $varas = ('jawab'.$a[$x]);
            // dump(($rowriasec[$j]->$varas));
            if (($rowriasec[$j]->$varas)=="x")
            {
                $as = $as + 1;
            }
        }
   
        // dump("ss");
        for ($x=0; $x<count($s); $x++)
        {
            $varss = ('jawab'.$s[$x]);
            // dump(($varss));
            // dump(($rowriasec[$j]->$varss));
            if (($rowriasec[$j]->$varss)=="x")
            {
                $ss = $ss + 1;
            }
        }
        // dump("es");
        for ($x=0; $x<count($e); $x++)
        {
            $vares = ('jawab'.$e[$x]);
            // dump(($vares));
            // dump(($rowriasec[$j]->$vares));
            if (($rowriasec[$j]->$vares)=="x")
            {
                $es = $es + 1;
            }
        }
        // dump("cs");
        for ($x=0; $x<count($c); $x++)
        {
            $varcs = ('jawab'.$c[$x]);
            // dump(($varcs));
            // dump(($rowriasec[$j]->$varcs));
            if (($rowriasec[$j]->$varcs)=="x")
            {
                $cs = $cs + 1;
            }
        }


$total = array(
    'r' => $rs,
    'i' => $is,
    'a' => $as,
    's' => $ss,
    'e' => $es,
    'c' => $cs,
);

$max = max($total);

if($rs==$max)
{
   $desk = $desk."individu dengan minat ini biasanya memiliki keahlian atletik atau mekanik dan menyukai kegiatan luar ruangan dengan peralatan atau mesin. Ex: mekanik, ATC (air traffic controller), surveyor, ahli elektronik dan petani.<br>"; 
}

if($is==$max)
{
   $desk = $desk." Individu dengan minat ini biasanya memiliki keahlian sains dan matematika, menyukai kesendirian dalam pekerjaan maupun memecahkan masalah. Ex : ahli biologi,kimia, fisika, geologi, laboratorium dan penelitian termasuk teknisi medis.<br>"; 
}

if($as==$max)
{
   $desk = $desk." Individu dengan minat ini biasanya memiliki keahlian seni, menyenangi pekerjaan orisinal dan memiliki imajinasi tinggi. 
Ex : composer, musisi, pengarah panggung, penari, decorator,  aktor atau aktris dan penulis.<br>"; 
}

if($ss==$max)
	 {
		$desk = $desk." Individu dengan minat ini biasanya menyenangi keberadaan diri dalam sosial, tertarik bagaimana bergaul dengan situasi sosial dan suka membantu permasalahan orang lain. Ex : guru, terapis, pekerja religius, konselor, psikolog, perawat.<br>"; 
	 }

    }
    if($es==$max)
    {
       $desk = $desk." Individu dengan minat ini biasanya memiliki jiwa kepemimpinan, kemampuan berbicara di depan umum, tertarik dengan uang dan politik dan senang untuk mempengaruhi orang lain.<br>"; 
    }

    if($cs==$max)
    {
       $desk = $desk." Individu dengan minat ini biasanya memiliki keahlian klerikal dan matematika, menyukai pekerjaan dalam ruang dan mengelola sesuatu agar rapi (terorganisir). Ex: analis keuangan, pegawai perpustakaan, banking, ahli pajak, sekretaris, korespondensi, akunting.<br>"; 
    }

    //  dump($desk);
     $resriasec = [
        'status' =>  'ok',
        'no_pendaftaran' => $result[$d]->nop,
        'username' => $result[$d]->username,
        'r' => $rs,
        'i' => $is,
        'a' => $as,
        's' => $ss,
        'e' => $es,
        'c' => $cs,
        'deskripsi' => $desk
    ]; 

    array_push($response, $resriasec);

}
       
        

       
        // if (!empty($result))
        // {
        //     $result = [
        //         'name' => 'getuser',
        //         'status' =>  'ok',
        //         'no_pendaftaran' => $result[0]->no_pendaftaran,
        //         'meesage' => 'udah ada gaes'
        //     ];
        // }
        // else
        // {
        //     $result = [
        //         'name' => 'getuser',
        //         'status' =>  'null',
               
        //     ];
        // }

        return new RiasecResource($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    /**
     * @OA\POST(
     *     path="/api/riasec",
     *     summary="Create a Test",
     *     tags={"RIASEC"},
     *     @OA\RequestBody(
     *        required = true,
     *        description = "Data packet for Test",
     *        @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                property="data",
     *                type="array",
     *                @OA\Items(
     *                      @OA\Property(
     *                         property="no_pendaftaran",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab1",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab2",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab3",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab4",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab5",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab6",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab7",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab8",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab9",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab10",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab11",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab12",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab13",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab14",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab15",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab16",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab17",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab18",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab19",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab20",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab21",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab22",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab23",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab24",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab25",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab26",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab27",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab28",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab29",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab30",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab31",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab32",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab33",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab34",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab35",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab36",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab37",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab38",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab39",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab40",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab41",
     *                         type="string",
     *                         example=""
     *                      ),
     *                      @OA\Property(
     *                         property="jawab42",
     *                         type="string",
     *                         example=""
     *                      ),
     *                ),
     *             ),
     *        ),
     *     ),
     *
     *
     *     @OA\Response(
     *        response="200",
     *        description="Successful response",
     *     ),
     * )
     */
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
                $papi = riasec_model::create([
                    'no_pendaftaran'     => $data[$d]["no_pendaftaran"],
                    'jawab1' => $data[$d]['jawab1'],
                    'jawab2' => $data[$d]['jawab2'],
                    'jawab3' => $data[$d]['jawab3'],
                    'jawab4' => $data[$d]['jawab4'],
                    'jawab5' => $data[$d]['jawab5'],
                    'jawab6' => $data[$d]['jawab6'],
                    'jawab7' => $data[$d]['jawab7'],
                    'jawab8' => $data[$d]['jawab8'],
                    'jawab9' => $data[$d]['jawab9'],
                    'jawab10' => $data[$d]['jawab10'],
                    'jawab11' => $data[$d]['jawab11'],
                    'jawab12' => $data[$d]['jawab12'],
                    'jawab13' => $data[$d]['jawab13'],
                    'jawab14' => $data[$d]['jawab14'],
                    'jawab15' => $data[$d]['jawab15'],
                    'jawab16' => $data[$d]['jawab16'],
                    'jawab17' => $data[$d]['jawab17'],
                    'jawab18' => $data[$d]['jawab18'],
                    'jawab19' => $data[$d]['jawab19'],
                    'jawab20' => $data[$d]['jawab20'],
                    'jawab21' => $data[$d]['jawab21'],
                    'jawab22' => $data[$d]['jawab22'],
                    'jawab23' => $data[$d]['jawab23'],
                    'jawab24' => $data[$d]['jawab24'],
                    'jawab25' => $data[$d]['jawab25'],
                    'jawab26' => $data[$d]['jawab26'],
                    'jawab27' => $data[$d]['jawab27'],
                    'jawab28' => $data[$d]['jawab28'],
                    'jawab29' => $data[$d]['jawab29'],
                    'jawab30' => $data[$d]['jawab30'],
                    'jawab31' => $data[$d]['jawab31'],
                    'jawab32' => $data[$d]['jawab32'],
                    'jawab33' => $data[$d]['jawab33'],
                    'jawab34' => $data[$d]['jawab34'],
                    'jawab35' => $data[$d]['jawab35'],
                    'jawab36' => $data[$d]['jawab36'],
                    'jawab37' => $data[$d]['jawab37'],
                    'jawab38' => $data[$d]['jawab38'],
                    'jawab39' => $data[$d]['jawab39'],
                    'jawab40' => $data[$d]['jawab40'],
                    'jawab41' => $data[$d]['jawab41'],
                    'jawab42' => $data[$d]['jawab42']

                ]);
                $p = [
                    'name' => 'Insert Riasec',
                    'no_pendaftaran' => $data[$d]["no_pendaftaran"],
                    'jawab1' => $data[$d]['jawab1'],
                    'jawab2' => $data[$d]['jawab2'],
                    'jawab3' => $data[$d]['jawab3'],
                    'jawab4' => $data[$d]['jawab4'],
                    'jawab5' => $data[$d]['jawab5'],
                    'jawab6' => $data[$d]['jawab6'],
                    'jawab7' => $data[$d]['jawab7'],
                    'jawab8' => $data[$d]['jawab8'],
                    'jawab9' => $data[$d]['jawab9'],
                    'jawab10' => $data[$d]['jawab10'],
                    'jawab11' => $data[$d]['jawab11'],
                    'jawab12' => $data[$d]['jawab12'],
                    'jawab13' => $data[$d]['jawab13'],
                    'jawab14' => $data[$d]['jawab14'],
                    'jawab15' => $data[$d]['jawab15'],
                    'jawab16' => $data[$d]['jawab16'],
                    'jawab17' => $data[$d]['jawab17'],
                    'jawab18' => $data[$d]['jawab18'],
                    'jawab19' => $data[$d]['jawab19'],
                    'jawab20' => $data[$d]['jawab20'],
                    'jawab21' => $data[$d]['jawab21'],
                    'jawab22' => $data[$d]['jawab22'],
                    'jawab23' => $data[$d]['jawab23'],
                    'jawab24' => $data[$d]['jawab24'],
                    'jawab25' => $data[$d]['jawab25'],
                    'jawab26' => $data[$d]['jawab26'],
                    'jawab27' => $data[$d]['jawab27'],
                    'jawab28' => $data[$d]['jawab28'],
                    'jawab29' => $data[$d]['jawab29'],
                    'jawab30' => $data[$d]['jawab30'],
                    'jawab31' => $data[$d]['jawab31'],
                    'jawab32' => $data[$d]['jawab32'],
                    'jawab33' => $data[$d]['jawab33'],
                    'jawab34' => $data[$d]['jawab34'],
                    'jawab35' => $data[$d]['jawab35'],
                    'jawab36' => $data[$d]['jawab36'],
                    'jawab37' => $data[$d]['jawab37'],
                    'jawab38' => $data[$d]['jawab38'],
                    'jawab39' => $data[$d]['jawab39'],
                    'jawab40' => $data[$d]['jawab40'],
                    'jawab41' => $data[$d]['jawab41'],
                    'jawab42' => $data[$d]['jawab42'],
                    'status' => 'success', 'code' => 200
                ];
                array_push($result, $p);
            }
        }

        return new RiasecResource($result);

        // $validator = Validator::make($request->all(), [
        //     'no_pendaftaran'   => 'required'
        // ]);


        // if ($validator->fails()) {
        //     return response()->json($validator->errors(), 400);
        // }


        // $riasec_model = riasec_model::create([
        //     'no_pendaftaran'     => $request->no_pendaftaran
        // ]);

        // return new RiasecResource($riasec_model);
    }

    /**
     * Display the specified resource.
     *
     * @param  riasec_model $riasec_model
     * @return \Illuminate\Http\Response
     */
    public function show(riasec_model $riasec_model)
    {
        return new RiasecResource($riasec_model);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  riasec_model $riasec_model
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, riasec_model $riasec_model)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'no_pendaftaran'   => 'required'
        ]);

        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //update to database
        $riasec_model->update([
            'no_pendaftaran'     => $request->no_pendaftaran
        ]);

        return new RiasecResource($riasec_model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  riasec_model $riasec_model
     * @return \Illuminate\Http\Response
     */
    public function destroy(riasec_model $riasec_model)
    {
        $riasec_model->delete();

        return new RiasecResource($riasec_model);
    }
}

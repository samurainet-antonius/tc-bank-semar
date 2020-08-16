<?php

namespace App\Http\Controllers\v1;
use Laravel\Lumen\Routing\Controller as BaseController;
use \Illuminate\Http\Request;
use App\Models\Satuan;
use App\Helpers\FuncResponse;

class SatuanController extends BaseController
{
    use FuncResponse;
    public function __construct(){

    }

    public function index(Request $request){
        
        $data_satuan = Satuan::orderBy('id_satuan','desc')->get();

        if(count($data_satuan)<1)
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(count($data_satuan),0,0,$data_satuan);
    }

    public function create(Request $request){

        $nama_satuan = $request->input('nama_satuan');

        $data_satuan = Satuan::where('nama_satuan',$nama_satuan)->orderBy('id_satuan','desc')->get();

        if(count($data_satuan)<1){

            $formParams = [
                'nama_satuan' => $nama_satuan,
            ];
    
            Satuan::insert($formParams);
            return $this->responseData($formParams);
        }else{
            return $this->responseValidation("Nama satuan sudah terdaftar",$nama_satuan);
        }
    }

    public function update(Request $request,$uuid_satuan){

        $nama_satuan = $request->input('nama_satuan');

        $detail = Satuan::where('uuid',$uuid_satuan)->orderBy('id_satuan','desc')->first();
        
        $formParams = [
                'nama_satuan' => $nama_satuan,
            ];

        if($detail->nama_satuan == $nama_satuan){  
                Satuan::where("uuid",$uuid_satuan)->update($formParams);
                return $this->responseData($formParams);
        }else{

            $data_satuan = Satuan::where('nama_satuan',$nama_satuan)->orderBy('id_satuan','desc')->get();

            if(count($data_satuan)<1){
                Satuan::where("uuid",$uuid_satuan)->update($formParams);
                return $this->responseData($formParams);
            }else{
                return $this->responseValidation("Nama satuan sudah terdaftar",$nama_satuan);
            }

        }
    
    }

    public function detail(Request $request,$uuid_satuan){
        $satuan = Satuan::where("uuid",$uuid_satuan)->first();

        if(empty($satuan))
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(1,0,0,$satuan);
    }

    public function delete(Request $request,$uuid_satuan){

        Satuan::where('uuid',$uuid_satuan)->delete();
        $data="Data berhasil hapus";
        return $this->responseData($data);
    }
}

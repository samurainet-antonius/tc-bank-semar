<?php

namespace App\Http\Controllers\v1;
use Laravel\Lumen\Routing\Controller as BaseController;
use \Illuminate\Http\Request;
use App\Models\kategori;
use App\Helpers\FuncResponse;

class KategoriController extends BaseController
{
    use FuncResponse;
    public function __construct(){

    }

    public function index(Request $request){
        
        $data_kategori = kategori::orderBy('id_kategori','desc')->get();

        if(count($data_kategori)<1)
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(count($data_kategori),0,0,$data_kategori);
    }

    public function create(Request $request){

        $nama_kategori = $request->input('nama_kategori');

        $data_kategori = Kategori::where('nama_kategori',$nama_kategori)->orderBy('id_kategori','desc')->get();

        if(count($data_kategori)<1){

            $formParams = [
                'nama_kategori' => $nama_kategori,
            ];
    
            Kategori::insert($formParams);
            return $this->responseData($formParams);
        }else{
            return $this->responseValidation("Nama kategori sudah terdaftar",$nama_kategori);
        }
    }

    public function update(Request $request,$uuid_kategori){

        $nama_kategori = $request->input('nama_kategori');

        $detail = Kategori::where('uuid',$uuid_kategori)->orderBy('id_kategori','desc')->first();
        
        $formParams = [
                'nama_kategori' => $nama_kategori,
            ];

        if($detail->nama_kategori == $nama_kategori){  
                Kategori::where("uuid",$uuid_kategori)->update($formParams);
                return $this->responseData($formParams);
        }else{

            $data_kategori = kategori::where('nama_kategori',$nama_kategori)->orderBy('id_kategori','desc')->get();

            if(count($data_kategori)<1){
                kategori::where("uuid",$uuid_kategori)->update($formParams);
                return $this->responseData($formParams);
            }else{
                return $this->responseValidation("Nama kategori sudah terdaftar",$nama_kategori);
            }

        }
    
    }

    public function detail(Request $request,$uuid_kategori){
        $kategori = Kategori::where("uuid",$uuid_kategori)->first();

        if(empty($kategori))
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(1,0,0,$kategori);
    }

    public function delete(Request $request,$uuid_kategori){

        Kategori::where('uuid',$uuid_kategori)->delete();
        $data="Data berhasil hapus";
        return $this->responseData($data);
    }
}

<?php

namespace App\Http\Controllers\v1;
use Laravel\Lumen\Routing\Controller as BaseController;
use \Illuminate\Http\Request;
use App\Models\Toko;
use App\Helpers\FuncResponse;

class TokoController extends BaseController
{
    use FuncResponse;
    public function __construct(){

    }

    public function index(Request $request){
        $uuid_toko = (!empty($request->input('uuid_toko'))) ? $request->input('uuid_toko') : '';
        // $data=[];
        if(!empty($uuid_toko))
            $data_toko = Toko::where('uuid',$uuid_toko)->orderBy('id_toko','desc')->get();
        else
            $data_toko = Toko::all();

        if(count($data_toko)<1)
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(count($data_toko),0,0,$data_toko);
    }

    public function create(Request $request){
        $nama_toko = $request->input('nama_toko');
        $alamat_toko = $request->input('alamat_toko');
        $no_telpon_toko = $request->input('no_telpon_toko');

        $formParams = [
            'nama_toko' => $nama_toko,
            'alamat_toko' => $alamat_toko,
            'no_telpon_toko' => $no_telpon_toko
        ];

        Toko::insert($formParams);
        return $this->responseData($formParams);
    }

    public function update(Request $request,$uuid_toko){

        $nama_toko = $request->input('nama_toko');
        $alamat_toko = $request->input('alamat_toko');
        $no_telpon_toko = $request->input('no_telpon_toko');

        $formParams = [
            'nama_toko' => $nama_toko,
            'alamat_toko' => $alamat_toko,
            'no_telpon_toko' => $no_telpon_toko
        ];
    
        Toko::where("uuid",$uuid_toko)->update($formParams);
        return $this->responseData($formParams);
    
    }

    public function delete(Request $request,$uuid_toko){

        Toko::where('uuid',$uuid_toko)->delete();
        $data="Data berhasil hapus";
        return $this->responseData($data);
    }
}

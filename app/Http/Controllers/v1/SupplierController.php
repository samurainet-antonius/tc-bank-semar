<?php

namespace App\Http\Controllers\v1;
use Laravel\Lumen\Routing\Controller as BaseController;
use \Illuminate\Http\Request;
use App\Models\Supplier;
use App\Helpers\FuncResponse;

class SupplierController extends BaseController
{
    use FuncResponse;
    public function __construct(){

    }

    public function index(Request $request){

        $data_supplier = Supplier::orderBy('id_supplier','desc')->get();;

        if(count($data_supplier)<1)
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(count($data_supplier),0,0,$data_supplier);
    }

    public function create(Request $request){

        $kode_supplier = $request->input('kode_supplier');
        $nama_supplier = $request->input('nama_supplier');
        $kategori = explode("|",$request->input('kategori'));
        $alamat_supplier = $request->input('alamat_supplier');
        $no_hp_supplier = $request->input('no_hp_supplier');

        $data_karaywan = Supplier::where('kode_supplier',$kode_supplier)->orderBy('id_supplier','desc')->get();

        if(count($data_karaywan)<1){

            $formParams = [
                'kode_supplier' => $kode_supplier,
                'nama_supplier' => $nama_supplier,
                'uuid_kategori' => $kategori[1],
                'nama_kategori' => $kategori[0],
                'alamat_supplier' => $alamat_supplier,
                'no_hp_supplier' => $no_hp_supplier,
            ];
    
            Supplier::insert($formParams);
            return $this->responseData($formParams);
        }else{
            return $this->responseValidation("Kode Supplier sudah terdaftar",$kode_supplier);
        }
    }

    public function update(Request $request,$uuid_supplier){

        $kode_supplier = $request->input('kode_supplier');
        $nama_supplier = $request->input('nama_supplier');
        $kategori = explode("|",$request->input('kategori'));
        $alamat_supplier = $request->input('alamat_supplier');
        $no_hp_supplier = $request->input('no_hp_supplier');

        $detail = Supplier::where('uuid',$uuid_supplier)->orderBy('id_supplier','desc')->first();
        
        $formParams = [
                'kode_supplier' => $kode_supplier,
                'nama_supplier' => $nama_supplier,
                'uuid_kategori' => $kategori[1],
                'nama_kategori' => $kategori[0],
                'alamat_supplier' => $alamat_supplier,
                'no_hp_supplier' => $no_hp_supplier,
            ];

        if($detail->kode_supplier == $kode_supplier){  
                Supplier::where("uuid",$uuid_supplier)->update($formParams);
                return $this->responseData($formParams);
        }else{

            $data_karaywan = Supplier::where('kode_supplier',$kode_supplier)->orderBy('id_supplier','desc')->get();

            if(count($data_karaywan)<1){
                Supplier::where("uuid",$uuid_supplier)->update($formParams);
                return $this->responseData($formParams);
            }else{
                return $this->responseValidation("Kode Supplier sudah terdaftar",$kode_supplier);
            }

        }
    
    }

    public function detail(Request $request,$uuid_supplier){
        $supplier = Supplier::where("uuid",$uuid_supplier)->first();

        if(empty($supplier))
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(1,0,0,$supplier);
    }

    public function delete(Request $request,$uuid_supplier){

        Supplier::where('uuid',$uuid_supplier)->delete();
        $data="Data berhasil hapus";
        return $this->responseData($data);
    }
}

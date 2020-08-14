<?php

namespace App\Http\Controllers\v1;
use Laravel\Lumen\Routing\Controller as BaseController;
use \Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Helpers\FuncResponse;

class KaryawanController extends BaseController
{
    use FuncResponse;
    public function __construct(){

    }

    public function index(Request $request){
        $uuid_karyawan = (!empty($request->input('uuid_karyawan'))) ? $request->input('uuid_karyawan') : '';
        // $data=[];
        if(!empty($uuid_karyawan))
            $data_karaywan = Karyawan::where('uuid',$uuid_karyawan)->orderBy('id_karyawan','desc')->get();
        else
            $data_karyawan = Karyawan::all();

        if(count($data_karyawan)<1)
            return $this->responseDataNotFound();
        else
            return $this->responseDataLimitOffset(count($data_karyawan),0,0,$data_karyawan);
    }

    public function create(Request $request){
        $nik_karyawan = $request->input('nik_karyawan');
        $nama_karyawan = $request->input('nama_karyawan');
        $password = $request->input('password');
        $jabatan = $request->input('jabatan');
        $hak_akses = $request->input('hak_akses');
        $tanggal_masuk = $request->input('tanggal_masuk');
        $lama_bekerja = $request->input('lama_bekerja');
        $gaji = $request->input('gaji');

        $data_karaywan = Karyawan::where('nik_karyawan',$nik_karyawan)->orderBy('id_karyawan','desc')->get();

        if(count($data_karaywan)<1){
            $formParams = [
                'nik_karyawan' => $nik_karyawan,
                'nama_karyawan' => $nama_karyawan,
                'password' => password_hash($password,PASSWORD_DEFAULT),
                'jabatan' => $jabatan,
                'hak_akses' => $hak_akses,
                'tanggal_masuk' => $tanggal_masuk,
                'lama_bekerja' => $lama_bekerja,
                'gaji' => $gaji
            ];
    
            Karyawan::insert($formParams);
            return $this->responseData($formParams);
        }else{
            return $this->responseValidation("NIK karyawan sudah terdaftar",$nik_karyawan);
        }
    }

    public function update(Request $request,$uuid_karyawan){

        $nik_karyawan = $request->input('nik_karyawan');
        $nama_karyawan = $request->input('nama_karyawan');
        $password = $request->input('password');
        $jabatan = $request->input('jabatan');
        $hak_akses = $request->input('hak_akses');
        $tanggal_masuk = $request->input('tanggal_masuk');
        $lama_bekerja = $request->input('lama_bekerja');
        $gaji = $request->input('gaji');

        $detail = Karyawan::where('uuid',$uuid_karyawan)->orderBy('id_karyawan','desc')->first();
        
        $formParams = [
            'nik_karyawan' => $nik_karyawan,
            'nama_karyawan' => $nama_karyawan,
            'password' => password_hash($password,PASSWORD_DEFAULT),
            'jabatan' => $jabatan,
            'hak_akses' => $hak_akses,
            'tanggal_masuk' => $tanggal_masuk,
            'lama_bekerja' => $lama_bekerja,
            'gaji' => $gaji
        ];

        if($detail->nik_karyawan == $nik_karyawan){  
                Karyawan::where("uuid",$uuid_karyawan)->update($formParams);
                return $this->responseData($formParams);
        }else{

            $data_karaywan = Karyawan::where('nik_karyawan',$nik_karyawan)->orderBy('id_karyawan','desc')->get();

            if(count($data_karaywan)<1){
                Karyawan::where("uuid",$uuid_karyawan)->update($formParams);
                return $this->responseData($formParams);
            }else{
                return $this->responseValidation("NIK karyawan sudah terdaftar",$nik_karyawan);
            }

        }
    
    }

    public function delete(Request $request,$uuid_karyawan){

        Karyawan::where('uuid',$uuid_karyawan)->delete();
        $data="Data berhasil hapus";
        return $this->responseData($data);
    }
}

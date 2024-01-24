<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Kendaraan;
use App\Models\Transaksi;

class MainController extends Controller
{
    public function show(){

        $data['transaksi'] = Transaksi::select("*")->get();
        $data['kendaraan'] = Kendaraan::select("*")->get();

        return view('home',$data);
    }

    public function insertKendaraan(Request $request){
        $plat_nomor = $request->input('plat_nomor');

        $kendaraan = Kendaraan::select('*')->where("no_plat",$plat_nomor)->first();

        if(!$kendaraan){
            $kendaraan = new Kendaraan;
            $kendaraan->no_plat = $plat_nomor;
        } else {
            return json_encode(["status"=>0,"message"=>"No Plat Kendaraan Sudah Ada"]);
        }

        if($kendaraan->save()){
            return redirect('/');
        }
    }

    public function insertTransaksi(Request $request){
        $plat_nomor = $request->input('no_plat');

        $kendaraan = Kendaraan::select('*')->where("no_plat",$plat_nomor)->first();

        if(!$kendaraan){
            return json_encode(["status"=>0,"message"=>"Kendaraan Tidak Ditemukan"]);
        }

        $transaksi = Transaksi::select('*')->where("no_plat_kendaraan",$plat_nomor)->first();

        if($transaksi){
            return json_encode(["status"=>0,"message"=>"Kendaraan Sedang Digunakan"]);
        }

        $transaksi = new Transaksi;

        $transaksi->nama_customer = $request->input("nama");
        $transaksi->no_plat_kendaraan = $request->input("no_plat");
        $transaksi->tanggal_mulai_sewa = $request->input("tanggal_mulai_sewa");
        $transaksi->tanggal_selesai_sewa = $request->input("tanggal_selesai_sewa");
        $transaksi->harga_sewa = $request->input("harga_sewa");

        if($transaksi->save()){
            return redirect('/');
        }
    }
    public function deleteTransaksi($idTransaksi){

        $transaksi = Transaksi::select('*')->where("id",$idTransaksi)->first();

        if(!$transaksi){
            return json_encode(["status"=>0,"message"=>"Transaksi Tidak Ditemukan"]);
        }

        if($transaksi->delete()){
            return redirect('/');
        } else {
            return json_encode(["status"=>0,"message"=>"Transaksi Gagal Dihapus"]);
        }
    }

    public function deleteKendaraan($idKendaraan){
        $kendaraan = Kendaraan::select('*')->where("id",$idKendaraan)->first();

        if(!$kendaraan){
            return json_encode(["status"=>0,"message"=>"Kendaraan Tidak Ditemukan"]);
        }

        $transaksi = Transaksi::select('*')->where("no_plat_kendaraan",$kendaraan->no_plat)->first();

        if($transaksi){
            return json_encode(["status"=>0,"message"=>"Kendaraan Sedang Digunakan"]);
        }

        if($kendaraan->delete()){
            return redirect('/');
        } else {
            return json_encode(["status"=>0,"message"=>"Kendaraan Gagal Dihapus"]);
        }
    }


    public function editKendaraan(Request $request, $idKendaraan){
        $kendaraan = Kendaraan::select('*')->where("id",$idKendaraan)->first();

        if(!$kendaraan){
            return json_encode(["status"=>0,"message"=>"Kendaraan Tidak Ditemukan"]);
        } else {

            $transaksi = Transaksi::select('*')->where("no_plat_kendaraan",$kendaraan->no_plat)->first();

            if($transaksi){
                return json_encode(["status"=>0,"message"=>"Kendaraan Sedang Digunakan"]);
            }

            $kendaraan->no_plat = $request->input("no_plat");

            if($kendaraan->save()){
                return redirect('/');
            } else {
                return json_encode(["status"=>0,"message"=>"Kendaraan Gagal Di Edit"]);
            }
        }

    }

    public function editTransaksi(Request $request, $idTransaksi){
        $transaksi = Transaksi::select('*')->where("id",$idTransaksi)->first();

        if(!$transaksi){
            return json_encode(["status"=>0,"message"=>"Transaki Tidak Ditemukan"]);
        }

        $transaksi->nama_customer = $request->input("nama_customer");
        $transaksi->no_plat_kendaraan = $request->input("no_plat");
        $transaksi->tanggal_mulai_sewa = $request->input("tanggal_mulai_sewa");
        $transaksi->tanggal_selesai_sewa = $request->input("tanggal_selesai_sewa");
        $transaksi->harga_sewa = $request->input("harga_sewa");

        if($transaksi->save()){
            return redirect('/');
        } else {
            return json_encode(["status"=>0,"message"=>"Transaksi Gagal Di Edit"]);
        }

    }
}

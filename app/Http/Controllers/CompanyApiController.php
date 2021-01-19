<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\firmalar;
use App\Models\krokiler;
use App\Models\masalar;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use App\Http\Middleware\CompanyLoginControl;

class CompanyApiController extends Controller
{

    public function __construct()
    {
        $this->middleware(CompanyLoginControl::class)->except('Login');
    }
    function ApiVariablesCheck($data,$turkishData,$method) {
        switch ($method) {
            case 'GET':
                for($i=0;$i<count($data);$i++) {
                    if(!isset($_GET[$data[$i]]) || $_GET[$data[$i]] === 0 || $_GET[$data[$i]] === '') {
                        return $turkishData[$i] . ' İsimli Değer Boş Yada Tanımsız Olamaz';
                    }
                }
                break;
            case 'POST':
                for($i=0;$i<count($data);$i++) {
                    if(!isset($_POST[$data[$i]]) || $_POST[$data[$i]] === 0 || $_POST[$data[$i]] === '') {
                        return $turkishData[$i] . ' İsimli Değer Boş Yada Tanımsız Olamaz';
                    }
                }
                break;
            default:
                return 'Bilinmeyen method';
                break;
        }
        return 'Success';
    }
    function DisplayMessage($status,$message,$data) {
        $res["status"] = $status;
        $res["message"] = $message;
        if($data != "")
            $res["data"]=$data;
        return $res;
    }
    public function Login() {
        $controlResult = $this->ApiVariablesCheck(["email","password"],["E-Posta","Şifre"],"POST");
        if($controlResult != "Success") {
            $res = $this->DisplayMessage("error",$controlResult,"");
            return response($res,200)->header('Content-Type','application/json');
        }
        $company = firmalar::select('FirmaID')->where([['FirmaEmail',"=",$_POST["email"]],['FirmaSifre',"=",$_POST["password"]]])->first();
        if($company) {
            $data = ["FirmaID"=>$company['FirmaID']];
            $res = $this->DisplayMessage("success","Başarı ile giriş yaptınız.",$data);
            setcookie('FirmaID',$data["FirmaID"],time()+60*60*24*30*12,"/");
        } else {
            $res = $this->DisplayMessage("error","E-Posta veya Şifre Yanlış.","");
        }
        return response($res,200)->header('Content-Type','application/json');
    }
    public function Logout() {
        setcookie('FirmaID',"0",time()-60*60*24*30*12,"/");
        return Redirect::to('/firma/giris-yap');
    }
    public function State() {
        $this->middleware('CompanyLoginControl');
        $result = DB::table('krokiler as k')
                    ->select('k.KrokiID')
                    ->join("masalar as m","m.KrokiID","=","k.KrokiID","right")
                    ->where("k.FirmaID","=",$_COOKIE["FirmaID"])
                    ->get();
        $res = count($result) > 0 ? 1:0;
        return response($res,200);
    }
}

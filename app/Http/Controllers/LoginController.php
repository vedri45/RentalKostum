<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Costume;
use App\Customer;
use App\Transaction;
use App\Setting;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->costume = new Costume();
        $this->customer = new Customer();
        $this->transaction = new Transaction();
        $this->setting = new Setting();
    }

    public function username()
    {
        return 'username';
    }

    public function showLoginForm()
    {
        return view('backend.component.login', [
            'nama_toko' => $this->setting('nama-toko'),
        ]);
    }

    public function dashboard(){
        $costume = $this->costume;
        $customer = $this->customer;
        $transaction  = $this->transaction;
        $transaction_data = [];
        for($i=1;$i<=12;$i++){
            $lul = $this->transaction->whereMonth('created_at',sprintf('%02s',$i))->whereYear('created_at',date('Y'))->get()->count();
            $transaction_data [] = $lul;
        }
        $label = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
        $chartjs = app()->chartjs
         ->name('trans')
         ->type('line')
         ->size(['width' => 400, 'height' => 200])
         ->labels($label)
         ->datasets([
            [
                "label" => "Transaksi",
                'backgroundColor' => "rgba(78, 115, 223, 0.05)",
                'borderColor' => "#4e73df",
                "pointHoverRadius" => "3",
                "pointHitRadius"=> "10",
                "pointBorderWidth"=> "2",
                "pointBorderColor" => "#4e73df",
                "pointBackgroundColor" => "#4e73df",
                "pointHoverBackgroundColor" => "#4e73df",
                "pointHoverBorderColor" => "#4e73df",
                'data' => $transaction_data,
                // 'data' => [1,2,3,4,5,6,7,8,9,10,11,12]
            ]
        ])
         ->optionsRaw("{
             'animation': {
                 'duration': 2000
             }
         }");

        return view('backend.dashboard.index',compact(['costume','customer','transaction','chartjs']));
    }
    
    private function setting($slug)
    {
        $setting = Setting::where('slug', $slug)->first();
        return $setting ? $setting->description : null;
    }
}

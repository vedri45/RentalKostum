<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pages;
use App\Article;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OpenGraph;
use SEOMeta;
use App\Setting;
use App\Costume;
use App\CostumeImage;
use App\Customer;
use App\Manufacture;

class IndexController extends Controller
{
    public function __construct()
    {
        $this->setting = new Setting();
        $this->costume = new Costume();
        $this->images = new CostumeImage();
        $this->customer = new Customer();
        $this->manufactures = new Manufacture();
    }

    public function index(){
        $costume = $this->costume->all();
        $images = $this->images->with('costume')->get();
        $manufactures = $this->manufactures->orderBy('name', 'asc')->get();
        
        return view('frontend.layouts', compact('images', 'manufactures'));
    }

    public function contact() {
        return view('frontend.contact.index');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request = $request->merge(['slug'=>$request->name]);
            $this->customer->create($request->all());
            DB::commit();
            return redirect()->route('index.contact')->with('success-message','Terima kasih telah menghubungi kami');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error-message',$e->getMessage());
        }
    }

    public function filter(Request $request)
    {
        $query = $this->images->query();

        if ($request->has('search')) {
            $query->whereHas('costume', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->has('manufacture_id') && $request->manufacture_id) {
            $query->whereHas('costume.manufacture', function ($query) use ($request) {
                $query->where('id', $request->manufacture_id);
            });
        }

        $images = $query->with('costume.manufacture')->get();

        return view('frontend.partials.image_results', compact('images'));
    }
}

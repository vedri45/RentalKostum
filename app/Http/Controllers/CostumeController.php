<?php

namespace App\Http\Controllers;

use App\Costume;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use App\CostumeImage;
use Illuminate\Support\Str;

class CostumeController extends Controller
{

    public function __construct()
    {
        $this->costume = new Costume();
        $this->image = new CostumeImage();
    }

    public function index()
    {

        return view('backend.costume.index');
    }

    public function source(){
        $query= Costume::query();
        $query->with(['category']);
        return DataTables::eloquent($query)
        ->filter(function ($query) {
            if (request()->has('search')) {
                $query->where(function ($q) {
                    $q->where('name', 'LIKE', '%' . request('search')['value'] . '%');
                });
            }
            })
            ->addColumn('name', function ($data) {
                return str_limit($data->name,50);
            })
            ->addColumn('category', function ($data) {
                return title_case($data->category->name);
            })
            ->addColumn('license_number', function ($data) {
                return $data->license_number;
            })
            ->addColumn('color', function ($data) {
                return $data->color;
            })
            ->addColumn('year', function ($data) {
                return $data->year;
            })
            ->addColumn('price', function ($data) {
                return 'Rp. ' . number_format($data->price, 0, ',', '.');
            })
            ->addColumn('penalty', function ($data) {
                return 'Rp. ' . number_format($data->penalty, 0, ',', '.');
            })
            ->addColumn('status', function ($data) {
                return $data->status == 'tersedia' ? '<span class="badge badge-success">'.$data->status.'</span>':'<span class="badge badge-secondary">'.$data->status.'</span>';
            })
            ->addColumn('description', function ($data) {
                return str_limit(strip_tags($data->description,50));
            })
            ->addIndexColumn()
            ->addColumn('action', 'backend.costume.index-action')
            ->rawColumns(['action','status'])
            ->toJson();
    }

    public function create()
    {
        return view('backend.costume.create');
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $request = $request->merge(['slug'=> str_slug($request->name),'status'=>'tersedia']);
            $costume = $this->costume->create($request->all());
            $no=1;
            foreach($request->image as $row){
                $fileName = Str::uuid();
                $file = $row->storeAs(
                    'public/image/costume',$fileName.'.'.$row->extension()
                );
                $this->image->create([
                    'costume_id'=>$costume->id,
                    'image'=>'storage/image/costume/'.$fileName.'.'.$row->extension()
                ]);
            }
            DB::commit();
            return redirect()->route('costume.index')->with('success-message','Data telah disimpan');
        } catch (\exception $e) {
            DB::rollback();
            return redirect()->route('costume.index')->with('error-message',$e->getMessage());
        }


    }

    public function show($id)
    {
        $data = $this->costume->find($id);
        return $data;

    }

    public function edit($id)
    {
        $data = $this->costume->find($id);
        return view('backend.costume.edit',compact('data'));

    }

    public function update(Request $request, $id)
    {
        $request = $request->merge(['slug'=>str_slug($request->name)]);
        if($request->has('image')){
            foreach($request->image as $row){
                $fileName = Str::uuid();
                $file = $row->storeAs(
                    'public/image/costume',$fileName.'.'.$row->extension()
                );
                $this->image->create([
                    'costume_id'=>$id,
                    'image'=>'storage/image/costume/'.$fileName.'.'.$row->extension()
                ]);
            }
        }
        $this->costume->find($id)->update($request->all());
        return redirect()->route('costume.index')->with('success-message','Data telah dirubah');
    }

    public function destroy($id)
    {
         $this->costume->destroy($id);
         return redirect()->route('costume.index')->with('success-message','Data telah dihapus');

    }

    public function getImage($id){
        return $this->image->where('costume_id',$id)->get();
    }

    public function destroyImage($id){
        $this->image->destroy($id);
    }


}

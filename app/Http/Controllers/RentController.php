<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Setting;
use App\Costume;
use App\CostumeImage;
use App\Customer;
use App\CustomerImage;

class RentController extends Controller
{
    public function __construct()
    {
        $this->setting = new Setting();
        $this->costume = new Costume();
        $this->image = new CostumeImage();
        $this->customer = new Customer();
        $this->customerImage = new CustomerImage();
    }

    public function index($id)
    {
        $data = $this->costume->find($id);
        $customer = $this->customer->find($id);
        $image = $this->image->where('costume_id', $id)->first();
        return view('frontend.layouts', compact('data', 'image'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'nik' => 'required|string|max:255',
                'name' => 'required|string|max:255',
                'address' => 'required|string|max:255',
                'sex' => 'required|in:laki-laki,perempuan',
                'phone_number' => 'required|string|max:20',
                'image.*' => 'required|image|mimes:jpg,png,jpeg,gif|max:2048'
            ]);

            // Merge slug into validated data
            $validatedData['slug'] = $validatedData['name'];

            // Store the customer data
            $customer = $this->customer->create($validatedData);

            // Handle the image upload
            if ($request->hasFile('image')) {
                foreach ($request->image as $file) {
                    $fileName = Str::uuid() . '.' . $file->extension();
                    $file->storeAs('public/image/customer', $fileName);

                    $this->customerImage->create([
                        'customer_id' => $customer->id,
                        'image' => 'storage/image/customer/' . $fileName
                    ]);
                }
            }

            DB::commit();
            return response()->json(['success' => true]);

            // Commit the transaction
            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Rollback the transaction and return validation errors
            DB::rollback();
            return response()->json(['success' => false, 'error_message' => $e->errors()]);
        } catch (\Exception $e) {
            // Rollback the transaction and return generic error message
            DB::rollback();
            return response()->json(['success' => false, 'error_message' => $e->getMessage()]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants=Tenant::all()->map(function($tenant){
            return [
                "id" => $tenant->id,
                "company" => $tenant->company,
                "email" => $tenant->email,
                "phone" => $tenant->phone,
                "address" => $tenant->address
            ];
        });
        return Inertia::render("Tenants/Index", compact("tenants"));
        
    }


    public function create()
    {
        return Inertia::render("Tenants/Create");
    }

  
    public function store(Request $request)
    {
        // validasi
        $rules=[
            "company" => "required",
            "email" => "required|email|unique:tenants",
            "phone" => "required|unique:tenants",
            "address" => "required",
        ];
        $customMessages = [
            'company.required' => 'Kolom company tidak boleh kosong!.',
            'email.required' => 'Kolom email tidak boleh kosong!.',
            'phone.required' => 'Kolom phone tidak boleh kosong!.',
            'address.required' => 'Kolom address tidak boleh kosong!.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.unique' => 'Nomor sudah terdaftar.',
            "email.email" => "Harus format email!."
        ];
        $request->validate($rules, $customMessages);

        // tambah data ke database
        $tenant=Tenant::create([
            "company" => $request->company,
            "email" => $request->email,
            "phone" => $request->phone,
            "address" => $request->address
        ]);

        if($tenant) {
            return Redirect::route('tenants.index')->with('message', 'Data Berhasil Disimpan!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Tenant $tenant)
    {
        return Inertia::render("Tenants/Edit",[
            "tenant" => $tenant
        ]);
    }

   
    public function update(Request $request, Tenant $tenant)
    {
        $rules=[
            "company" => "required",
            "address" => "required",
        ];
        if($request->email != $tenant->email){
            $rules["email"]="required|email|unique:tenants|";
        }
        if($request->phone != $tenant->phone){
            $rules["phone"]="required|unique:tenants";
        }
        $customMessages = [
            'company.required' => 'Kolom company tidak boleh kosong!.',
            'email.required' => 'Kolom email tidak boleh kosong!.',
            'phone.required' => 'Kolom phone tidak boleh kosong!.',
            'address.required' => 'Kolom address tidak boleh kosong!.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone.unique' => 'Nomor sudah terdaftar.',
            "email.email" => "Harus format email!."
        ];
        $validatedData=$request->validate($rules, $customMessages);

        // tambah data ke database
        $tenant=Tenant::where("id", $tenant->id)->update($validatedData);

        if($tenant) {
            return Redirect::route('tenants.index')->with('message', 'Data Berhasil Diubah!');
        }
    }

  
    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return Redirect::route("tenants.index")>with('message', 'Data Berhasil Dihapus!'); 
    }
}

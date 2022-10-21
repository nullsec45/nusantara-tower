<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class UnitController extends Controller
{
    public function index()
    {
        $units=Unit::all()->map(function($unit){
            return [
                "id" => $unit->id,
                "nama" => $unit->nama,
                "lantai" => $unit->lantai,
                "area" => $unit->area,
            ];
        });
        return Inertia::render("Units/Index", compact("units"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return Inertia::render("Units/Create");
    }

  
    public function store(Request $request)
    {
        // validasi
        $rules=[
            "nama" => "required|min:5",
            "lantai" => "required|min:1",
            "area" => "required|min:5",
        ];
        $customMessages = [
            'nama.required' => 'Kolom nama tidak boleh kosong!.',
            'lantai.required' => 'Kolom lantai tidak boleh kosong!.',
            'area.required' => 'Kolom area tidak boleh kosong!.',
            "nama.min" => "Kolom nama minimal 5 karakter!.",
            "lantai.min" => "Kolom lantai minimal 1 karakter!.",
            "area.min" => "Kolom are minimal 3 karakter!.",
        ];
        $request->validate($rules, $customMessages);

        // tambah data ke database
        $unit=Unit::create([
            "nama" => $request->nama,
            "lantai" => $request->lantai,
            "area" => $request->area,
        ]);

        if($unit) {
            return Redirect::route('units.index')->with('message', 'Data Berhasil Disimpan');
        }
    }

  
    public function show($id)
    {
        //
    }


    public function edit(Unit $unit)
    {
        return Inertia::render("Units/Edit",[
            "unit" => $unit
        ]);
    }


    public function update(Request $request, Unit $unit)
    {
        $rules=[
            "nama" => "required|min:5",
            "lantai" => "required|min:1",
            "area" => "required|min:5",
        ];
        $customMessages = [
            'nama.required' => 'Kolom nama tidak boleh kosong!.',
            'lantai.required' => 'Kolom lantai tidak boleh kosong!.',
            'area.required' => 'Kolom area tidak boleh kosong!.',
            "nama.min" => "Kolom nama minimal 5 karakter!.",
            "lantai.min" => "Kolom lantai minimal 1 karakter!.",
            "area.min" => "Kolom are minimal 3 karakter!.",
        ];
        $validatedData=$request->validate($rules, $customMessages);

        // tambah data ke database
        $unit=Unit::where("id", $unit->id)->update($validatedData);

        if($unit) {
            return Redirect::route('units.index')->with('message', 'Data Berhasil Diubah');
        }
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return Redirect::route("units.index")>with('message', 'Data Berhasil Dihapus'); 
    }
}

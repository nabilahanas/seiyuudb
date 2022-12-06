<?php

namespace App\Http\Controllers;

use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    public function create()
    {
        return view('chara.add_agency');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_agency'=> 'required',
            'agency_name' => 'required',      
            'established' => 'required', 
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO agency(id_agency, agency_name, established) VALUES
        (:id_agency, :agency_name, :established)',
            [
                'id_agency' => $request->id_agency,
                'agency_name' => $request->agency_name,
                'established' => $request->established,
            ]
        );
        return redirect()->route('chara.index_agency')->with('success', 'Data agency berhasil disimpan');
    }
    public function index()
    {
        $datas = DB::select('SELECT * FROM `agency` WHERE is_deleted = 0');
        return view('chara.index_agency')->with('datas', $datas);
    }

    public function edit($id)
    {
        $data = DB::table('agency')->where('id_agency', $id)->first();
        return view('chara.edit_agency')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'id_agency' => 'required',
            'agency_name' => 'required',
            'established' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE agency SET id_agency = :id_agency, agency_name = :agency_name, established = :established
            WHERE id_agency = :id',
            [
                'id' => $id,
                'id_agency' => $request->id_agency,
                'agency_name' => $request->agency_name,
                'established' => $request->established,
            ]
        );
        return redirect()->route('chara.index_agency')->with('success', 'Data agency berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('agency')
        ->where('id_agency', $id)
        ->delete();
    
        return redirect()->route('chara.index_agency')->with('success', 'Data has been successfully deleted');
    }
    public function softDelete($id)
        {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::update('UPDATE agency SET is_deleted = 1
            WHERE id_agency = :id_agency', ['id_agency' => $id]);
            return redirect()->route('chara.index_agency')->with('success', 'Data has been successfully deleted');
        }
        public function restore()
        {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::table('agency')
            ->update(['is_deleted' => 0]);
            return redirect()->route('chara.index_agency')->with('success', 'Data successfully restored');
        }
    }
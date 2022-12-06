<?php

namespace App\Http\Controllers;

use App\Models\VA;
use App\Models\Agency;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class VAController extends Controller
{
    public function create()
    {
        return view('chara.add_va');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_va' => 'required',
            'va_name' => 'required',      
            'birthdate' => 'required',
            'id_agency' => 'required', 
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO va(id_va, va_name, birthdate, id_agency) VALUES
        (:id_va, :va_name, :birthdate, :id_agency)',
            [
                'id_va' => $request->id_va,
                'va_name' => $request->va_name,
                'birthdate' => $request->birthdate,
                'id_agency' => $request->id_agency,
            ]
        );
        return redirect()->route('chara.index_va')->with('success', 'Data voice actor berhasil disimpan');
    }
    public function index()
    {
        $datas = DB::select('select * from va where is_deleted = 0');
        return view('chara.index_va')->with('datas', $datas);
    }

    public function edit($id)
    {
        $data = DB::table('va')->where('id_va', $id)->first();
        return view('chara.edit_va')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'id_va' => 'required',
            'va_name' => 'required',      
            'birthdate' => 'required',
            'id_agency' => 'required', 
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE va SET id_va = :id_va, va_name = :va_name, birthdate = :birthdate, id_agency = :id_agency
            WHERE id_va = :id',
            [
                'id' => $id,
                'id_va' => $request->id_va,
                'va_name' => $request->va_name,
                'birthdate' => $request->birthdate,
                'id_agency' => $request->id_agency,
            ]
        );
        return redirect()->route('chara.index_va')->with('success', 'Data voice actor berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('va')
        ->where('id_va', $id)
        ->delete();
    
        return redirect()->route('chara.index_va')->with('success', 'Data has been successfully deleted');
    }
    public function softDelete($id)
        {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::update('UPDATE va SET is_deleted = 1
            WHERE id_va = :id_va', ['id_va' => $id]);
            return redirect()->route('chara.index_va')->with('success', 'Data has been successfully deleted');
        }
    public function restore()
        {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::table('va')
            ->update(['is_deleted' => 0]);
            return redirect()->route('chara.index_va')->with('success', 'Data successfully restored');
        }
}
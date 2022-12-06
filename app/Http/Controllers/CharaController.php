<?php

namespace App\Http\Controllers;

use App\Models\Chara;
use App\Models\VA;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class CharaController extends Controller
{
    public function create()
    {
        return view('chara.add');
    }
    public function store(Request $request)
    {
        $request->validate([
            'id_chara' =>'required',
            'chara_name' => 'required',      
            'chara_from' => 'required', 
            'id_va' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::insert(
            'INSERT INTO chara(id_chara, chara_name, alt_name, chara_from, id_va) VALUES
        (:id_chara, :chara_name, :alt_name, :chara_from, :id_va)',
            [
                'id_chara' => $request->id_chara,
                'chara_name' => $request->chara_name,
                'alt_name' => $request->alt_name,
                'chara_from' => $request->chara_from,
                'id_va' => $request -> id_va,
            ]
        );
        return redirect()->route('chara.index')->with('success', 'Data character berhasil disimpan');
    }
    public function index()
    {
        $datas = DB::select('select * from chara where is_deleted = 0');
        return view('chara.index')->with('datas', $datas);
    }

    public function edit($id)
    {
        $data = DB::table('chara')->where('id_chara', $id)->first();
        return view('chara.edit')->with('data', $data);
    }
    public function update($id, Request $request)
    {
        $request->validate([
            'id_chara' =>'required',
            'chara_name' => 'required',      
            'chara_from' => 'required', 
            'id_va' => 'required',
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::update(
            'UPDATE chara SET id_chara = :id_chara, chara_name = :chara_name, alt_name = :alt_name, chara_from = :chara_from, id_va = :id_va
            WHERE id_chara = :id',
            [
                'id' => $id,
                'id_chara' => $request->id_chara,
                'chara_name' => $request->chara_name,
                'alt_name' => $request->alt_name,
                'chara_from' => $request->chara_from,
                'id_va' => $request -> id_va,
            ]
        );
        return redirect()->route('chara.index')->with('success', 'Data chara berhasil diubah');
    }

    public function delete($id) {
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        DB::table('chara')
        ->where('id_chara', $id)
        ->delete();
    
        return redirect()->route('chara.index')->with('success', 'Data has been successfully deleted');
    }
    public function softDelete($id)
        {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::update('UPDATE chara SET is_deleted = 1
            WHERE id_chara = :id_chara', ['id_chara' => $id]);
            return redirect()->route('chara.index')->with('success', 'Data has been successfully deleted');
        }
        public function restore()
        {
            // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
            DB::table('chara')
            ->update(['is_deleted' => 0]);
            return redirect()->route('chara.index')->with('success', 'Data successfully restored');
        }

        public function indexSum()
    {
        $datas = DB::select('select * from 
        (SELECT chara.chara_name, chara.alt_name, chara.chara_from, va.va_name, agency.agency_name, chara.is_deleted
        FROM chara
        LEFT JOIN va
        ON chara.id_va = va.id_va
        left JOIN agency
        on va.id_agency = agency.id_agency)tb 
        WHERE is_deleted = 0');
        return view('chara.index_summary')->with('datas', $datas);
    }

    /*public function searchSum(Request $request)
    {
        $request->validate([
            'chara_name' => 'required',      
        ]);
        // Menggunakan Query Builder Laravel dan Named Bindings untuk valuesnya
        $datas = DB::select('select * from 
        (SELECT chara.chara_name, chara.alt_name, chara.chara_from, va.va_name, agency.agency_name, chara.is_deleted
        FROM chara
        LEFT JOIN va
        ON chara.id_va = va.id_va
        left JOIN agency
        on va.id_agency = agency.id_agency)tb 
        WHERE chara_name = :chara_name and is_deleted = 0', ['chara_name' => $request->chara_name,]);
        return view('chara.index_summary')->with('datas', $datas);
    }*/

    public function searchSum(Request $request) {
        if($request->has('search')){
            $datas = DB::select('SELECT chara.chara_name, chara.alt_name, chara.chara_from, va.va_name, agency.agency_name, chara.is_deleted
            FROM chara
            LEFT JOIN va
            ON chara.id_va = va.id_va
            left JOIN agency
            on va.id_agency = agency.id_agency 
            WHERE chara_name like :search',[
                'search'=>'%'.$request->search.'%',
            ]);

        return view('chara.index_summary')
            ->with('datas', $datas);
        }
        else {
            $datas = DB::select('SELECT chara.chara_name, chara.alt_name, chara.chara_from, va.va_name, agency.agency_name, chara.is_deleted
            FROM chara
            LEFT JOIN va
            ON chara.id_va = va.id_va
            left JOIN agency
            on va.id_agency = agency.id_agency');

        return view('chara.index_summary')
            ->with('datas', $datas);
        }
    }
}


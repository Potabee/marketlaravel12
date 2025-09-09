<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataBarang;
use App\Models\KatBarang;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class DataBarangController extends Controller
{
    /**
     * Tampilkan halaman Data Barang (atau JSON kalau request dari DataTables)
     */
    public function index(Request $request)
    {
        // Jika request dari DataTables (AJAX)
        if ($request->ajax()) {
            // ambil data barang beserta relasi kategori
            $data = DataBarang::with('kategori')->select('databarang.*');
            // filter berdasarkan kategori jika ada
            if ($request->has('kategori') && !empty($request->kategori)) {
                $data->where('kategori_id', $request->kategori);
            }

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('kategori', function ($row) {
                    return $row->kategori->kategoribarang ?? '-';
                })
                ->editColumn('hargabeli', function ($row) {
                    return number_format($row->hargabeli, 0, ',', '.');
                })
                ->editColumn('hargajual1', function ($row) {
                    return number_format($row->hargajual1, 0, ',', '.');
                })
                ->editColumn('hargajual2', function ($row) {
                    return number_format($row->hargajual2, 0, ',', '.');
                })
                ->editColumn('hargajual3', function ($row) {
                    return number_format($row->hargajual3, 0, ',', '.');
                })
                ->addColumn('aksi', function ($row) {
                    $btn = '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $row->id . '">Edit</button>';
                    $btn .= ' <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })
                ->rawColumns(['aksi'])
                ->make(true);
        }

        // Jika bukan request AJAX, tampilkan view biasa
        $kategoribarang = KatBarang::all();
        return view('admin.dataBarang', compact('kategoribarang'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'kodebarang'  => 'required|string|max:50',
            'namabarang'  => 'required|string|max:100',
            'kategori_id' => 'required|exists:katbarang,id',
            'satuan'      => 'required|string|max:20',
            'hargabeli'   => 'required|numeric',
            'hargajual1'  => 'required|numeric',
            'hargajual2'  => 'nullable|numeric',
            'hargajual3'  => 'nullable|numeric',
        ]);

        $barang = DataBarang::create([
            'kodebarang'  => $request->kodebarang,
            'namabarang'  => $request->namabarang,
            'kategori_id' => $request->kategori_id, // hanya id yang disimpan
            'satuan'      => $request->satuan,
            'hargabeli'   => $request->hargabeli,
            'hargajual1'  => $request->hargajual1,
            'hargajual2'  => $request->hargajual2,
            'hargajual3'  => $request->hargajual3,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil disimpan',
            'data'    => $barang,
        ]);
    }
    public function generateKode()
    {
        $lastBarang = \App\Models\DataBarang::orderBy('id', 'desc')->first();

        if ($lastBarang) {
            $lastKode = intval(substr($lastBarang->kodebarang, 1));
            $newKode = 'K' . str_pad($lastKode + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newKode = 'K001';
        }

        return response()->json(['kode' => $newKode]);
    }
    public function edit($id)
    {
        $barang = DataBarang::find($id);
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => $barang,
        ]);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'kodebarang'  => 'required|string|max:50',
            'namabarang'  => 'required|string|max:100',
            'kategori_id' => 'required|exists:katbarang,id',
            'satuan'      => 'required|string|max:20',
            'hargabeli'   => 'required|numeric',
            'hargajual1'  => 'required|numeric',
            'hargajual2'  => 'nullable|numeric',
            'hargajual3'  => 'nullable|numeric',
        ]);

        $barang = DataBarang::find($id);
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang tidak ditemukan',
            ], 404);
        }

        $barang->update([
            'kodebarang'  => $request->kodebarang,
            'namabarang'  => $request->namabarang,
            'kategori_id' => $request->kategori_id, // hanya id yang disimpan
            'satuan'      => $request->satuan,
            'hargabeli'   => $request->hargabeli,
            'hargajual1'  => $request->hargajual1,
            'hargajual2'  => $request->hargajual2,
            'hargajual3'  => $request->hargajual3,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil diupdate',
            'data'    => $barang,
        ]);
    }
    public function destroy($id)
    {
        $barang = DataBarang::find($id);
        if (!$barang) {
            return response()->json([
                'success' => false,
                'message' => 'Data barang tidak ditemukan',
            ], 404);
        }

        $barang->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data barang berhasil dihapus',
        ]);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\KatBarang;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;


class KatBarangController extends Controller
{
    /**
     * Menampilkan halaman daftar kategori barang.
     */

    public function index(Request $request)
    {
        $data = KatBarang::all();
        if ($request->ajax()) {
            return datatables()->of($data)->addIndexColumn('aksi')
                ->addColumn('aksi', function ($row) {
                    $btn = '<button class="btn btn-sm btn-primary btn-edit" data-id="' . $row->id . '">Edit</button>';
                    $btn .= ' <button class="btn btn-sm btn-danger btn-delete" data-id="' . $row->id . '">Hapus</button>';
                    return $btn;
                })

                ->rawColumns(['aksi'])
                ->make(true);
        }

        return view('admin.katbarang');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kategoribarang' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        KatBarang::create([
            'kategoribarang' => $request->kategoribarang,
        ]);

        return response()->json(['success' => 'Kategori barang berhasil ditambahkan.']);
    }
    public function destroy($id)
    {
        $kategori = KatBarang::findOrFail($id);
        $kategori->delete();

        return response()->json(['success' => 'Kategori barang berhasil dihapus.']);
    }
    public function edit($id)
    {
        $kategori = KatBarang::findOrFail($id);
        return response()->json($kategori);
    }
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'kategoribarang' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $kategori = KatBarang::findOrFail($id);
        $kategori->update([
            'kategoribarang' => $request->kategoribarang,
        ]);

        return response()->json(['success' => 'Kategori barang berhasil diperbarui.']);
    }
}

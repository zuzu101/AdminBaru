<?php

namespace App\Http\Controllers\Back\MasterData;

use App\Http\Controllers\Controller;
use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('back.master-data.pelanggan.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('back.master-data.pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email',
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        Pelanggan::create($request->all());

        return redirect()->route('admin.master_data.pelanggan.index')
                        ->with('success', 'Data pelanggan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('back.master-data.pelanggan.show', compact('pelanggan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('back.master-data.pelanggan.edit', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pelanggan,email,' . $id,
            'telepon' => 'required|string|max:20',
            'alamat' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status' => 'required|in:aktif,nonaktif',
        ]);

        $pelanggan->update($request->all());

        return redirect()->route('admin.master_data.pelanggan.index')
                        ->with('success', 'Data pelanggan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();

        return redirect()->route('admin.master_data.pelanggan.index')
                        ->with('success', 'Data pelanggan berhasil dihapus');
    }

    /**
     * Get data for DataTables
     */
    public function data()
    {
        $pelanggan = Pelanggan::select(['id', 'nama', 'email', 'telepon', 'status', 'created_at']);
        
        return datatables($pelanggan)
            ->addColumn('actions', function ($row) {
                return '
                    <div class="btn-group" role="group">
                        <a href="' . route('admin.master_data.pelanggan.edit', $row->id) . '" 
                           class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form action="' . route('admin.master_data.pelanggan.destroy', $row->id) . '" 
                              method="POST" style="display:inline;" 
                              onsubmit="return confirm(\'Yakin ingin menghapus?\')">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-danger btn-sm">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </div>
                ';
            })
            ->addIndexColumn()
            ->rawColumns(['actions'])
            ->make(true);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;
use App\Models\Pekerjaan;

class PegawaiController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');

        $pegawai = Pegawai::with('pekerjaan')
            ->when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', "%{$keyword}%")
                      ->orWhere('email', 'like', "%{$keyword}%");
            })
            ->paginate(10);

        return view('pegawai.index', compact('pegawai'));
    }

    public function add()
    {
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.add', compact('pekerjaan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email',
            'pekerjaan_id' => 'required|exists:pekerjaan,id',
            'gender' => 'required|in:male,female',
            'is_active' => 'required|boolean',
        ]);

        $pegawai = new Pegawai();
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->pekerjaan_id = $request->pekerjaan_id;
        $pegawai->gender = $request->gender;
        $pegawai->is_active = $request->is_active;
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil ditambahkan');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pekerjaan = Pekerjaan::all();
        return view('pegawai.edit', compact('pegawai', 'pekerjaan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:pegawai,email,'.$id,
            'pekerjaan_id' => 'required',
            'gender' => 'required',
            'is_active' => 'required',
        ]);

        $pegawai = Pegawai::findOrFail($id);
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->pekerjaan_id = $request->pekerjaan_id;
        $pegawai->gender = $request->gender;
        $pegawai->is_active = $request->is_active;
        $pegawai->save();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $pegawai->delete();

        return redirect()->route('pegawai.index')->with('success', 'Pegawai berhasil dihapus');
    }
}
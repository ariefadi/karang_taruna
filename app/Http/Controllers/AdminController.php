<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Admin;
use Dotenv\Util\Str;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller {

    public function index() {
        $admins = Admin::all();
        return view('admin.index', compact('admins'));
    }

    public function create() {
        return view('admin.add');
    }

    public function store(Request $request) {
        // validasi
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:20',
            'alamat' => 'required',
            'no_telp' => 'required|min:11|max:13',
            'email' => 'required|email',
            'status' => 'required|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'no_telp.required' => 'No Telp minimal 11 karakter',
            'email.email' => 'Format email tidak valid',
            'status.required' => 'Status tidak boleh kosong',
            'foto.max' => 'Foto Maximal 2MB',
            'foto.mimes' => 'Extensii harus berupa jpeg,png,jpg',
            'foto.image' => 'File harus berupa gambar',
        ]);

        // jika foto tidak kosong
        if(!empty($request->foto)) {
            $filename = 'foto-'.time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('image'), $filename);
        } else {
            $filename = 'user.png';
        }

        // proses tambah data
        DB::table('admins')->insert([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'status' => $request->status,
            'foto' => $filename,
        ]);

        return redirect()->route('admin.index')->with('success', 'Data berhasil ditambahkan');
    }

    public function edit(Admin $id) {
        return view('admin.edit', compact('id'));
    }

    public function update(Request $request, string $id) {
        // validasi
        $request->validate([
            'nama' => 'required|max:255',
            'jenis_kelamin' => 'required|max:20',
            'alamat' => 'required',
            'no_telp' => 'required|min:11|max:13',
            'email' => 'required|email',
            'status' => 'required|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ],[
            'nama.required' => 'Nama tidak boleh kosong',
            'jenis_kelamin.required' => 'Jenis Kelamin tidak boleh kosong',
            'alamat.required' => 'Alamat tidak boleh kosong',
            'no_telp.required' => 'No Telp minimal 11 karakter',
            'email.email' => 'Format email tidak valid',
            'status.required' => 'Status tidak boleh kosong',
            'foto.max' => 'Foto Maximal 2MB',
            'foto.mimes' => 'Extensii harus berupa jpeg,png,jpg',
            'foto.image' => 'File harus berupa gambar',
        ]);

        // foto lama
        $fotoLama = DB::table('admins')->select('foto')->where('id', $id)->get();
        foreach ($fotoLama as $item) {
            $fotoLama = $item->foto;
        }

        // jika foto tidak kosong
        if(!empty($request->foto)) {
            if(!empty($fotoLama->foto)) unlink(public_path('image').$fotoLama->foto);
            $filename = 'foto-'.time() . '.' . $request->foto->extension();
            $request->foto->move(public_path('image'), $filename);
        } else {
            $filename = 'user.png';
        }

        DB::table('admins')->where('id', $id)->update([
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
            'status' => $request->status,
            'foto' => $filename,
        ]);

        return redirect()->route('admin.index')->with('success', 'Data berhasil diubah');
    }

    public  function delete(Admin $id) {
        $id->delete();
        return redirect()->route('admin.index')->with('success', 'Data berhasil dihapus');
    }
}

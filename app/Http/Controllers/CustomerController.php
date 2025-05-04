<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth; 
use Laravel\Socialite\Facades\Socialite; 
use Illuminate\Support\Facades\Hash;
use App\Helpers\ImageHelper; 

class CustomerController extends Controller
{
    // Redirect ke Google 
    public function redirect() 
    { 
        return Socialite::driver('google')->redirect(); 
    } 

    // Callback dari Google 
    public function callback() 
    { 
        try {
            $socialUser = Socialite::driver('google')->stateless()->user(); 
            // Cek apakah email sudah terdaftar 
            $registeredUser = User::where('email', $socialUser->email)->first(); 
 
            if (!$registeredUser) { 
                // Buat user baru 
                $user = User::create([ 
                    'nama' => $socialUser->name, 
                    'email' => $socialUser->email, 
                    'role' => '2', // Role customer 
                    'status' => 1, // Status aktif 
                    'password' => Hash::make('default_password'), // Password default 
                ]); 
 
                // Buat data customer 
                Customer::create([ 
                    'user_id' => $user->id, 
                    'google_id' => $socialUser->id, 
                    'google_token' => $socialUser->token 
                ]); 
 
                // Login pengguna baru 
                Auth::login($user); 
            } else { 
                // Jika email sudah terdaftar, langsung login 
                Auth::login($registeredUser); 
            } 
 
            // Redirect ke halaman utama 
            return redirect()->intended('beranda'); 
        } catch (\Exception $e) { 
            // Redirect ke halaman utama jika terjadi kesalahan 
            echo $e;
            die;
            return redirect('/')->with('error', 'Terjadi kesalahan saat login dengan Google.'); 
        } 
    } 
 
    public function logout(Request $request) 
    { 
        Auth::logout(); // Logout pengguna 
        $request->session()->invalidate(); // Hapus session 
        $request->session()->regenerateToken(); // Regenerate token CSRF 
 
        return redirect('/')->with('success', 'Anda telah berhasil logout.'); 
    } 

    public function index()
    {
        $customer = Customer::orderBy('id', 'desc')->get();
        return view('backend.v_customer.index', [
            'judul' => 'Customer',
            'sub' => 'Halaman Customer',
            'index' => $customer
        ]);
    }

    public function akun($id)
    {
        $loggedInCustomerId = Auth::user()->id;
        // Cek apakah ID yang diberikan sama dengan ID customer yang sedang login 
        if ($id != $loggedInCustomerId) { 
            // Redirect atau tampilkan pesan error 
        return redirect()->route('customer.akun', ['id' => $loggedInCustomerId])->with('msgError', 'Anda tidak berhak mengakses akun ini.'); 
        } 
        $customer = Customer::where('user_id', $id)
        ->join('user', 'user.id', '=', 'customer.user_id')
        ->firstOrFail(); 
        return view('v_customer.edit', [ 
            'judul' => 'Customer', 
            'subJudul' => 'Akun Customer', 
            'edit' => $customer 
        ]); 
    }

    public function updateAkun(Request $request, $id) 
    { 
        $customer = Customer::where('user_id', $id)->firstOrFail(); 
        $rules = [ 
            'nama' => 'required|max:255', 
            'hp' => 'required|min:10|max:13', 
            'foto' => 'image|mimes:jpeg,jpg,png,gif|file|max:1024', 
        ]; 

        $messages = [ 
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.', 
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.' 
        ];

        if ($request->email != $customer->user->email) { 
            $rules['email'] = 'required|max:255|email|unique:customer'; 
        } 
        if ($request->alamat != $customer->alamat) { 
            $rules['alamat'] = 'required'; 
        } 
        if ($request->pos != $customer->pos) { 
            $rules['pos'] = 'required'; 
        }

        $validatedData = $request->validate($rules, $messages); 
        // menggunakan ImageHelper 
        if ($request->file('foto')) { 
            //hapus gambar lama 
            if ($customer->user->foto) { 
                $oldImagePath = public_path('storage/img-user/') . $customer->user->foto; 
                if (file_exists($oldImagePath)) { 
                    unlink($oldImagePath); 
                } 
            } 
            $file = $request->file('foto'); 
            $extension = $file->getClientOriginalExtension(); 
            $originalFileName = date(format: 'YmdHis') . '_' . uniqid() . '.' . $extension; 
            $directory = 'storage/img-user/'; 
            // Simpan gambar dengan ukuran yang ditentukan 
            ImageHelper::uploadAndResize($file, $directory, $originalFileName, 385, 400); 
            // Simpan nama file asli di database 
            $validatedData['foto'] = $originalFileName; 
        } 
     
        $customer->user->update($validatedData); 
     
        $customer->update([ 
            'alamat' => $request->input('alamat'), 
            'pos' => $request->input('pos'), 
        ]); 

        return redirect()->route('customer.akun', $id)->with('success', 'Data berhasil diperbarui'); 
    } 

    // backend
    // edit data
    public function edit(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.v_customer.edit', [
        'judul' => 'Edit Customer',
        'edit' => $customer
        ]);
    }

    // update data
    public function update(Request $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $user = $customer->user;

        $rules = [
            'nama' => 'required|max:255',
            'email'=> 'required|email|max:255|unique:user,email,' . $user->id,
            'alamat' => 'required',
            'pos' => 'required|min:4',
            'foto' => 'image|mimes:jpeg,jpg,png,gif|max:1024',
        ];

        $messages = [
            'foto.image' => 'Format gambar gunakan file dengan ekstensi jpeg, jpg, png, atau gif.',
            'foto.max' => 'Ukuran file gambar Maksimal adalah 1024 KB.'
        ];

        $validatedData = $request->validate($rules, $messages);

        // Tangani upload foto jika ada
        if ($request->hasFile('foto')) {
            // Hapus gambar lama jika ada
            if ($user->foto) {
                $oldImagePath = public_path('storage/img-user/') . $user->foto;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }

            $file = $request->file('foto');
            $extension = $file->getClientOriginalExtension();
            $filename = date('YmdHis') . '_' . uniqid() . '.' . $extension;
            $destination = 'storage/img-user/';

            // Upload & Resize pakai helper
            \App\Helpers\ImageHelper::uploadAndResize($file, $destination, $filename, 385, 400);

            $user->foto = $filename;
        }

        // Update relasi User
        $user->nama = $validatedData['nama'];
        $user->email = $validatedData['email'];
        $user->save();

        // Update Customer
        $customer->alamat = $validatedData['alamat'];
        $customer->pos = $validatedData['pos'];
        $customer->save();
        

    return redirect()->route('backend.customer.index')->with('success', 'Data berhasil diperbaharui');
    }

    // Detail customer data
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return view('backend.v_customer.show', [
        'judul' => 'Profile Customer',
        'detail' => $customer
        ]);
    }

}
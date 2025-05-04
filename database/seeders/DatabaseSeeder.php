<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Anggota;
use App\Models\User;
use App\Models\Kategori;



class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        #data anggota
    Anggota::create([
        'nama' => 'Sopian Aji',
        'hp' => '085123456781',
        ]);
    Anggota::create([
        'nama' => 'Husni Faqih',
        'hp' => '085123456782',
        ]);
    Anggota::create([
        'nama' => 'Rousyati',
        'hp' => '085123456783',
        ]);

        #data user
    User::create([
        'nama' => 'Administrator',
        'email' => 'admin@gmail.com',
        'role' => '1',
        'status' => 1,
        'hp' => '0812345678901',
        'password' => bcrypt('P@55word'),
        ]);
        #untuk record berikutnya silahkan, beri nilai berbeda pada nilai: nama, email, hp dengan nilai masing-masing anggota kelompok
    User::create([
        'nama' => 'Seo Jintae',
        'email' => 'seojintae@gmail.com',
        'role' => '0',
        'status' => 1,
        'hp' => '081234567892',
        'password' => bcrypt('s3ojintae'),
        ]);
        #data kategori
Kategori::create([
    'nama_kategori' => 'Brownies',
    ]);
    Kategori::create([
    'nama_kategori' => 'Combro',
    ]);
    Kategori::create([
    'nama_kategori' => 'Dawet',
    ]);
    Kategori::create([
    'nama_kategori' => 'Mochi',
    ]);
    Kategori::create([
    'nama_kategori' => 'Wingko',
    ]);
    
        
    }
}

<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        Kategori::create([
            'kategori' => 'Makanan',
        ]);
        Kategori::create([
            'kategori' => 'Minuman',
        ]);

        Produk::create([
            'kategori_id' => 1,
            'nama' => 'Nasi Goreng',
            'harga' => 10000,
            'ketersediaan' => 1,
        ]);

        Produk::create([
            'kategori_id' => 2,
            'nama' => 'Es Teh',
            'harga' => 5000,
            'ketersediaan' => 1,
        ]);

        // Order::create([
        //     'nama_customer' => 'Abdul',
        //     'total_harga' => 25000,
        // ]);

        // OrderDetail::create([
        //     'order_id' => 1,
        //     'produk_id' => 1,
        //     'jumlah' => 2,
        //     'total_harga' => 20000,
        // ]);

        // OrderDetail::create([
        //     'order_id' => 1,
        //     'produk_id' => 2,
        //     'jumlah' => 1,
        //     'total_harga' => 5000,
        // ]);
    }
}

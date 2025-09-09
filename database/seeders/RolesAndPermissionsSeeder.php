<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // === BUAT PERMISSIONS ===
        // Manajemen Produk
        // Manajemen Produk
        Permission::firstOrCreate(['name' => 'Lihat Produk']);
        Permission::firstOrCreate(['name' => 'Buat Produk']);
        Permission::firstOrCreate(['name' => 'Edit Produk']);
        Permission::firstOrCreate(['name' => 'Hapus Produk']);

        // Manajemen Transaksi
        Permission::firstOrCreate(['name' => 'Liat Transaksi']);
        Permission::firstOrCreate(['name' => 'Buat Transaksi']);
        Permission::firstOrCreate(['name' => 'refund transactions']);

        // Manajemen Pelanggan
        Permission::firstOrCreate(['name' => 'Lihat Customers']);
        Permission::firstOrCreate(['name' => 'Edit Customers']);

        // Manajemen Laporan & Pengguna
        Permission::firstOrCreate(['name' => 'Liat Laporan']);
        Permission::firstOrCreate(['name' => 'Kelola Users']);

        // Manajemen Kategori (baru)
        Permission::firstOrCreate(['name' => 'Lihat Kategori']);
        Permission::firstOrCreate(['name' => 'Tambah Kategori']);
        Permission::firstOrCreate(['name' => 'Tambah Barang']);
        Permission::firstOrCreate(['name' => 'Kelola Akun']);


        // === BUAT ROLES DAN BERIKAN PERMISSIONS ===

        // 1. Role Sales
        $salesRole = Role::firstOrCreate(['name' => 'sales']);
        $salesRole->givePermissionTo([
            'Lihat Produk',
            'Buat Produk',
            'Edit Produk',
            'Lihat Customers',
            'Edit Customers',
            'Liat Transaksi',
            'Buat Transaksi',
        ]);

        // 2. Role Kasir
        $kasirRole = Role::firstOrCreate(['name' => 'kasir']);
        $kasirRole->givePermissionTo([
            'Liat Transaksi',
            'Buat Transaksi',
            'refund transactions',
        ]);

        // 3. Role Admin mendapatkan semua izin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // === BUAT PENGGUNA CONTOH DAN BERIKAN ROLE ===

        // Buat Admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@example.com'], // cek berdasarkan email
            [
                'name' => 'Admin Toko',
                'password' => Hash::make('1234'),
            ]
        );
        $adminUser->assignRole($adminRole);

        // Buat Sales
        $salesUser = User::firstOrCreate(
            ['email' => 'sales@example.com'],
            [
                'name' => 'Sales Toko',
                'password' => Hash::make('1234'),
            ]
        );
        $salesUser->assignRole($salesRole);

        // Buat Kasir
        $kasirUser = User::firstOrCreate(
            ['email' => 'kasir@example.com'],
            [
                'name' => 'Kasir Toko',
                'password' => Hash::make('1234'),
            ]
        );
        $kasirUser->assignRole($kasirRole);
    }
}

# Rencana Kedepan
**Hari 1: Setup Database dan Migrations
Setup lingkungan database (MySQL/PostgreSQL).**
- Buat file migrasi untuk tabel-tabel utama (seperti menus, categories, users, orders).
- Definisikan struktur tabel untuk menus (nama, deskripsi, harga, URL gambar) dan categories (nama).
- Jalankan migrasi untuk menerapkan perubahan.
Setup model dasar untuk Menu, Category, dan User.

**Hari 2: Eloquent ORM dan Relationships**
- Implementasi relasi Eloquent.
- Setup metode controller dasar untuk mengambil dan menampilkan data di view.
- Uji relasi Eloquent dengan menampilkan data di Blade view ($category->menus).

**Hari 3: Database Seeding dan Model Factories**
- Buat seeder untuk tabel menus dan categories
- Implementasi model factory
- Isi database dengan data dummy dalam jumlah besar untuk pengujian (contoh: 50-100 menu)

**Hari 4: N+1 Problem dan Optimisasi**
- Identifikasi potensi masalah query N+1 
- eager load relasi jika diperlukan.
- Uji performa query dan optimalkan query yang lambat.

**Hari 5: Redesign UI dengan Tailwind CSS**
- Redesain tampilan UI untuk listing menu dan halaman-halaman penting lainnya (kategori, pesanan, dll.) menggunakan Tailwind CSS.
- Responsivitas dan tampilan halaman utama, menu, dan navigasi.
- Implementasikan fitur UI baru untuk interaksi pengguna

**Hari 6: Search dan Pagination**
- Implementasikan search bar agar pengguna bisa mencari menu berdasarkan nama, kategori, atau deskripsi.
- Buat fitur pencarian di controller dan kirim hasil pencarian ke view.
- Menambahkan pagination pada listing menu.
- Tampilkan hasil paginasi dengan styling Tailwind untuk pagination.

**Hari 7: Finishing dan Testing**
# Youtube Link
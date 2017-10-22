# Tugas IF5192 - Simple Blog


## Deskripsi Singkat
.... your description .... must go here

## Anggota Tim
Setiap kelompok beranggotakan **3 orang**. Mulai dari NIM terkecil

## Petunjuk Pengerjaan
 * Buatlah Group pada gitlab dengan nama sesuai dengan nama tim (Kelompok-X).
 * Tambahkan anggota tim pada Group tsb dan akun `@yudis`
 * Fork repository ini dengan kelompok yang telah dibuat.
 * Ubah hak akses repository hasil Fork anda menjadi private.
 * Silakan commit pada repository anda (hasil fork).
   * http://gitlab.informatika.org/IF5192-2017/Kelompk-X/tugas-kecil
 * Anda dan anggota Kelompok-K ini akan bekerja pada fork tersebut.
 * Lakukan berberapa commit dengan pesan yang bermakna, contoh: `fix css`, `create post done`, jangan seperti `final`, `benerin dikit`. Disarankan untuk tidak melakukan commit dengan perubahan yang besar karena akan mempengaruhi penilaian (contoh: hanya melakukan satu commit kemudian dikumpulkan). Sebaiknya commit dilakukan setiap ada penambahan fitur. **Commit dari setiap anggota tim akan mempengaruhi penilaian.** Jadi, setiap anggota tim harus melakukan commit yang berpengaruh terhadap proses pembuatan aplikasi.
 * Edit file readme ini semenarik mungkin (gunakan panduan Markdown language), diperbolehkan untuk merubah struktur dari readme ini.
   * http://gitlab.informatika.org/IF5192-2017/Kelompk-X/tugas-kecil/wikis/home 
 * Letakkan dokumentasi dari analysis dan desain sebagai Wiki dengan format Markdown.
 * Pada Readme 
   * terdapat tampilan aplikasi
   * penjelasan mengenai pembagian tugas masing-masing anggota (lihat formatnya pada bagian **pembagian tugas**)
   * prosedur instalasi
 * Merge request dari repository anda ke repository ini dengan format Nama kelompok - NIM terkecil - Nama Lengkap dengan NIM terkecil sebelum Sabtu, 28 Oktober 2017 17.00.

## Spesifikasi
### Manajemen Pengguna
 * Melakukan listing pengguna
 * Mengelola login-password
 * Meng-enforce akses kontrol 
 
Asumsi: 
* porses pendaftaran pengguna
* pendefinisian akses kontrol
dilakukan oleh sistem lain. Note: Didefinisikan langsung di  basis data -- insert query

### List Post

List Post merupakan halaman awal blog yang berisi daftar post yang sudah pernah dibuat. Setiap item pada list post mengandung `Judul`, `Tanggal`, `Konten`. Terdapat juga menu untuk mengedit dan menghapus item post tersebut.

### Add Post

Add Post merupakan halaman untuk menambahkan post baru.  Post baru memiliki form untuk mengisi `Judul`, `Tanggal`, dan `Konten`. Lakukan **validasi** untuk tanggal dengan javascript agar tanggal yang dimasukkan lebih besar atau sama dengan tanggal saat menambahkan post baru tersebut.

### Edit Post

Mengedit post yang sudah pernah dibuat. Form yang ditampilkan sama seperti saat menambahkan form baru.

### Delete Post

Menghapus post yang sudah pernah dibuat. Lakukan **konfimasi** dengan javascript untuk konfirmasi pengguna terhadap penghapusan post tersebut. Keluarkan konfirmasi berisi pesan berikut

    Apakah Anda yakin menghapus post ini?

Jika pengguna memilih `yes` maka post terhapus, jika tidak maka post tidak jadi dihapus.

### View Post

Halaman View Post merupakan halaman untuk melihat suatu post. Pada halaman ini terdapat informasi `Judul`, `Tanggal`, dan `Konten`, serta **Komentar** (spesifikasi di bawah).

### Komentar

Komentar berisi daftar komentar yang ditulis untuk post tertentu. Form komentar terdiri dari `Nama`, `Email`, dan `Komentar`, simpan juga tanggal dibuatnya komentar tersebut. Setiap item pada list komentar berisi `Nama`, `Tanggal`, `Komentar`.

Lakukan **validasi** email pada form komentar dengan menggunakan javascript. Komentar dibuat dengan menggunakan AJAX. Pemanggilan AJAX dilakukan saat

- Load list komentar
- Menambahkan komentar baru

## Tools

 * Untuk backend, wajib menggunakan **PHP** atau **Java Web Technology** dengan menggunakan JAX-WS
 * Gunakan **MySQL**, **SQLite**, File untuk menyimpan data.
 * Struktur Folder
   * `src` soruce code java
   * `lib` Library yang dibutuhkan oleh  Project
   * `build` build terhadap source code
   * `test` test cases

## Kriteria Penilaian
  * Kualitas pencapaian fungsionalitas dari Simple Blog
  * Security measures/mechanisms yang di-implement dalam Simple Blog

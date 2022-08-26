# Bayosapp Development

- Type : Online Shop
- Target Release : 30 September 2022
- Stack : Laravel - Vue

## Goals
Bayosapp dibuat dengan tujuan :
- Mempermudah pengelolaan produk dari bayos appareal
- Mempermudah dalam pemasaran produk lewat halaman belanja dari aplikasi
- Pencatatan seluruh catatan keluar-masuk keuangan

## Pengguna
Bayosapp ditargetkan memiliki pengguna,
- Super Administrator, pengguna dengan kemampuan seluruh fitur pengelolaan + administrator.
- Administrator, sebagai pengelola core dari aplikasi bisnis, seperti pengelola data master produk, pengolahan order, pengelolaan transaksi, perubahan status order, dan pengelolaan pengguna.
- Customer, sebagai target pengunjung / pembeli dari produk.

## Fitur

### Pengelolaan Data Master
Data master meliputi,
- Data Produk
- Data Kategori Produk
- Data Varian Produk
- Data Grup Varian Produk
- Data Order Status
- Data Order Item Status

Action pada data master meliputi
- Penambahan, perubahan, penghapusan seluruh data master

Actor 
- Super Administrator, Administrator

### Pengelolaan Data Order
Pengelolaan data order meliputi,
- Seluruh data order terbaru yang belum diproses (_Pending_)
- Seluruh data order yang dibagi kedalam kategori [Data Order Status]() pada data master.

Action,
- Perubahan status pada setiap order (cth. _Completed, Refund, Declice_ dan lain lain.)

Actor,
- Super Administrator, Administrator

### Pengelolaan Data Transaksi
Pengelolaan data transaksi meliputi 
- semua order dengan status _Completed_ dan bukti pembayaran telah diserahkan.

Action, 
- Penambahan data transaksi memasukkan secara manual seluruh data order , transaksi dan customer.
- Pengunggahan bukti pembayaran oleh _Administrator_ dengan tipe file gambar(png/jpeg).
- Pembatalan transaksi dengan standar bukti atau parameter pembayaran lainnya (cth. nominal tidak sesuai, dll) tidak valid.

Actor, 
- Super Administrator, Administrator

### Pengelolaan Data Customer (Administrator)
Pengelolaan data pengguna meliputi,
- semua data customer 
- semua data alamat customer
- akumulasi (order, transaksi, dll) dari customer

Action,
- Penolakan (pembatalan) pendaftaran anggota baru.
- Penambahan secara manual data customer untuk kebutuhan tertentu.

Actor, 
- Super Administrator, Administrator

### Pemesanan Produk / Ordering

Customer, 
- Seluruh / beberapa produk harus di display di halaman utama / tertentu untuk mempermudah customer melakukan pemilihan.
- Customer bisa menentukan varian (ukuran, warna, dll) dari produk.
- Customer bisa melakukan pemilihan alamat tujuan pengiriman barang.
- Penyelesaian pemesanan dilakukan hanya jika _customer_ telah terdaftar sebagai pengguna dari app.
- Penyelesaian pembayaran harus dialihkan ke halaman petunjuk pembayaran untuk memberikan informasi tentang bagaimana proses penyelesaiaan transaksi. Status order berubah menjadi _Menunggu Pembayaran_.
- Penyelesaiaan transaksi dilakukan dengan memilih metode pembayaran (bank transfer, ovo, dana, dll) [**Opsi#1**]
- Penyelesaiaan transaksi dilakukan dengan melakukan pembayaran manual oleh customer dan mengunggah nominal dan bukti pembayaran ke halaman yang ditentukan. [jika **Opsi#1** tidak disediakan]
- Pemesanan diselesaikan dan customer dialihkan ke halaman pemesanan untuk mendapatkan informasi lebih lanjut. Status order berubah menjadi _Menunggu Persetujuan_

Administrator, 
- Pesanan terbaru ditampilkan ke halaman order terbaru.
- Administrator bisa merubah status order menjadi _Diproses_ (jika produk tersedia, pembayaran valid).
- Administrator bisa merubah status order menjadi _Dikirim_ (jika produk telah siap dikirimkan)
- Administrator bisa merubah status order menjadi _Selesai_ (jika seluruh proses pemesanan dan transaksi telah selesai dan valid)
- Administrator bisa merubah status order menjadi _Dikembalikan_ (jika pesanan dianggap tidak sesuai dengan permintaan customer)
- Administrator bisa merubah status menjadi _Ditolak_ (jika salah satu parameter pemesanan tidak valid).

### Pengelolaan Order (Customer)
Pengelolaan Order meliputi,
- Seluruh pesanan yang dilakukan oleh customer
- Seluruh pesanan yang masih dalam proses tertentu (cth. _Menunggu Persetujuan, Menunggu Pembayaran, Pending, Dikirim, Ditolak, Selesai_ dan lain lain).
- Melakukan pembatalan pemesanan jika status pesanan masih _Menunggu Persetujuan_.
- Melakukan refund jika barang terbukti tidak sesuai dengan pemesanan.

### Standard Features
- User (Customer and Administrator) Management
- Role Management
- Log (analytics) pengunjung / google analytics
- Login / Register
- Customer Support (redirect to whatsapp)
- etc

## Dokumentasi Teknik

### Roles

- SUPER_ADMINISTRATOR (1) is a 
- ADMINISTRATOR (2) is a
- CUSTOMER (3) is a 
- GUEST (999) is a

### User Activity Diagram

@todo

### Sequence Diagram

@todo

### Relasi

![](../../../Bayos/Development/bayos-relationship-diagram-v1.png)

### Routes

List routes yang tersedia bisa dilihat di [https://docs.google.com/spreadsheets/d/1cpDq2Zl0elKoXD53L-GCg687fma7OTH8/edit?usp=sharing&ouid=116629958852501870043&rtpof=true&sd=true](https://docs.google.com/spreadsheets/d/1cpDq2Zl0elKoXD53L-GCg687fma7OTH8/edit?usp=sharing&ouid=116629958852501870043&rtpof=true&sd=true).


## Task Lists

- [ ] Create project plan and specification (_onprogress_)
- [X] Install development environment and dependencies
- [X] Define database and relationships
- [X] Define available routes
- [ ] Implement public design page (mockup)
- [ ] Implement customer design page (mockup)
- [ ] Implement administrator page (mockup) __CURRENT__
- [ ] Implement super administrator page (mockup)
- [ ] implement basic user authentication page
- [ ] feat: basic web configuration (as super administrator)
- [ ] feat: users and roles management 
- [ ] feat: management master data: order item's status
- [ ] feat: management master data: order's status
- [ ] feat: management master data: product's category 
- [ ] feat: management master data: product's variant group
- [ ] feat: management master data: product's group
- [ ] feat: management master data: product
- [ ] feat: cart system
- [ ] feat: order system
- [ ] feat: checkout system
- [ ] feat: payment system
- [ ] feat: cancel order
- [ ] feat: approve order
- [ ] feat: refund order
- [ ] feat: show recent orders (administrator)
- [ ] ...

## Pertanyaan
- Jika transaksi itu di-cancel apa yang akan terjadi?


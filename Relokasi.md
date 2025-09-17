# Fitur Relokasi Layanan

Catatan kebutuhan untuk fitur **Relokasi Layanan**.

## Kebutuhan Utama
- Menyediakan form untuk input data relokasi layanan dan upload surat(pdf) melalu modal
- Menambahkan tabel relokasi pada database
- Menyediakan tampilan admin untuk kelola relokasi



## Detail Task
- [ ] Desain skema tabel `relokasi`
- [ ] CRUD relokasi di backend
- [ ] Validasi input (misalnya tanggal, lokasi tujuan awal dan akhir, alasan)
- [ ] Form frontend untuk input relokasi
- [ ] List & detail relokasi di dashboard admin
- [ ] dashboard user melihat status
- [ ] Testing fitur relokasi


## Detail table
- [ INT ] id
- [ FK ] User_id
- [ FK ] Teknisi_id
- [ FK ] Penjab_id
- [ string ] instansi
- [ text ] alamat
- [ text ] Koordinat
- [ text ] IntansiBaru 
- [ text ] Destination
- [ text ] Koordinat Destination
- [ text ] File PDF Upload
     


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 8px;
            text-align: left;
        }

        .title {
            text-align: center;
            margin-bottom: 20px;
        }

        .section {
            margin-top: 30px;
        }
    </style>
</head>
<body>

    <div class="title">
        <h2>Laporan Operasional Depo Es Batu</h2>

        <p>
            Periode:
            {{ $tanggalAwal }}
            s/d
            {{ $tanggalAkhir }}
        </p>
    </div>

    {{-- ================= BARANG MASUK ================= --}}
    <div class="section">

        <h3>Barang Masuk</h3>

        <table>

            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Total</th>
                    <th>Supplier</th>
                    <th>Kurir</th>
                    <th>Input Oleh</th>
                </tr>
            </thead>

            <tbody>

                @foreach($barangMasuk as $bm)

                    @foreach($bm->detail as $detail)

                    <tr>

                        <td>{{ $bm->tanggal_masuk }}</td>

                        <td>
                            {{ $detail->produk->jenis_es }}
                            ({{ $detail->produk->ukuran_pack }})
                        </td>

                        <td>{{ $detail->jumlah }}</td>

                        <td>
                            Rp {{ number_format($detail->harga_beli / $detail->jumlah, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($detail->harga_beli, 0, ',', '.') }}
                        </td>

                        <td>{{ $bm->supplier->nama_supplier }}</td>

                        <td>{{ $bm->karyawan->nama_karyawan }}</td>

                        <td>{{ $bm->user->username }}</td>

                    </tr>

                    @endforeach

                @endforeach

            </tbody>

        </table>

        <h4>
            Total Barang Masuk:
            Rp {{ number_format($totalBarangMasuk, 0, ',', '.') }}
        </h4>

    </div>

    {{-- ================= DISTRIBUSI ================= --}}
    <div class="section">

        <h3>Distribusi</h3>

        <table>

            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Subtotal</th>
                    <th>Pelanggan</th>
                    <th>Kurir</th>
                    <th>Status</th>
                    <th>Keterangan</th>
                    <th>Input Oleh</th>
                </tr>
            </thead>

            <tbody>

                @foreach($distribusi as $d)

                    @foreach($d->detail as $detail)

                    <tr>

                        <td>{{ $d->tanggal_keluar }}</td>

                        <td>
                            {{ $detail->produk->jenis_es }}
                            ({{ $detail->produk->ukuran_pack }})
                        </td>

                        <td>{{ $detail->jumlah }}</td>

                        <td>
                            Rp {{ number_format($detail->subtotal / $detail->jumlah, 0, ',', '.') }}
                        </td>

                        <td>
                            Rp {{ number_format($detail->subtotal, 0, ',', '.') }}
                        </td>

                        <td>{{ $d->pelanggan->nama_pelanggan }}</td>

                        <td>{{ $d->karyawan->nama_karyawan }}</td>

                        <td>{{ ucfirst($detail->status_pengiriman) }}</td>

                        <td>
                            {{ $detail->keterangan_gagal ?? '-' }}
                        </td>

                        <td>{{ $d->user->username }}</td>

                    </tr>

                    @endforeach

                @endforeach

            </tbody>

        </table>

        <h4>
            Total Distribusi:
            Rp {{ number_format($totalDistribusi, 0, ',', '.') }}
        </h4>

    </div>

</body>
</html>

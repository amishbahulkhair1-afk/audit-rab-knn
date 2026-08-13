<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Audit - {{ $audit->nomor_audit }}</title>
    <style>
        @page {
            margin: 1.5cm 1.5cm 1.5cm 1.5cm;
        }

        body {
            font-family: Helvetica, Arial, sans-serif;
            font-size: 11px;
            color: #333333;
            line-height: 1.4;
        }

        /* Kop Surat Resmi */
        .header-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-container h1 {
            font-size: 16px;
            margin: 0 0 4px 0;
            color: #111111;
            letter-spacing: 0.5px;
        }

        .header-container p {
            margin: 0;
            font-size: 10px;
            color: #666666;
        }

        .double-line {
            border-top: 2px solid #000000;
            border-bottom: 0.5px solid #000000;
            height: 3px;
            margin-top: 8px;
            margin-bottom: 20px;
        }

        h3 {
            font-size: 12px;
            margin-top: 15px;
            margin-bottom: 8px;
            color: #111111;
            border-bottom: 1px solid #dddddd;
            padding-bottom: 3px;
            text-transform: uppercase;
        }

        /* Standarisasi Tabel Ringkas & Bersih */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }

        th,
        td {
            border: 1px solid #cccccc;
            padding: 7px 8px;
            vertical-align: middle;
        }

        th {
            background-color: #f5f5f5;
            font-weight: bold;
            text-align: left;
            color: #222222;
        }

        /* Tabel Info Profile */
        .table-info {
            border: none;
        }

        .table-info td {
            border: none;
            padding: 4px 0;
        }

        .table-info td.label {
            width: 25%;
            color: #555555;
        }

        .table-info td.colon {
            width: 2%;
        }

        /* Utility Classes */
        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .font-mono {
            font-family: Courier, monospace;
        }

        /* Highlight Status KNN */
        .badge-status {
            font-weight: bold;
            text-transform: uppercase;
            color: #1d4ed8;
        }

        .total-box {
            background-color: #f8fafc;
            font-size: 13px;
            font-weight: bold;
            border-top: 2px solid #333333;
        }

        /* Modifikator Khusus Halaman Tanda Tangan */
        .table-signature {
            border: none;
            margin-top: 30px;
            page-break-inside: avoid;
        }

        .table-signature td {
            border: none;
        }
    </style>
</head>

<body>

    <!-- KOP SURAT FORMAL -->
    <div class="header-container">
        <h1>LAPORAN AUDIT TEKNIS KONDISI BANGUNAN</h1>
        <h1>PONDOK PESANTREN ANNUQAYAH LATEE</h1>
        <p>Guluk-Guluk, Sumenep, Jawa Timur 69463</p>
    </div>

    <div class="double-line"></div>

    <h3>I. Informasi Utama Hasil Audit</h3>
    <table class="table-info">
        <tr>
            <td class="label">Nomor Registrasi</td>
            <td class="colon">:</td>
            <td class="font-mono"><strong>{{ $audit->nomor_audit }}</strong></td>
        </tr>
        <tr>
            <td class="label">Tanggal Pelaksanaan</td>
            <td class="colon">:</td>
            <td>{{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d F Y') }}</td>
        </tr>
        <tr>
            <td class="label">Nama Aset Bangunan</td>
            <td class="colon">:</td>
            <td>{{ $audit->building->nama_bangunan }}</td>
        </tr>
        <tr>
            <td class="label">Jenis Struktur Konstruksi</td>
            <td class="colon">:</td>
            <td>{{ $audit->building->jenis_konstruksi }}</td>
        </tr>
        <tr>
            <td class="label">Auditor Lapangan</td>
            <td class="colon">:</td>
            <td>{{ $audit->user->name }}</td>
        </tr>
        <tr>
            <td class="label">Kesimpulan Klasifikasi (KNN)</td>
            <td class="colon">:</td>
            <td class="badge-status">{{ $audit->hasil_knn }}</td>
        </tr>
    </table>

    <h3>II. Rincian Penilaian Komponen Indeks</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" width="8%">No</th>
                <th>Komponen Elemen Bangunan</th>
                <th class="text-center" width="20%">Skor Kondisi (1-5)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audit->details as $detail)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td>{{ ucfirst($detail->komponen) }}</td>
                    <td class="text-center"><strong>{{ $detail->nilai }}</strong></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>III. Analisis Klasifikasi Tetangga Terdekat (K=3)</h3>
    <table>
        <thead>
            <tr>
                <th class="text-center" width="8%">No</th>
                <th>Kode Sampel Data</th>
                <th>Kategori Kondisi</th>
                <th class="text-center" width="25%">Nilai Jarak Euclidean</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($audit->knnResults as $result)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="font-mono">{{ $result->dataSet->kode_data }}</td>
                    <td>{{ $result->dataSet->kategori }}</td>
                    <td class="text-center font-mono">{{ number_format($result->distance, 4) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h3>IV. Rekomendasi Teknis & Mitigasi Risiko</h3>
    <table class="table-info" style="margin-bottom: 10px;">
        <tr>
            <td class="label">Status Kelayakan Bangunan</td>
            <td class="colon">:</td>
            <td><strong>{{ $recommendation['status_bangunan'] }}</strong></td>
        </tr>
        <tr>
            <td class="label">Tingkat Prioritas Penanganan</td>
            <td class="colon">:</td>
            <td><strong>{{ $recommendation['prioritas'] }}</strong></td>
        </tr>
    </table>
    <table>
        <thead>
            <tr>
                <th class="text-center" width="6%">No</th>
                <th width="18%">Komponen</th>
                <th class="text-center" width="18%">Skor & Kondisi</th>
                <th>Rekomendasi Tindakan</th>
                <th>Risiko Potensial</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recommendation['items'] as $item)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td><strong>{{ $item['komponen'] }}</strong></td>
                    <td class="text-center">{{ $item['nilai'] }} - {{ $item['status'] }}</td>
                    <td>{{ $item['rekomendasi'] }}</td>
                    <td>{{ $item['risiko'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- VALIDASI JIKA DOKUMEN MEMILIKI RAB -->
    @if ($audit->rab)
        <h3>V. Estimasi Rencana Anggaran Biaya (RAB) Pemulihan</h3>
        <table>
            <thead>
                <tr>
                    <th class="text-center" width="6%">No</th>
                    <th>Item Uraian Pekerjaan Teknis</th>
                    <th class="text-center" width="12%">Volume</th>
                    <th class="text-right" width="22%">Harga Satuan</th>
                    <th class="text-right" width="24%">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($audit->rab->details as $detail)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $detail->ahsp->nama_pekerjaan }}</td>
                        <td class="text-center">{{ $detail->volume }}</td>
                        <td class="text-right">Rp {{ number_format($detail->harga_satuan, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
                <tr class="total-box">
                    <td colspan="4" class="text-right">TOTAL ESTIMASI BIAYA PEMELIHARAAN:</td>
                    <td class="text-right">Rp {{ number_format($audit->rab->total_biaya, 0, ',', '.') }}</td>
                </tr>
            </tbody>
        </table>
    @endif

    <!-- BLOK TANDA TANGAN -->
    <table class="table-signature">
        <tr>
            <td></td>
            <td width="40%" class="text-center">
                <p>Guluk-Guluk, {{ \Carbon\Carbon::parse($audit->tanggal_audit)->translatedFormat('d F Y') }}</p>
                <p><strong>Auditor Lapangan,</strong></p>
                <br><br><br><br>
                <p><u>{{ $audit->user->name }}</u></p>
            </td>
        </tr>
    </table>

</body>

</html>

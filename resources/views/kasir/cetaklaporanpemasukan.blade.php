<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pemasukan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .report-container {
            width: 100%;
            margin: 0 auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header img {
            width: 50px;
        }

        .header p {
            margin: 5px 0;
        }

        .line {
            border-top: 2px dashed black;
            margin: 10px 0;
        }

        .period {
            text-align: right;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 5px;
            border: 1px solid black;
        }

        .total-section {
            margin-top: 20px;
        }

        .total-section p {
            margin: 5px 0;
        }

        .signature {
            text-align: right;
            margin-top: 50px;
        }

        .signature p {
            display: inline-block;
            border-top: 1px solid black;
            padding-top: 5px;
        }
    </style>
</head>

<body>
    <div class="report-container">
        <!-- Header -->
        <div class="header">
            <p style="font-size: 1.2rem">Jl punya dewa, Wotgaleh, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa
                Tengah 57512</p>
            <p>Whatsapp: 0858-7612-5287</p>
        </div>

        <!-- Garis -->
        <div class="line"></div>

        <!-- Periode -->
        <div class="period">
            <p><strong>Periode:</strong> 01/01/2024 - 31/01/2024</p>
        </div>

        <!-- Tabel Pemasukan -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>No Transaksi</th>
                    <th>Nama Member</th>
                    <th>Tanggal & Waktu</th>
                    <th>Total Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>TRX001</td>
                    <td>Bagus</td>
                    <td>01/01/2024 12:34</td>
                    <td>Rp 100.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>TRX002</td>
                    <td>Topik</td>
                    <td>02/01/2024 14:20</td>
                    <td>Rp 200.000</td>
                </tr>
                <!-- Tambahkan baris transaksi lainnya di sini -->
            </tbody>
        </table>

        <!-- Garis -->
        <div class="line"></div>

        <!-- Total Pemasukan -->
        <div class="total-section">
            <p><strong>Total Pemasukan:</strong> Rp 300.000</p>
        </div>

        <!-- Tanda Tangan Admin -->
        <div class="signature">
            <p>Admin</p>
        </div>
    </div>
</body>

</html>

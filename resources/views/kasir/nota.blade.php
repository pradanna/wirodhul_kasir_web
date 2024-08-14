<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembelian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .nota-container {
            width: 300px;
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            text-align: left;
            padding: 5px;
        }

        .total-section {
            margin-top: 20px;
        }

        .total-section p {
            margin: 5px 0;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="nota-container">
        <!-- Header -->
        <div class="header">
            <p>Jl punya dewa, Wotgaleh, Sukoharjo, Kec. Sukoharjo, Kabupaten Sukoharjo, Jawa Tengah 57512</p>
            <p>Whatsapp: 0858-7612-5287</p>
        </div>

        <!-- Garis -->
        <div class="line"></div>

        <!-- Tabel Barang -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Qty</th>
                    <th>Total Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Nama Barang 1</td>
                    <td>2</td>
                    <td>Rp 20.000</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Nama Barang 2</td>
                    <td>1</td>
                    <td>Rp 15.000</td>
                </tr>
                <!-- Tambahkan baris barang lainnya di sini -->
            </tbody>
        </table>

        <!-- Garis -->
        <div class="line"></div>

        <!-- Total Section -->
        <div class="total-section">
            <p><strong>Total Keseluruhan:</strong> Rp 35.000</p>
            <p><strong>Total Diskon:</strong> Rp 5.000</p>
            <p><strong>Total Bayar:</strong> Rp 50.000</p>
            <p><strong>Total Kembalian:</strong> Rp 20.000</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>Terima kasih telah membeli hidangan kami</p>
        </div>
    </div>
</body>

</html>

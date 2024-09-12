<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        // Fungsi untuk mengurutkan tabel berdasarkan indeks kolom `n` @param {number} n - Indeks kolom yang akan diurutkan
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            // Mendapatkan elemen tabel berdasarkan ID-nya
            table = document.getElementById("data-table");
            switching = true; // Mulai proses pengurutan
            dir = "asc"; // Setel arah pengurutan awalnya ke ascending (naik)
            // Teruskan pengurutan sampai tidak ada lagi yang perlu di-switch
            while (switching) {
                switching = false;
                rows = table.rows; // Mendapatkan semua baris dari tabel
                // Loop melalui semua baris tabel (kecuali header)
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false; // Inisialisasi flag untuk memeriksa jika switching diperlukan
                    x = rows[i].getElementsByTagName("TD")[n]; // Mendapatkan konten sel dari baris saat ini untuk kolom `n`
                    y = rows[i + 1].getElementsByTagName("TD")[n]; // Mendapatkan konten sel dari baris berikutnya untuk kolom `n`
                    // Jika kolom yang diurutkan adalah kolom usia (indeks 3), urutkan secara numerik
                    if (n === 3) {
                        if (dir === "asc") {
                            if (parseInt(x.innerHTML) > parseInt(y.innerHTML)) {
                                shouldSwitch = true; // Tandai perlu switch
                                break; // Keluar dari loop
                            }
                        } else if (dir === "desc") {
                            if (parseInt(x.innerHTML) < parseInt(y.innerHTML)) {
                                shouldSwitch = true; // Tandai perlu switch
                                break; // Keluar dari loop
                            }
                        }
                    } else {
                        // Urutkan secara alfabetik untuk kolom lainnya
                        if (dir === "asc") {
                            if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                                shouldSwitch = true; // Tandai perlu switch
                                break; // Keluar dari loop
                            }
                        } else if (dir === "desc") {
                            if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                                shouldSwitch = true; // Tandai perlu switch
                                break; // Keluar dari loop
                            }
                        }
                    }
                }
                if (shouldSwitch) {
                    // Lakukan switch jika diperlukan
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true; // Setel flag ke true untuk melanjutkan pengurutan
                    switchcount++; // Tambah jumlah switch
                } else {
                    // Jika tidak ada switch yang dilakukan dan arah adalah "asc", setel arah ke "desc" dan jalankan loop lagi.
                    if (switchcount === 0 && dir === "asc") {
                        dir = "desc"; // Ubah arah menjadi descending (menurun)
                        switching = true; // Setel flag ke true untuk melanjutkan pengurutan
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-indigo-200">
    <div class="container mx-auto p-4">
        <header class="mb-6">
            <h1 class="text-3xl font-extrabold text-center text-gray-800">Dashboard</h1>
        </header>
        <table id="data-table" class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
            <thead>
                <tr class="bg-amber-200 text-left text-sm font-semibold text-gray-700">
                    <th class="p-4 cursor-pointer" onclick="sortTable(0)">Tanggal</th>
                    <th class="p-4 cursor-pointer" onclick="sortTable(1)">Nama</th>
                    <th class="p-4 cursor-pointer" onclick="sortTable(2)">Sekolah</th>
                    <th class="p-4 cursor-pointer" onclick="sortTable(3)">Usia</th>
                    <th class="p-4 cursor-pointer" onclick="sortTable(4)">Alamat</th>
                    <th class="p-4 cursor-pointer" onclick="sortTable(5)">Telepon</th>
                    <th class="p-4 cursor-pointer" onclick="sortTable(6)">Hasil</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($calculations as $calculation)
                    <tr class="border-t border-gray-200">
                        <td class="p-4">
                            @if ($calculation->created_at)
                                {{ $calculation->created_at->format('Y-m-d H:i:s') }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td class="p-4">{{ $calculation->name }}</td>
                        <td class="p-4">{{ $calculation->school }}</td>
                        <td class="p-4">{{ $calculation->age }}</td>
                        <td class="p-4">{{ $calculation->address }}</td>
                        <td class="p-4">{{ $calculation->phone }}</td>
                        <td class="p-4">{{ $calculation->result }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="flex items-center justify-center gap-x-4">
        <a href="{{ route('stats') }}" class="mb-8 mt-2 px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Statistik</a>
        <buttont type="button" class="mb-8 mt-2 bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded cursor-pointer" onclick="tableToCSV()">CSV</buttont>
    </div>
    <script type="text/javascript">
    // Fungsi untuk mengonversi tabel HTML ke format CSV
    function tableToCSV() {
        // Variabel untuk menyimpan data CSV akhir
        let csv_data = [];
        // Mendapatkan semua baris dari tabel
        let rows = document.getElementsByTagName('tr');
        for (let i = 0; i < rows.length; i++) {

            // Mendapatkan semua kolom dari baris saat ini
            let cols = rows[i].querySelectorAll('td,th');

            // Menyimpan data setiap baris CSV
            let csvrow = [];
            for (let j = 0; j < cols.length; j++) {
                // Mendapatkan teks dari setiap sel dan menambahkannya ke csvrow
                csvrow.push(cols[j].innerHTML);
            }
            // Menggabungkan setiap nilai kolom dengan koma
            csv_data.push(csvrow.join(","));
        }
        // Menggabungkan setiap data baris dengan karakter baris baru
        csv_data = csv_data.join('\n');

        // Memanggil fungsi ini untuk mengunduh file CSV
        downloadCSVFile(csv_data);
    }
    // @param {string} csv_data - Data CSV yang akan diunduh
    function downloadCSVFile(csv_data) {

        // Membuat objek file CSV dan mengisi dengan data CSV kita
        CSVFile = new Blob([csv_data], {
            type: "text/csv"
        });

        // Membuat link sementara untuk memulai proses unduhan
        let temp_link = document.createElement('a');

        // Mengatur nama file unduhan CSV
        temp_link.download = "GfG.csv";
        let url = window.URL.createObjectURL(CSVFile);
        temp_link.href = url;

        // Link ini tidak akan ditampilkan
        temp_link.style.display = "none";
        document.body.appendChild(temp_link);

        // Secara otomatis mengklik link untuk memicu unduhan
        temp_link.click();
        document.body.removeChild(temp_link);
    }
</script>
</body>
</html>
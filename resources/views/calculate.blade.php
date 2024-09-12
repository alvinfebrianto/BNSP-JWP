<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hitung Luas Bangun Datar dan Volume Bangun Ruang</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-200">
    <div class="max-w-2xl mx-auto p-6 bg-white shadow-md rounded-lg my-4">
        <header class="mb-4">
            <h1 class="text-3xl font-extrabold text-center text-gray-800 mb-12">Hitung Luas Bangun Datar dan Volume Bangun Ruang</h1>
        </header>
        <form action="{{ route('calculate.store') }}" method="POST">
            @csrf
            <h3 class="text-xl font-semibold mb-3">Biodata Siswa</h3>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Siswa:</label>
                <input type="text" id="name" name="name" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="school" class="block text-sm font-medium text-gray-700">Nama Sekolah:</label>
                <input type="text" id="school" name="school" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-700">Usia:</label>
                <input type="number" id="age" name="age" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-4">
                <label for="address" class="block text-sm font-medium text-gray-700">Alamat Rumah:</label>
                <input type="text" id="address" name="address" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <div class="mb-12">
                <label for="phone" class="block text-sm font-medium text-gray-700">Nomor Telepon:</label>
                <input type="number" id="phone" name="phone" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
            </div>
            <h3 class="text-xl font-semibold mb-3">Pilih Bangun Datar</h3>
            <div class="mb-4">
                <select id="flatShape" name="flatShape" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Pilih Bangun Datar</option>
                    <option value="square">Persegi</option>
                    <option value="triangle">Segitiga</option>
                    <option value="circle">Lingkaran</option>
                </select>
            </div>
            <div id="flatDimensions" class="mb-4">
                <!-- Input dimensi bangun datar akan ditambahkan secara dinamis dengan JavaScript -->
            </div>
            <h3 class="text-xl font-semibold mb-3">Pilih Bangun Ruang</h3>
            <div class="mb-4">
                <select id="solidShape" name="solidShape" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    <option value="">Pilih Bangun Ruang</option>
                    <option value="cube">Kubus</option>
                    <option value="pyramid">Limas</option>
                    <option value="cylinder">Tabung</option>
                </select>
            </div>
            <div id="solidDimensions" class="mb-4">
                <!-- Input dimensi bangun ruang akan ditambahkan secara dinamis dengan JavaScript -->
            </div>
            <div class="flex justify-between">
                <button type="submit" class="px-4 py-2 bg-indigo-500 text-white font-semibold rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Hitung</button>
                <a href="{{ route('stats') }}" class="px-4 py-2 bg-green-500 text-white font-semibold rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Statistik</a>
            </div>
        </form>
        <script>
            // Event listener untuk Bangun Datar
            document.getElementById('flatShape').addEventListener('change', function() {
                var shape = this.value; // Mendapatkan nilai dari pilihan bangun datar
                var flatDimensionsDiv = document.getElementById('flatDimensions'); // Mendapatkan elemen div untuk dimensi bangun datar
                flatDimensionsDiv.innerHTML = ''; // Menghapus konten sebelumnya
                var inputHTML = ''; // Menyimpan HTML input yang akan ditambahkan
                // Menentukan jenis input yang dibutuhkan berdasarkan bangun datar yang dipilih
                if (shape === 'square') {
                    inputHTML = `
                        <label for="side" class="block text-sm font-medium text-gray-700">Panjang Sisi (Persegi):</label>
                        <input type="number" id="side" name="flatDimensions[side]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'triangle') {
                    inputHTML = `
                        <label for="base" class="block text-sm font-medium text-gray-700">Panjang Alas (Segitiga):</label>
                        <input type="number" id="base" name="flatDimensions[base]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi (Segitiga):</label>
                        <input type="number" id="height" name="flatDimensions[height]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'circle') {
                    inputHTML = `
                        <label for="radius" class="block text-sm font-medium text-gray-700">Jari-Jari (Lingkaran):</label>
                        <input type="number" id="radius" name="flatDimensions[radius]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                }
                // Menambahkan HTML input yang telah ditentukan ke dalam div
                flatDimensionsDiv.innerHTML = inputHTML;
            });
            // Event listener untuk Bangun Ruang
            document.getElementById('solidShape').addEventListener('change', function() {
                var shape = this.value; // Mendapatkan nilai dari pilihan bangun ruang
                var solidDimensionsDiv = document.getElementById('solidDimensions'); // Mendapatkan elemen div untuk dimensi bangun ruang
                solidDimensionsDiv.innerHTML = ''; // Menghapus konten sebelumnya
                var inputHTML = ''; // Menyimpan HTML input yang akan ditambahkan
                // Menentukan jenis input yang dibutuhkan berdasarkan bangun ruang yang dipilih
                if (shape === 'cube') {
                    inputHTML = `
                        <label for="side" class="block text-sm font-medium text-gray-700">Panjang Sisi (Kubus):</label>
                        <input type="number" id="side" name="solidDimensions[side]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'pyramid') {
                    inputHTML = `
                        <label for="base_area" class="block text-sm font-medium text-gray-700">Luas Alas (Limas):</label>
                        <input type="number" id="base_area" name="solidDimensions[base_area]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi (Limas):</label>
                        <input type="number" id="height" name="solidDimensions[height]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'cylinder') {
                    inputHTML = `
                        <label for="radius" class="block text-sm font-medium text-gray-700">Jari-Jari (Tabung):</label>
                        <input type="number" id="radius" name="solidDimensions[radius]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi (Tabung):</label>
                        <input type="number" id="height" name="solidDimensions[height]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                }
                // Menambahkan HTML input yang telah ditentukan ke dalam div
                solidDimensionsDiv.innerHTML = inputHTML;
            });
        </script>
        <!-- <script>
            // Event listener untuk Bangun Datar
            document.getElementById('flatShape').addEventListener('change', function() {
                var shape = this.value;
                var flatDimensionsDiv = document.getElementById('flatDimensions');
                flatDimensionsDiv.innerHTML = '';
                var inputHTML = '';
                if (shape === 'square') {
                    inputHTML = `
                        <label for="side" class="block text-sm font-medium text-gray-700">Panjang Sisi (Persegi):</label>
                        <input type="number" id="side" name="flatDimensions[side]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'triangle') {
                    inputHTML = `
                        <label for="base" class="block text-sm font-medium text-gray-700">Panjang Alas (Segitiga):</label>
                        <input type="number" id="base" name="flatDimensions[base]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi (Segitiga):</label>
                        <input type="number" id="height" name="flatDimensions[height]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'circle') {
                    inputHTML = `
                        <label for="radius" class="block text-sm font-medium text-gray-700">Jari-Jari (Lingkaran):</label>
                        <input type="number" id="radius" name="flatDimensions[radius]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                }
                flatDimensionsDiv.innerHTML = inputHTML;
            });
            // Event listener untuk Bangun Ruang
            document.getElementById('solidShape').addEventListener('change', function() {
                var shape = this.value;
                var solidDimensionsDiv = document.getElementById('solidDimensions');
                solidDimensionsDiv.innerHTML = '';
                var inputHTML = '';
                if (shape === 'cube') {
                    inputHTML = `
                        <label for="side" class="block text-sm font-medium text-gray-700">Panjang Sisi (Kubus):</label>
                        <input type="number" id="side" name="solidDimensions[side]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'pyramid') {
                    inputHTML = `
                        <label for="base_area" class="block text-sm font-medium text-gray-700">Luas Alas (Limas):</label>
                        <input type="number" id="base_area" name="solidDimensions[base_area]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi (Limas):</label>
                        <input type="number" id="height" name="solidDimensions[height]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                } else if (shape === 'cylinder') {
                    inputHTML = `
                        <label for="radius" class="block text-sm font-medium text-gray-700">Jari-Jari (Tabung):</label>
                        <input type="number" id="radius" name="solidDimensions[radius]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                        <label for="height" class="block text-sm font-medium text-gray-700">Tinggi (Tabung):</label>
                        <input type="number" id="height" name="solidDimensions[height]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                    `;
                }
                solidDimensionsDiv.innerHTML = inputHTML;
            });
        </script> -->
    </div>
</body>
</html>
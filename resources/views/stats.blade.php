<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistik Perhitungan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-indigo-200">
    <div class="container mx-auto my-8 px-4">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-3xl font-extrabold text-center text-gray-800 mb-10">Statistik Perhitungan</h2>
            <div class="mb-6 text-center">
                <p class="text-xl font-medium text-gray-700"><strong>Total Penghitungan:</strong> {{ $totalCalculations }}</p>
            </div>
            <div class="mb-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Persentase Bangun Datar</h3>
                <p class="text-xl text-gray-600">{{ $flatPercentage }}%</p>
            </div>
            <div class="mb-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Persentase Bangun Ruang</h3>
                <p class="text-xl text-gray-600">{{ $solidPercentage }}%</p>
            </div>
            <div class="mb-6 text-center">
                <h3 class="text-xl font-semibold text-gray-800">Detail Perhitungan Masing-Masing Bentuk</h3>
                <ul class="list-disc list-inside text-gray-600 inline-block text-left">
                    @foreach ($shapeCounts as $shape => $count)
                        <li class="text-lg">
                            {{ ucfirst($shape) }}: {{ $count }} kali dihitung ({{ number_format($shapePercentages[$shape], 2) }}%)
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="flex justify-center mt-10">
                <a href="{{ route('calculate.index') }}" class="px-6 py-3 bg-red-600 text-white rounded-lg shadow-md hover:bg-red-700 transition duration-300 ease-in-out">
                    Kembali
                </a>
            </div>
        </div>
    </div>
</body>

</html>
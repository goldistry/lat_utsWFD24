{{-- filepath: c:\uts_WFD24\resources\views\COBA\pendaftaran.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Registration</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-4xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Tambah Registration</h1>

        {{-- Alert Message --}}
        @if (session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('registrations.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                <textarea name="description" id="description" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="3" required></textarea>
            </div>
            <div class="mb-4">
                <label for="image_path" class="block text-gray-700 font-medium mb-2">Gambar</label>
                <input type="file" name="image_path" id="image_path" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" required>
            </div>
            <div class="mb-4">
                <label for="image_paths" class="block text-gray-700 font-medium mb-2">Gambar (Array)</label>
                <input type="file" name="image_paths[]" id="image_paths" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*" multiple>
            </div>
            <div class="mb-4">
                <label for="file_path" class="block text-gray-700 font-medium mb-2">File</label>
                <input type="file" name="file_path" id="file_path" class="w-full border border-gray-300 rounded-lg p-2 focus:outline-none focus:ring-2 focus:ring-blue-500" accept=".pdf,.doc,.docx" required>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Submit</button>
        </form>
    </div>
</body>
</html>
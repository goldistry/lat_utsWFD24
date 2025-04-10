{{-- filepath: c:\uts_WFD24\resources\views\COBA\list.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List Registrations</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="max-w-6xl mx-auto mt-10 bg-white p-8 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">List Registrations</h1>
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">ID</th>
                    <th class="border border-gray-300 px-4 py-2">Deskripsi</th>
                    <th class="border border-gray-300 px-4 py-2">Gambar</th>
                    <th class="border border-gray-300 px-4 py-2">File</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registrations as $registration)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $registration->id }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $registration->description }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <img src="{{ asset('storage/' . $registration->image_path) }}" alt="Image" class="w-20 h-20 object-cover">
                        </td>
                        <td class="border border-gray-300 px-4 py-2">
                            <a href="{{ asset('storage/' . $registration->file_path) }}" class="text-blue-500 underline" target="_blank">Download File</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
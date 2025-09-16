<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 class="text-white text-2xl mb-4">Search Results for "{{ $query }}"</h2>

@if($passengers->isEmpty())
    <p class="text-gray-400">No passengers found.</p>
@else
    <table class="min-w-full bg-gray-800 text-white">
        <thead>
            <tr>
                <th class="px-4 py-2">Name</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($passengers as $passenger)
                <tr>
                    <td class="border px-4 py-2">{{ $passenger->first_name }} {{ $passenger->last_name }}</td>
                    <td class="border px-4 py-2">{{ $passenger->email }}</td>
                    <td class="border px-4 py-2">{{ $passenger->phone ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
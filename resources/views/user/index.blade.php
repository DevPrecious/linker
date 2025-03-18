<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Link Sharing Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body style="background-color: {{ $user->pageSettings->background_color ?? '#FDFDFC' }}" class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-md p-6 bg-white shadow-lg rounded-lg text-center">
        <!-- Profile Section -->
        <img src="{{ Storage::disk('profile-photos')->url($user->avatar_url) }}" alt="Profile" class="w-24 h-24 mx-auto rounded-full shadow-md">
        <h1 class="mt-4 text-xl font-semibold text-gray-900">{{ $user->name }}</h1>
        <p class="text-gray-600">{{ $user->username }}</p>
        
        <!-- Links Section -->
        <div class="mt-6 space-y-4">
            @foreach($links as $link)
                <a href="{{ route('link.click', $link->id) }}" target="_blank" style="background-color: {{ $link->color }}" class="block w-full  text-white py-2 rounded-lg shadow-md hover:bg-gray-900 transition">{{ $link->name }}</a>
            @endforeach
        </div>
    </div>
</body>
</html>

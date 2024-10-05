<x-app-layout>
    <div class="max-w-5xl mx-auto py-12">
        <!-- Back Icon (Gmail Style) -->
        <div class="mb-4">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <!-- Back Arrow Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Dashboard
            </a>
        </div>

        <h1 class="text-lg font-bold mb-4 text-white text-center p-2">Admin Dashboard</h1>

        @if ($listings->isEmpty())
            <p class="text-center text-gray-500">No listings available.</p>
        @else
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="shadow-md overflow-hidden rounded-lg">
                    <!-- Responsive Table Wrapper -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Listing Title</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Description</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-black-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($listings as $listing)
                                    <tr class="{{ $listing->is_verified ? 'bg-green-100' : 'bg-red-100' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $listing->title }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $listing->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="text-sm {{ $listing->is_verified ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $listing->is_verified ? 'Verified' : 'Pending' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if (!$listing->is_verified)
                                                <form action="{{ route('listings.verify', $listing->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700 transition duration-300">
                                                        Verify
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-green-600">Already Verified</span>
                                            @endif
                                        </td>    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>

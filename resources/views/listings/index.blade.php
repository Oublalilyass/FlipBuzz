<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Listings') }}
        </h2>
    </x-slot>

    {{-- @foreach (auth()->user()->unreadNotifications as $notification)
    <div>
        A new bid of ${{ $notification->data['bid_amount'] }} was placed on your listing.
        <a href="{{ url('/listings/' . $notification->data['listing_id']) }}">View Listing</a>
    </div>
    @endforeach --}}
    
    {{-- Include the shared CSS file --}}
    @vite(['resources/css/listings.css'])

    {{-- Create Listing Button --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-6">
                <a href="{{ route('listings.create') }}" class="px-4 py-2 bg-gradient-to-r from-indigo-500 to-orange-500 text-white font-bold rounded-lg shadow hover:from-indigo-600 hover:to-orange-600 focus:outline-none">
                    Create New Listing
                </a>
            </div>

            {{-- Existing Listings --}}
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-xl sm:rounded-lg">
                {{-- Loop through all listings --}}
                @foreach($listings as $listing)
                    <div class="listing-container shadow-md hover:shadow-lg transition-shadow duration-300 bg-gray-50 rounded-lg mb-6">
                        <div class="listing-header px-6 py-4 bg-gray-100 border-b border-blue-200">
                            <span class="listing-type">Ecommerce Store</span>
                            <h1 class="title">{{ $listing->title }}</h1>
                            <p class="description">{{ $listing->description }}</p>
                            <div class="listing-tags">
                                <span class="tag">Ecommerce</span>
                                <span class="tag">{{ $listing->type }}</span>
                                <span class="tag">Sponsored</span>
                                <span class="tag confidential">Confidential</span>
                            </div>
                        </div>
                    
                        <div class="listing-details px-6 py-4 ">
                            <div class="detail-item">
                                <span class="detail-title">Site Age</span>
                                <span class="detail-value">{{ $listing->site_age }} years</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-title">Monthly Profit</span>
                                <span class="detail-value">USD ${{ number_format($listing->monthly_profit, 0) }} /mo</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-title">Profit Margin</span>
                                <span class="detail-value">{{ $listing->profit_margin }}%</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-title">Page Views</span>
                                <span class="detail-value">{{ number_format($listing->page_views) }} p/mo</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-title">Profit Multiple</span>
                                <span class="detail-value">{{ $listing->profit_multiple }}x</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-title">Revenue Multiple</span>
                                <span class="detail-value">{{ $listing->revenue_multiple }}x</span>
                            </div>
                        </div>

                        <div class="listing-footer container px-6 py-4 border-t border-gray-200">
                            <a href="{{ route('listings.show', $listing->id) }}" class="view-details">View Details</a>

                            {{-- Add the Edit Button --}}
                            @can('update', $listing)
                            <a href="{{ route('listings.edit', $listing->id) }}" class="edit-details">
                                Edit Listing
                            </a>
                            @endcan

                            <!-- Delete Form -->
                            @can('delete', $listing)
                            <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" class="inline-block ml-4">
                             @csrf
                             @method('DELETE')
                             <button type="button" class="btn-danger" onclick="openModal('{{ route('listings.destroy', $listing->id) }}')">
                                Delete Listing
                            </button>                            
                          </form>
                          @endcan

                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>


<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center ">
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-lg p-8 mx-auto">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">Confirm Deletion</h3>
        <p class="text-gray-700 mb-8">Are you sure you want to delete this listing? This action cannot be undone.</p>
        <div class="flex justify-end space-x-4">
            <button class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded" onclick="closeModal()">Cancel</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
            </form>
        </div>
    </div>
</div>

<script>
    function openModal(action) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteForm').setAttribute('action', action);
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>

<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- Include the shared CSS file --}}
    @vite(['resources/css/listings.css'])


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-white-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="listing-container">
                    <div class="listing-header">
                        <span class="listing-type">Ecommerce Store</span>
                        <h1 class="title">{{ $listing->title }}</h1>

                        {{-- Display the image --}}
                        @if($listing->images)
                        <img src="{{ asset('storage/' . $listing->images) }}" alt="{{ $listing->title }}" class="listing-image">
                        @endif

                        <p class="description">{{ $listing->description }}</p>
                        <div class="listing-tags">
                            <span class="tag">Ecommerce</span>
                            <span class="tag">{{ $listing->type }}</span>
                            <span class="tag">Sponsored</span>
                            <span class="tag confidential">Confidential</span>
                        </div>
                    </div>

                    <div class="listing-details">
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
                    <div class="listing-footer">

                        <div class="listing-footer container px-2 py-4 border-t border-gray-200 flex justify-center items-center space-x-8">

                            <!-- Conditionally Display the Bid Now Button -->
                            @if (Auth::user()->id !== $listing->user_id)
                            <a class="bidding-btn" onclick="openBidModal()">Bid Now</a>
                            @endif

                            {{-- Add the Edit Button --}}
                            @can('update', $listing)
                            <a href="{{ route('listings.edit', $listing->id) }}" class="edit-details">
                                Edit Listing
                            </a>
                            @endcan

                            <!-- Delete Form -->
                            @can('delete', $listing)
                            <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-danger" onclick="openModal('{{ route('listings.destroy', $listing->id) }}')">
                                    Delete Listing
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>

                    <!-- Display All Bids -->
                    <div class="bids-section mt-6 text-center">
                        <h3 class="bids-header">All Bids</h3>

                        @if ($bids->isEmpty())
                        <p class="no-bids-text">No bids have been placed yet.</p>
                        @else
                        <ul class="bids-list">
                            @foreach ($bids as $bid)
                            <li class="bid-item">
                                <div class="bid-content">
                                    <span class="bid-user">{{ $bid->user->name }}</span>
                                    <span class="bid-amount">bid <strong>${{ number_format($bid->amount, 2) }}</strong></span>
                                    <span class="bid-date">{{ $bid->created_at->format('d M Y, h:i A') }}</span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>

                    <!-- Message Section -->
                    <div class="message-section mt-8 border-t border-gray ">
                        <h3 class="py-4 text-xl font-semibold text-gray-800 dark:text-black mb-4">Send a Message to the Owner</h3>

                        @if (Auth::user()->id !== $listing->user_id)
                        <form action="{{ route('messages.store', $listing->id) }}" method="POST" class="message-bg p-6 rounded-lg shadow-md">
                            @csrf
                            <div class="mb-4">
                                <label for="message_body" class="block text-white font-bold mb-2">Your Message:</label>
                                <textarea name="message_body" id="message_body" rows="4" class="w-full text-black p-3 border border-black rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Type your message here..." required></textarea>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg">Send Message</button>
                            </div>
                        </form>
                        @else
                        <p class="text-gray-500">You cannot message yourself.</p>
                        @endif
                    </div>

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

<!-- Bid Modal -->
<div id="bidModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center">
    <div class="relative bg-white rounded-lg shadow-lg w-full max-w-lg p-8 mx-auto">
        <h3 class="text-xl font-semibold text-gray-900 mb-6">Place Your Bid</h3>
        <form action="{{ route('bids.store', $listing->id) }}" method="POST">
            @csrf
            <div class="mb-6">
                <label for="bidAmount" class="block text-gray-700 font-bold mb-2">Enter Bid Amount:</label>
                <input type="number" name="amount" id="bidAmount" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" class="cancel-btn" onclick="closeBidModal()">Cancel</button>
                <button type="submit" class="submit-btn">Submit Bid</button>
            </div>
        </form>
    </div>
</div>

<!-- Bid Modal JavaScript -->
<script>
    function openBidModal() {
        document.getElementById('bidModal').classList.remove('hidden');
    }

    function closeBidModal() {
        document.getElementById('bidModal').classList.add('hidden');
    }
</script>

<script>
    function openModal(action) {
        document.getElementById('deleteModal').classList.remove('hidden');
        document.getElementById('deleteForm').setAttribute('action', action);
    }

    function closeModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
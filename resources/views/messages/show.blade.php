<x-app-layout>
    <div class="max-w-5xl mx-auto py-12">
        <!-- Back Icon (Gmail Style) -->
        <div class="mb-4">
            <a href="{{ route('messages.received') }}" class="inline-flex items-center text-blue-600 hover:text-blue-800">
                <!-- Back Arrow Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                Back to Inbox
            </a>
        </div>

        <!-- Email Container -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <!-- Message Header (Sender, To, and Date) -->
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <div>
                    <p class="text-sm text-gray-500">From:</p>
                    <h2 class="text-lg font-semibold text-gray-900">{{ $message->sender->name }}</h2>
                    <p class="text-sm text-gray-500">To: {{ $message->receiver->name }}</p>
                </div>
                <p class="text-sm text-gray-500">{{ $message->created_at->format('M d, Y H:i') }}</p>
            </div>

            <!-- Message Body -->
            <div class="px-6 py-6 text-gray-700">
                <p class="whitespace-pre-line">{{ $message->message_body }}</p>
            </div>

            <!-- Divider -->
            <div class="border-t border-gray-200"></div>

            <!-- Reply Section -->
            <div class="px-6 py-6">
                <h3 class="text-md font-semibold text-gray-700 mb-4">Reply to this message:</h3>

                <!-- Reply Form -->
                <form action="{{ route('messages.send', ['listing_id' => $message->listing_id, 'message_id' => $message->id]) }}" method="POST">
                    @csrf
                    <textarea name="message_body" rows="4" class="block w-full shadow-sm sm:text-sm border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 mt-2 p-2" placeholder="Write your reply..."></textarea>
                    <div class="mt-4 flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 focus:outline-none">
                            Send Reply
                        </button>
                    </div>
                </form>
            </div>

            <!-- Replies Section -->
            @if($message->replies->isNotEmpty())
                <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                    <h4 class="text-md font-semibold text-gray-700 mb-4">Replies:</h4>
                    <ul class="space-y-6">
                        @foreach($message->replies as $reply)
                            <li class="bg-white p-4 rounded-lg shadow">
                                <div class="flex justify-between items-center">
                                    <p class="text-sm text-gray-500">From: <strong>{{ $reply->sender->name }}</strong></p>
                                    <p class="text-sm text-gray-500">{{ $reply->created_at->format('M d, Y H:i') }}</p>
                                </div>
                                <p class="mt-2 text-gray-700">{{ $reply->message_body }}</p>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @else
                <p class="text-center text-gray-500 mt-4">No replies yet.</p>
            @endif
        </div>
    </div>
</x-app-layout>

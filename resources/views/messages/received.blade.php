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

        <h1 class="text-lg font-bold mb-4 text-gray-900 text-center p-2">Inbox</h1>

        @if ($messages->isEmpty())
            <p class="text-center text-gray-500">You have no received messages.</p>
        @else
            <div class="bg-gray-100 p-4 rounded-lg">
                <div class="shadow-md overflow-hidden rounded-lg">
                    <ul role="list" class="divide-y divide-gray-200">
                        @foreach ($messages as $message)
                            @php
                                // Check if the message has any replies
                                $hasReplies = $message->replies->isNotEmpty();
                            @endphp
                            
                            <!-- Conditionally apply dark gray background if message has replies -->
                            <li>
                                <a href="{{ route('messages.show', $message->id) }}" 
                                    class="block hover:bg-white hover:text-black {{ $hasReplies ? 'bg-gray-800 text-white' : 'bg-white text-black' }} transition duration-300">
                                    <div class="flex items-center px-4 py-4 sm:px-6">
                                        <!-- Checkbox for selecting messages -->
                                        <input type="checkbox" class="h-5 w-5 text-blue-600 border-gray-300 rounded mr-4">

                                        <!-- Message Details -->
                                        <div class="min-w-0 flex-1 sm:flex sm:items-center sm:justify-between">
                                            <div class="truncate">
                                                <!-- Sender Name -->
                                                <p class="text-sm font-medium truncate">
                                                    {{ $message->sender->name }}
                                                </p>
                                                <!-- Message Preview (like a subject in Gmail) -->
                                                <p class="mt-2 flex items-center text-sm">
                                                    <span class="truncate">
                                                        {{ Str::limit($message->message_body, 50) }}
                                                    </span>
                                                </p>
                                            </div>
                                            <!-- Date of the message -->
                                            <div class="ml-2 flex-shrink-0">
                                                <p class="text-sm">
                                                    {{ $message->created_at->format('M d, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>

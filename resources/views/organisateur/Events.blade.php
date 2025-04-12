<x-organizateurDashboardNav>
@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
        <strong class="font-bold">Success!</strong>
        <span class="">{{ session('success') }}</span>
        <button type="button" class="absolute top-0 bottom-0 right-0 px-4 py-3" onclick="this.parentElement.remove();">
            ✖
        </button>
    </div>
@endif
<div class="p-6">
        <!-- Table of Events -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">N_Place</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Artist</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Place</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($data as $event)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->nom }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->description }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->date }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->taketPrice }} DH</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->numberOfPlace }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->Firstname }} {{ $event->LastName }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->Category }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $event->place }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                <!-- Add buttons for Edit/Delete/View -->
                                <a href="{{route('editEvent',$event->eventId)}}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                |
                                <form action="{{route('destory',$event->eventId)}}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-organizateurDashboardNav>

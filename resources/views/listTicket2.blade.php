@extends('layout')
@section('content')
    <div class="px-8">
        <div class="p-6 flex justify-center items-center">
            <h1 class="font-bold text-xl md:text-3xl text-white">Airplane Booking System</h1>
        </div>
        <div class="p-4 text-white">
            <div
                class="flex flex-col md:flex-row justify-between md:items-center font-bold text-xl border-b-1 pb-2 border-white">
                <h1>Ticket Details for {{ $flight->flight_code }}</h1>
                <h1>{{ $totalTickets }} passengers - {{ $boardingTickets }} boardings</h1>
            </div>
        </div>
        <div class="p-4">
            <div class="overflow-x-auto relative">
                <table class="text-white w-full border-collapse">
                    <thead class="border-b border-white p-2">
                        <tr>
                            <th class="p-2 text-left">No</th>
                            <th class="p-2 text-left">Passenger Name</th>
                            <th class="p-2 text-left">Passenger Phone</th>
                            <th class="p-2 text-left">Seat Number</th>
                            <th class="p-2 text-left">Boarding</th>
                            <th class="p-2 text-left">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flight->tickets as $ticket)
                            <tr class="p-2">
                                <td class="p-2">{{ $loop->iteration }}</td>
                                <td class="p-2">{{ $ticket->passenger_name }}</td>
                                <td class="p-2">{{ $ticket->passenger_phone }}</td>
                                <td class="p-2">{{ $ticket->seat_number }}</td>
                                <td class="p-2">
                                    @if (!$ticket->is_boarding)
                                        <form action="{{ route('ticket.board.update', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition">
                                                Confirm
                                            </button>
                                        </form>
                                    @else
                                        {{ \Carbon\Carbon::parse($ticket->updated_at)->isoFormat('DD-MM-YYYY, HH:mm') }}
                                    @endif
                                </td>
                                <td class="p-2">
                                    @if (!$ticket->is_boarding)
                                        <form action="{{ route('ticket.delete', $ticket->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition">
                                                Delete
                                            </button>
                                        </form>
                                    @else
                                        <button class="px-4 py-2 bg-gray-600 rounded cursor-not-allowed" disabled>
                                            Delete
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
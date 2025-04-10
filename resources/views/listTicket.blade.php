@extends('layout')
@section('content')
    <div class="px-8">
        <div class="p-6 flex justify-center items-center">
            <h1 class="font-bold text-xl md:text-3xl text-white">Airplane Booking System</h1>
        </div>
        <div class="p-4 text-white">
            <div class="flex flex-col md:flex-row justify-between md:items-center font-bold text-xl border-b-1 pb-2 border-white">
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
                                        <button
                                            class="px-4 py-2 bg-blue-600 rounded hover:bg-blue-700 transition confirm-boarding"
                                            data-ticket-id="{{ $ticket->id }}">
                                            Confirm
                                        </button>
                                    @else
                                        {{ \Carbon\Carbon::parse($ticket->updated_at)->isoFormat('DD-MM-YYYY, HH:mm') }}
                                    @endif
                                </td>
                                <td class="p-2">
                                    @if (!$ticket->is_boarding)
                                        <button
                                            class="px-4 py-2 bg-red-600 rounded hover:bg-red-700 transition delete-ticket"
                                            data-ticket-id="{{ $ticket->id }}">
                                            Delete
                                        </button>
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
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;

            if (!csrfToken) {
                console.error('CSRF token not found');
                return;
            }

            document.querySelectorAll('.confirm-boarding').forEach(button => {
                button.addEventListener('click', function() {
                    const ticketId = this.dataset.ticketId;
                    const buttonElement = this;

                    Swal.fire({
                        title: 'Konfirmasi Boarding?',
                        text: "Anda yakin ingin mengkonfirmasi boarding untuk penumpang ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Konfirmasi!',
                        background: '#1f2937',
                        color: '#fff'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/ticket/board/${ticketId}`, {
                                    method: 'PUT',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json', // Keep Content-Type, good practice even without a body sometimes
                                    },
                                    // No body is needed for this specific action, but if you were sending data,
                                    // you would include it here:
                                    // body: JSON.stringify({ key: 'value' })
                                })
                                .then(response => {
                                    if (!response.ok) {
                                        return response.json().then(errData => {
                                            throw new Error(errData.message ||
                                                'Terjadi kesalahan saat mengkonfirmasi boarding.'
                                            );
                                        }).catch(() => {
                                            throw new Error(
                                                `Terjadi kesalahan saat mengkonfirmasi boarding. Status: ${response.status}`
                                            );
                                        });
                                    }
                                    return response.json();
                                })
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Boarding Berhasil!',
                                        text: `Boarding dikonfirmasi pada ${data.boarding_time_formatted}`,
                                        background: '#1f2937',
                                        color: '#fff'
                                    }).then(() => {
                                        const tdElement = buttonElement.closest(
                                            'td');
                                        tdElement.innerHTML = data
                                            .boarding_time_formatted;

                                        const deleteButton = tdElement.closest(
                                            'tr').querySelector(
                                            '.delete-ticket');
                                        if (deleteButton) {
                                            deleteButton.disabled = true;
                                            deleteButton.classList.remove(
                                                'bg-red-600',
                                                'hover:bg-red-700');
                                            deleteButton.classList.add(
                                                'bg-gray-600',
                                                'cursor-not-allowed');
                                        }
                                        location.reload();
                                    });
                                })
                                .catch(error => {
                                    console.error('Fetch Error:',
                                        error); // Log the actual error
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: error
                                            .message, // Display the specific error message
                                        background: '#1f2937',
                                        color: '#fff'
                                    });
                                });
                        }
                    });
                });

            });

            // Add similar logic for delete button if needed, using DELETE method
            document.querySelectorAll('.delete-ticket').forEach(button => {
                button.addEventListener('click', function() {
                    const ticketId = this.dataset.ticketId;
                    const buttonElement = this;

                    Swal.fire({
                        title: 'Konfirmasi Delete?',
                        text: "Anda yakin ingin menghapus tiket ini?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Ya, Konfirmasi!',
                        background: '#1f2937',
                        color: '#fff'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/ticket/delete/${ticketId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': csrfToken,
                                        'Accept': 'application/json',
                                        'Content-Type': 'application/json',
                                    },
                                })
                                .then(data => {
                                    Swal.fire({
                                        icon: 'success',
                                        title: 'Delete Berhasil!',
                                        text: data.message,
                                        background: '#1f2937',
                                        color: '#fff'
                                    }).then(() => {
                                        location.reload();
                                    });
                                })
                                .catch(error => {
                                    console.error('Fetch Error:',
                                        error); 
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Gagal!',
                                        text: error
                                            .message, 
                                        background: '#1f2937',
                                        color: '#fff'
                                    });
                                });
                        };
                    });
                });
            });
        });
    </script>
@endsection

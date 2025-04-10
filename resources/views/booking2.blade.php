@extends('layout')
@section('content')
    <div class="px-8">
        <div class="p-6 flex justify-center items-center">
            <h1 class="font-bold text-xl md:text-3xl text-white">Airplane Booking System</h1>
        </div>
        <div class="p-6">
            <div class="p-2 border-b-1 border-white text-white flex justify-between items-center font-bold text-xl">
                <h1>Ticket Booking for</h1>
                <h1>{{ $flightDetails->flight_code }}</h1>
            </div>
            <div class="p-2 text-white flex flex-col lg:flex-row justify-between lg:items-center">
                <h1>{{ $flightDetails->origin }}->{{ $flightDetails->destination }}</h1>
                <div class="flex space-x-3 text-md">
                    <h2>Departure</h2>
                    <h2 class="font-semibold italic">
                        {{ \Carbon\Carbon::parse($flightDetails->departure_time)->isoFormat('dddd, D MMMM Y, HH:mm') }}</h2>
                </div>
                <div class="flex space-x-3 text-md">
                    <h2>Arrival</h2>
                    <h2 class="font-semibold italic">
                        {{ \Carbon\Carbon::parse($flightDetails->arrival_time)->isoFormat('dddd, D MMMM Y, HH:mm') }}</h2>
                </div>
            </div>
        </div>
        <div class="p-6 flex flex-col text-white">
            <form id="bookTicket" action="{{ route('ticket.submit') }}" method="POST">
                @csrf
                <input type="hidden" name="flight_id" value="{{ $flightDetails->id }}">
                <div class="p-2 flex items-center max-sm:justify-between justify-start">
                    <label for="passenger_name" class="w-40">Passenger Name</label>
                    <input type="text" id="passenger_name" name="passenger_name"
                        class="bg-gray-600 rounded-lg flex-grow py-2 px-3 max-w-80"
                        value="{{ old('passenger_name') }}" required>
                </div>
                <div class="p-2 flex items-center max-sm:justify-between justify-start">
                    <label for="passenger_phone" class="w-40">Passenger Phone</label>
                    <input type="text" id="passenger_phone" name="passenger_phone"
                        class="bg-gray-600 rounded-lg flex-grow py-2 px-3 max-w-80"
                        value="{{ old('passenger_phone') }}" required>
                </div>
                <div class="p-2 flex items-center max-sm:justify-between justify-start">
                    <label for="seat_number" class="w-40">Seat Number</label>
                    <input type="text" id="seat_number" name="seat_number"
                        class="bg-gray-600 rounded-lg flex-grow py-2 px-3 max-w-80"
                        value="{{ old('seat_number') }}" required>
                </div>
                <div class="mt-4 flex justify-end space-x-6">
                    <button type="reset" onclick="clearForm()"
                        class="bg-gray-400 hover:bg-white hover:text-black text-white font-bold py-2 px-4 rounded-lg">
                        Cancel
                    </button>
                    <button type="submit"
                        class="bg-gray-500 hover:bg-white hover:text-black text-white font-bold py-2 px-4 rounded-lg">
                        Book Ticket
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function clearForm() {
            document.getElementById("bookTicket").reset();
        }
    </script>
@extends('layout')
@section('content')
    <div class="p-6 flex justify-center items-center">
        <h1 class="font-bold text-xl md:text-3xl text-white">Airplane Booking System</h1>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-4">
        @foreach ($flights as $flight)
            <div class="border-1 border-white rounded-xl flex flex-col p-3">
                <div class="flex justify-between items-center text-white">
                    <h1 class="font-bold text-lg">{{ $flight->flight_code }}</h1>
                    <h2 class="justify-end text-md">{{ $flight->origin }}->{{ $flight->destination }}</h2>
                </div>
                <div class="mt-2 text-white text-sm">
                    <h4>Departure</h4>
                    <h1 class="font-semibold italic">
                        {{ \Carbon\Carbon::parse($flight->departure_time)->isoFormat('dddd, D MMMM Y, HH:mm') }}</h1>
                    <h4>Arrived</h4>
                    <h1 class="font-semibold italic">
                        {{ \Carbon\Carbon::parse($flight->arrival_time)->isoFormat('dddd, D MMMM Y, HH:mm') }}</h1>
                </div>
                <div class="mt-4 font-semibold text-white text-sm flex justify-between">
                    <a href="{{ route('flights.book', ['flight_id' => $flight->id]) }}">
                        <button class="bg-gray-400 px-3 py-1 rounded-lg">Book Ticket</button>
                    </a>
                    <a href="{{ route('flight.ticket', ['flight_id' => $flight->id]) }}">
                        <button class="bg-gray-400 px-3 py-1 rounded-lg">View Details</button>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection

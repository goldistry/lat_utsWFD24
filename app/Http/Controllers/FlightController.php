<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index(){
        $data['title'] = "Flight List";
        $flights = Flight::all();
        $data['flights'] = $flights;
        return view('listFlight', $data);
    }
    public function bookingForm($id){
        $data['title'] = "Ticket Booking";
        $flights = Flight::where('id', $id)->firstOrFail();
        $data['flightDetails'] = $flights;
        return view('booking2', $data);
    }
    public function showAllTickets($flightId) {
        $flight = Flight::with('tickets')->findOrFail($flightId);
    
        $totalTickets = $flight->tickets->count();
    
        $boardingTickets = $flight->tickets->where('is_boarding', true)->count();
    
        $data = [
            'title' => "Ticket Lists",
            'flight' => $flight,
            'totalTickets' => $totalTickets,
            'boardingTickets' => $boardingTickets,
        ];
        // dd($data);
    
        return view('listTicket2', $data);
    }
}

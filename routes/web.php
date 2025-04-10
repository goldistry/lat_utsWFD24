<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

Route::get('/flights', [FlightController::class, 'index'])->name('flights.list');
Route::get('/flights/book/{flight_id}', [FlightController::class, 'bookingForm'])->name('flights.book');
Route::post('/ticket/submit', [TicketController::class, 'submitTicket'])->name('ticket.submit');
Route::get('/flights/ticket/{flight_id}', [FlightController::class, 'showAllTickets'])->name('flight.ticket');
Route::put('/ticket/board/{ticket_id}', [TicketController::class, 'updateBoardingState'])->name('ticket.board.update');
Route::delete('/ticket/delete/{ticket_id}', [TicketController::class, 'destroy'])->name('ticket.delete');
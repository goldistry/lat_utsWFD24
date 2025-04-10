<?php

use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

Route::get('/flights', [FlightController::class, 'index'])->name('flights.list');
Route::get('/flights/book/{flight_id}', [FlightController::class, 'bookingForm'])->name('flights.book');
Route::post('/ticket/submit', [TicketController::class, 'submitTicket'])->name('ticket.submit');
Route::get('/flights/ticket/{flight_id}', [FlightController::class, 'showAllTickets'])->name('flight.ticket');
Route::put('/ticket/board/{ticket_id}', [TicketController::class, 'updateBoardingState'])->name('ticket.board.update');
Route::delete('/ticket/delete/{ticket_id}', [TicketController::class, 'destroy'])->name('ticket.delete');

Route::get('/registrations', [RegistrationController::class, 'index']);
Route::get('/registrations/create', function () {
  return view('COBA.pendaftaran');
})->name('registrations.create');
Route::post('/registrations', [RegistrationController::class, 'store'])->name('registrations.store');
Route::get('/registrations/{id}', [RegistrationController::class, 'show']);
Route::put('/registrations/{id}', [RegistrationController::class, 'update']);
Route::delete('/registrations/{id}', [RegistrationController::class, 'destroy']);
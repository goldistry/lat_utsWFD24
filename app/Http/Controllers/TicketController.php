<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class TicketController extends Controller
{
    // public function submitTicket(Request $request)
    // {
    //     $validator = Validator::make($request->all(), [
    //         'passenger_name' => 'required|string',
    //         'passenger_phone' => 'required|string|min:14|max:14',
    //         'seat_number' => 'required|string|min:3|max:3',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'message' => 'Validasi gagal.',
    //             'errors' => $validator->errors()->all(),
    //         ], 422); // Kode status untuk Unprocessable Entity (validasi gagal)
    //     }

    //     $passenger_name = $request->passenger_name;
    //     $passenger_phone = $request->passenger_phone;
    //     $seat_number = $request->seat_number;

    //     $ticket = Ticket::create([
    //         "passenger_name" => $passenger_name,
    //         "passenger_phone" => $passenger_phone,
    //         "seat_number" => $seat_number,
    //         "flight_id" => $request->flight_id,
    //     ]);
    //     return response()->json([
    //         'message' => 'Tiket berhasil dipesan.',
    //         'data' => $ticket, 
    //     ], 201);
    // }
    public function submitTicket(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            Ticket::validationRules(),
            Ticket::validationMessages()
        );

        if ($validator->fails()) {
            $errorMessages = implode(' ', $validator->errors()->all()); // Gabungkan semua pesan error

            return redirect()->back()
                ->withInput() // Menyimpan input ke session
                ->withErrors($validator) // Menyimpan pesan error ke session
                ->with('error', 'Validasi gagal: ' . $errorMessages); // Kirim pesan error ke session
        }

        $passenger_name = $request->passenger_name;
        $passenger_phone = $request->passenger_phone;
        $seat_number = $request->seat_number;

        $ticket = Ticket::create([
            "passenger_name" => $passenger_name,
            "passenger_phone" => $passenger_phone,
            "seat_number" => $seat_number,
            "flight_id" => $request->flight_id,
        ]);
        return redirect()->route('flight.ticket', ['flight_id' => $request->flight_id])->with('success', 'Berhasil memesan tiket!')->with('ticket', $ticket); // Redirect to the flight ticket list with success message
    }



    // public function updateBoardingState($ticket_id)
    // {
    //     $ticket = Ticket::findOrFail($ticket_id);
    //     $ticket->is_boarding = true; // Fixed typo: was 'is_boading'
    //     $ticket->save();

    //     return response()->json([
    //         'message' => 'Status boarding berhasil diupdate.',
    //         'data' => $ticket,
    //         'boarding_time_formatted' => \Carbon\Carbon::parse($ticket->updated_at)->isoFormat('DD-MM-YYYY, HH:mm')
    //     ], 200);
    // }
    public function updateBoardingState($ticket_id)
    {
        $ticket = Ticket::findOrFail($ticket_id);
        $ticket->is_boarding = true; // Fixed typo: was 'is_boading'
        $ticket->save();

        $boardingTimeFormatted = $boardingTimeFormatted = Carbon::parse($ticket->updated_at)->isoFormat('DD-MM-YYYY, HH:mm');

        return redirect()->back()->with([
            'success' => 'Status boarding berhasil diupdate.',
            'ticket' => $ticket,
            'boarding_time_formatted' => $boardingTimeFormatted,
        ]);
    }
    // public function destroy($id)
    // {
    //     try {
    //         $ticket = Ticket::findOrFail($id);
    //         $ticket->delete();
    //         return response()->json([
    //             'message' => 'Ticket berhasil di delete!'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'message' => 'Ticket tidak ditemukan!'
    //         ], 404);
    //     }
    // }
    public function destroy($id)
    {
        try {
            $ticket = Ticket::findOrFail($id);
            $ticket->delete();
            return redirect()->back()->with('success', 'Berhasil menghapus tiket!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Validasi gagal. e-rror: ' . $e->getMessage());
        }
    }
}

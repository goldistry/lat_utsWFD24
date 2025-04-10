<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'passenger_name',
        'passenger_phone',
        'seat_number',
        'is_boarding',
        'boarding_time',
        'flight_id',
    ];
    protected $hidden = [
        'updated_at'
    ];
    public static function validationRules()
    {
        return [
            'passenger_name' => 'required|string',
            'passenger_phone' => 'required|string|min:14|max:14',
            'seat_number' => [
                'required',
                'string',
                'min:3',
                'max:3',
                'regex:/^[A-Z][0-9]{2}$/', // Regex untuk format A-Z, 0-9, 0-9
            ],
            'is_boarding' => 'boolean',
            'boarding_time' => 'datetime|nullable',
        ];
    }

    public static function validationMessages()
    {
        return [
            'passenger_name.required' => 'Nama penumpang wajib diisi.',
            'passenger_name.string' => 'Nama penumpang harus berupa teks.',

            'passenger_phone.required' => 'Nomor telepon penumpang wajib diisi.',
            'passenger_phone.string' => 'Nomor telepon penumpang harus berupa teks.',
            'passenger_phone.min' => 'Nomor telepon penumpang minimal harus :min karakter.',
            'passenger_phone.max' => 'Nomor telepon penumpang maksimal harus :max karakter.',

            'seat_number.required' => 'Nomor kursi wajib diisi.',
            'seat_number.string' => 'Nomor kursi harus berupa teks.',
            'seat_number.min' => 'Nomor kursi minimal harus :min karakter.',
            'seat_number.max' => 'Nomor kursi maksimal harus :max karakter.',
            'seat_number.regex' => 'Nomor kursi harus terdiri dari 1 huruf besar (A-Z) diikuti oleh 2 angka (0-9).', // Pesan untuk regex

            'is_boarding.boolean' => 'Status boarding harus berupa benar atau salah.',

            'boarding_time.datetime' => 'Format waktu boarding tidak valid.',
            'boarding_time.nullable' => 'Waktu boarding boleh kosong.',
        ];
    }

    public function flights()
    {
        return $this->belongsTo(Flight::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $fillable = [
        'flight_code',
        'origin',
        'destination',
        'departure_time',
        'arrival_time',
    ];
    protected $hidden = [
        'updated_at'
    ];
    public static function validationRules()
    {
        return [
            'flight_code' => 'string|min:5|max:5|required|unique',
            'origin' => 'string|min:3|max:3|required',
            'destination' => 'string|min:3|max:3|required',
            'departure_time' => 'datetime|required',
            'arrival_time' => 'datetime|required',
        ];
    }

    public static function validationMessages()
    {
        return [
            'flight_code.required' => 'Kode penerbangan wajib diisi.',
            'flight_code.string' => 'Kode penerbangan harus berupa teks.',
            'flight_code.unique' => 'Kode penerbangan harus unik.',
            'flight_code.min' => 'Kode penerbangan minimal harus :min karakter.',
            'flight_code.max' => 'Kode penerbangan maksimal harus :max karakter.',

            'origin.required' => 'Asal penerbangan wajib diisi.',
            'origin.string' => 'Asal penerbangan harus berupa teks.',
            'origin.min' => 'Asal penerbangan minimal harus :min karakter.',
            'origin.max' => 'Asal penerbangan maksimal harus :max karakter.',

            'destination.required' => 'Tujuan penerbangan wajib diisi.',
            'destination.string' => 'Tujuan penerbangan harus berupa teks.',
            'destination.min' => 'Tujuan penerbangan minimal harus :min karakter.',
            'destination.max' => 'Tujuan penerbangan maksimal harus :max karakter.',

            'departure_time.datetime' => 'Format waktu keberangkatan tidak valid.',
            'departure_time.nullable' => 'Waktu keberangkatan boleh kosong.',

            'arrival_time.datetime' => 'Format waktu kedatangan tidak valid.',
            'arrival_time.nullable' => 'Waktu kedatangan boleh kosong.',
        ];
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}

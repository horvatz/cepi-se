<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    public function vaccine()
    {
        return $this->belongsTo(Vaccine::class);
    }

    public function vaccination()
    {
        return $this->belongsTo(Vaccination::class);
    }
}

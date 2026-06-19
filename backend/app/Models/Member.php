<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'datum_rodjenja',
        'adresa',
        'datum_uclanjenja',
        'status',
        'visina_cm',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function memberships()
    {
        return $this->hasMany(Membership::class);
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'member_id');
    }

    public function bodyProgresses()
    {
        return $this->hasMany(BodyProgress::class, 'member_id');
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function slotReservations()
    {
        return $this->hasMany(SlotReservation::class);
    }

}

<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
   use HasFactory;

   protected $fillable = [
    'name',
    'email',
    'mobile',
    'address',
    'gender',
    'hobbies',
    'city',
    'state',
    'pincode',
    'profile_image',
    'license_number',
    'password',
    'status'
];

   public function bookings()
   {
       return $this->hasMany(Booking::class);
   }
}

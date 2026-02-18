<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prospect extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'name',
        'first_name',
        'email',
        'phone',
        'company_name',
        'address',
        'website',
        'activity',
        'notes',
        'status',
        'prospect_date',
        'source',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'prospect_date' => 'date',
        ];
    }

    /**
     * Get the customer associated with this prospect.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get meetings for this prospect.
     */
    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }
}

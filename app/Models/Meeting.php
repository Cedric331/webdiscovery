<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'prospect_id',
        'user_id',
        'title',
        'description',
        'start_date',
        'end_date',
        'location',
        'type',
        'notes',
        'is_completed',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'is_completed' => 'boolean',
        ];
    }

    /**
     * Get the customer associated with the meeting.
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    /**
     * Get the prospect associated with the meeting.
     */
    public function prospect()
    {
        return $this->belongsTo(Prospect::class);
    }

    /**
     * Get the user who organized the meeting.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

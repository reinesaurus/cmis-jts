<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id',
        'customer_code',
        'customer_type_id',
        'membership_trial_id',
        'phone_number',
        'notes',
        'status',
        'points_balance'
    ];

    public function type()
    {
        return $this->belongsTo(
            CustomerType::class,
            'customer_type_id',
            'customer_type_id'
        );
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'customer_id');
    }

    public function membershipTier()
    {
        return $this->belongsTo(MembershipTier::class, 'membership_tier_id', 'membership_tier_id');
    }

    public function getCustomerTypeNameAttribute()
    {
        return match ($this->customer_type_id) {
            1 => 'Personal',
            2 => 'Business',
            default => '-',
        };
    }
}

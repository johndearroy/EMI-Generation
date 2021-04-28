<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanApplication extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'duration', 'interest_rate', 'status', 'user'];

    protected $appends = [
        'total_interest',
        'monthly_interest',
        'monthly_principal_amount',
        'emi',
    ];

    public function getTotalInterestAttribute()
    {
        $result = (optional($this)->amount * optional($this)->duration * optional($this)->interest_rate) / 100;

        return round($result);
    }

    public function getMonthlyInterestAttribute()
    {
        return round(optional($this)->total_interest / optional($this)->duration);
    }

    public function getMonthlyPrincipalAmountAttribute()
    {
        $result = optional($this)->amount / optional($this)->duration;

        return round($result);
    }

    public function getEmiAttribute()
    {
        $result = (int)optional($this)->monthly_principal_amount + (int)optional($this)->monthly_interest;

        return round($result);
    }
}

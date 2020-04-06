<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Transection extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['transection_date', 'budget_type', 'budget_category', 'description', 'actual'];
    
    /**
     * Get the user that owns the transaction.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

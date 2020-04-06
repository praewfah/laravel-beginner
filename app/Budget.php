<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['budget_month', 'budget_year', 'budget_type', 'budget_category', 'budget_amount'];
    
    public $total = [];
    
    /**
     * Get the user that owns the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

<?php

namespace App\Models;

use App\Models\Task;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'customer_id',
        'pm_id'
    ];
    public function tasks(){
        return $this->hasMany(Task::class);
    }
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    use HasFactory;
}

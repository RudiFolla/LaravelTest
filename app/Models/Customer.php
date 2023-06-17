<?php

namespace App\Models;

use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    protected $fillable = [
        'id',
        'name',
        'surname',
        'phone'
    ];
    public function projects(){
        return $this->hasMany(Project::class);
    }
    use HasFactory;
}

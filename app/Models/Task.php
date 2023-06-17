<?php

namespace App\Models;

use App\Models\Project;
use App\Enum\TaskStateEnum;
use App\Enum\TaskPriorityEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'priority',
        'state',
        'project_id',
        'developer_id'
    ];
    protected $attributes =[
        'priority' => TaskPriorityEnum::MEDIUM,
        'state' => TaskStateEnum::TODO
    ];
    protected $casts = [
        'priority' => TaskPriorityEnum::class,
        'state' => TaskStateEnum::class
    ];
    public function project(){
        return $this->belongsTo(Project::class);
    }
    use HasFactory;
}

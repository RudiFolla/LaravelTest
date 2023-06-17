<?php
namespace  App\Enum;

enum TaskPriorityEnum:string
{
    case LOW = 'low';
    case MEDIUM ='medium';
    case HIGH = 'high';
}
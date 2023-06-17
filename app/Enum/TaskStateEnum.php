<?php
namespace  App\Enum;

enum TaskStateEnum : string
{
    case BACKLOG = 'BACKLOG';
    case TODO = 'TODO';
    case INPROGRESS = 'INPROGRESS';
    case DONE  = 'DONE';
}
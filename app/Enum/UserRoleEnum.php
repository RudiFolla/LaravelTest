<?php
namespace App\Enum;

enum UserRoleEnum:string
{
    case PM = 'ProjectManager';
    case DEV = 'Developer';
}
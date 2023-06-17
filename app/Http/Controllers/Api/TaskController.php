<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use App\Models\User;
use App\Models\Project;
use App\Enum\UserRoleEnum;
use App\Enum\TaskStateEnum;
use Illuminate\Http\Request;
use App\Enum\TaskPriorityEnum;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return TaskResource::collection(Task::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        if($request->user()->hasPermissionTo('create tasks'))
        {
            $task = Task::create($request->validated());
            return TaskResource::make($task);
        }
        return response('You don\'t have the permission for this action',403);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return TaskResource::make($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        if(true/*$request->user()->hasPermissionTo('update task')*/)
        {
            $task->update($request->validated());
            return TaskResource::make($task); 
        }
        return response('You don\'t have the permission for this action',403);
    }
    public function updateTaskState(UpdateTaskRequest $request, Task $task)
    {
        if($request->user()->hasPermissionTo('change tasks state'))
        {
            if($request->state == TaskStateEnum::DONE->value)
            {
                //logica per inviare le email 
            }
            $project = Project::all()->find($task->project_id);
            $pm = User::all()->find($project->pm_id);
            $devName = $request->user()->name;
            $taskTitle = $task->title;
            //logica per inviare email di assegnazione
            $mail_data=[
                'fromEmail'=>$request->user()->email,
                'fromName'=>$request->user()->name,
                'recipient'=>$pm->email,
                'subject'=>'Task Assignment',
                'body'=>"The task:\n $taskTitle, from project $project->name has been done by $devName"
            ];
            Mail::send('email-template',$mail_data, function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'],$mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
            $task->update($request->validated());
            return TaskResource::make($task);
        }
        return response('You don\'t have the permission for this action',403);
    }
    public function assingTaskToDeveloper(UpdateTaskRequest $request, Task $task)
    {
        if($request->user()->hasPermissionTo('assign tasks'))
        {
            if(!$request->has('developer_id'))
                return response('missing parameter developer_id',400);
            $user = User::all()->find($request->developer_id);
            if($user == null || $user->role != UserRoleEnum::DEV)
                return response('Developer not found',404);
            $pmName = $request->user()->name;
            $taskTitle = $task->title;
            //logica per inviare email di assegnazione
            $mail_data=[
                'fromEmail'=>$request->user()->email,
                'fromName'=>$request->user()->name,
                'recipient'=>$user->email,
                'subject'=>'Task Assignment',
                'body'=>"Project Manageer $pmName has assigned you this task:\n $taskTitle"
            ];
            Mail::send('email-template',$mail_data, function($message) use ($mail_data){
                $message->to($mail_data['recipient'])
                        ->from($mail_data['fromEmail'],$mail_data['fromName'])
                        ->subject($mail_data['subject']);
            });
            return $this->update($request, $task);
        }
        return response('You don\'t have the permission for this action',403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        return response('functionality not implemented',501);
    }
}

<?php

namespace Modules\ForTheBuilder\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use App\components\ImageResize;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Modules\ForTheBuilder\Entities\Deal;
use Modules\ForTheBuilder\Entities\Notification_;
use Modules\ForTheBuilder\Entities\Task;
use Modules\ForTheBuilder\Http\Requests\ForTheBuilderUserRequest;
use Modules\ForTheBuilder\Entities\Constants;


class UserChatController extends Controller
{
    public function getNotification(){
        $notification = ['Booking', 'BookingPrepayment'];
        $all_task = Notification_::where('type', 'Task')->where(['read_at' => NULL,  'user_id' => Auth::user()->id])->orderBy('created_at', 'desc')->get();
        $all_booking = Notification_::whereIn('type', $notification)->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        $all_installment_plan = Notification_::where('type', 'Installment_plan')->where('read_at', NULL)->orderBy('created_at', 'desc')->get();
        return ['all_task' => $all_task, 'all_booking' => $all_booking, 'all_installment_plan' => $all_installment_plan];
    }

    public function index()
    {
        $user = Auth::user();
        $id = $user->id;
        $model = User::findOrfail($id);
        if(Gate::allows('isAdmin')){
            $users = User::where('status',2)->where('id', '!=', $user->id)->orderBy('id','desc')->paginate(config('params.pagination'));
        }else{
            $users = User::where('status',2)->where('id', '!=', $user->id)->where('role_id', 2)->orderBy('id','desc')->paginate(config('params.pagination'));
        }
        $my_tasks = Task::where('performer_id', $id)->get();
        $tasks = count(Task::where('performer_id', $id)->get());
        $tasks_ended = count(Task::where('performer_id', $id)->where('status', 1)->get());
        $tasks_not_ended = count(Task::where('performer_id', $id)->where('status', NULL)->get());
        $task_count = [];
        $task_count['count'] = [];
        $task_count['task_date'] = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $monthly_count = [];
        if(!empty($my_tasks)){
            foreach($my_tasks as $task){
                $task_array = explode('-',$task->task_date);
                if($task_array[0] == date('Y')){
                    $task_count['task_date'][] = $task_array[1];
                    $taskcount = count(Task::where('task_date', $task->task_date)->get());
                    $task_count['count'][] = $taskcount;
                }
            }
            if(!empty($task_count['task_date'])){
                $monthly_count = array_count_values($task_count['task_date']);
            }
        }

        return view('forthebuilder::user-chat.index',[
            'model' => $model,
            'users' => $users,
            'user' => $user,
            'tasks' => $tasks,
            'tasks_ended' => $tasks_ended,
            'tasks_not_ended' => $tasks_not_ended,
            'monthly_count' => $monthly_count,
            'my_tasks' => $my_tasks,
            'task_count' => $task_count,
            'all_notifications' => $this->getNotification()
        ]);
    }
}

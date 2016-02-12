<?php

namespace App\Http\Controllers;

use App\Task;
use App\Todo;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * The task repository instance.
     *
     * @var TaskRepository
     */
    protected $tasks;

    /**
     * Create a new controller instance.
     *
     * @param  TaskRepository  $tasks
     * @return void
     */
    public function __construct(TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {

         \Log::info('.......shoud not be here.......in task controller index method.............');
       
    //   $tasks = DB::select('SELECT * FROM tasks where user_id = 6;');
      //  \Log::info($tasks);
     //   return view ('tasks.index',['tasks' => $tasks]);
        // return view('tasks.index', [
        //     'tasks' => $this->tasks->forUser($request->user()),
        // ]);
         return redirect('/user/userhomepage');
    }

    /**
     * Create a new task.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
      //  Debugbar::info("alamin is storing task");
     //   Debugbar::addMessage('Another message', 'mylabel');
    //    \Log::info('**********...in task controller store method : trying to insert info to tasks.');
        /*
        $this->validate($request, [
            'name' => 'required|max:255',
        ]);

        $request->user()->tasks()->create([
            'name' => $request->name,
        ]);

        */
  //      $a = new Todo();
  //      $a->insertToTask($request->name);
     //  Todo::insertToTask($request->name);


   //     DB::insert('insert into tasks (user_id, name, created_at, updated_at) '.
     //       'values (?, ? , ?, ?)', [6, $request->name,'now()', 'now()']);
     //   DB::INSERT INTO `tasks` (`user_id`, `name`, `created_at`, `updated_at`) VALUES ('6', 'php4', now(), now());

        return redirect('/user/userhomepage');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Task  $task
     * @return Response
     */
    public function destroy(Request $request, Task $task)
    {
        $this->authorize('destroy', $task);

        $task->delete();

        return redirect('/tasks');
    }
}

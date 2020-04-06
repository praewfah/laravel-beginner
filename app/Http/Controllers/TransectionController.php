<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Transection;
use App\Repositories\TaskRepository;
use App\Repositories\TransectionRepository;

class TransectionController extends Controller
{
    /**
     * The budget repository instance.
     *
     * @var TransectionRepository
     */
    protected $transections;
    
    /**
     * Create a new controller instance.
     *
     * @param  TransectionRepository  $transections
     * @return void
     */
    public function __construct(TransectionRepository $transections, TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->transections = $transections;
        $this->tasks = $tasks;
    }

    /**
     * Display a list of all of the user's budget.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $timestamp    = strtotime(date("Y-m-d"));
        $date_from = date('Y-m-01', $timestamp);   
        $date_to = date('Y-m-d');  
        
        return view('transections.index', [
            'transections' => $this->transections->forUser($request->user(), $date_from, $date_to),
            'date_to' => $date_to,
            'date_from' => $date_from,
            'tasks' => $this->tasks->forUser($request->user())
        ]);
    }
    
    /**
     * Display a list of all of the user's budget.
     *
     * @param  Request  $request
     * @return Response
     */
    public function filters(Request $request)
    {
        if ($request->isMethod('post')) {
            $date_from = date('Y-m-d', strtotime($request->date_from));   
            $date_to = date('Y-m-d', strtotime($request->date_to));

            echo view('transections.items', [
                'transections' => $this->transections->forUser($request->user(), $date_from, $date_to),
                'date_to' => $date_to,
                'date_from' => $date_from
            ]);
        }
    }

    /**
     * Create a new budget.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'transection_date', 
            'budget_type', 
            'budget_category', 
            'description', 
            'actual'
        ]);

        $request->user()->transections()->create([
            'transection_date' =>  $request->transection_date,
            'budget_type' =>  $request->budget_type,
            'budget_category' =>  $request->budget_category,
            'description' =>  $request->description,
            'actual' =>  $request->actual,
        ]);

        return redirect('/transections');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Transection $budget
     * @return Response
     */
    public function destroy(Request $request, Transection $transection)
    {
        //$this->authorize('destroy', $task);

        $transection->delete();

        return redirect('/transections');
    }
}

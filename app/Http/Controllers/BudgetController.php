<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Budget;
use App\Repositories\TaskRepository;
use App\Repositories\BudgetRepository;

class BudgetController extends Controller
{
    /**
     * The budget repository instance.
     *
     * @var BudgetRepository
     */
    protected $budgets;
    private $list_month = [
            "January" => "01",
            "February" => "02",
            "March" => "03",
            "April" => "04",
            "May" => "05",
            "June" => "06",
            "July" => "07",
            "August" => "08",
            "September" => "09",
            "October" => "10",
            "November" => "11",
            "December" => "12"
        ];

    /**
     * Create a new controller instance.
     *
     * @param  BudgetRepository  $budgets
     * @return void
     */
    public function __construct(BudgetRepository $budgets, TaskRepository $tasks)
    {
        $this->middleware('auth');

        $this->budgets = $budgets;  
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
        if ($request->isMethod('post')) {
            $month = $m = $request->month;
            $year = $request->year;
        } else {
            $month = date("F");
            $year = date("Y");
            $m = date("m");
        }
            
        $budgets = $this->budgets->forUser($request->user(), $m, $year);
        $total = $budgets['total'];
       
        unset($budgets['total']);  //unset
        
        return view('budgets.index', [
            'budgets' => $budgets,
            'total' => $total,
            'month' => $month,
            'year' => $year,
            'list_month' => $this->list_month,
            'tasks' => $this->tasks->forUser($request->user())
        ]);
    }
    
    public function filters(Request $request)
    {
        if ($request->isMethod('post')) {
            $month = $request->month;
            $year = $request->year;
        
            $budgets = $this->budgets->forUser($request->user(), $month, $year);
            $total = $budgets['total'];

            unset($budgets['total']);  //unset

            echo view('budgets.items', [
                'budgets' => $budgets,
                'total' => $total,
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
       // var_dump($request->budget_month) ; exit;
        $this->validate($request, [
            'budget_month' => 'required|max:255',
            'budget_year' => 'required|max:255',
            'budget_type' => 'required|max:255',
            'budget_category' => 'required|max:255',
            'budget_amount' => 'required|max:255',
        ]);

        $request->user()->budgets()->create([
            'budget_month' =>  $request->budget_month,
            'budget_year' =>  $request->budget_year,
            'budget_type' =>  $request->budget_type,
            'budget_category' =>  $request->budget_category,
            'budget_amount' =>  $request->budget_amount,
        ]);

        return redirect('/budgets');
    }

    /**
     * Destroy the given task.
     *
     * @param  Request  $request
     * @param  Budget $budget
     * @return Response
     */
    public function destroy(Request $request, Budget $budget)
    {
        //$this->authorize('destroy', $budget);
        $user = $request->user();

        $budget->where([
            ['user_id', '=', $user->id],
            ['budget_year', '=', $request->budget_year],
            ['budget_type', '=', $request->budget_type],
            ['budget_category', '=', $request->budget_category],
        ])->delete();

        return redirect('/budgets');
    }
}

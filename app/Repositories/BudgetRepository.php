<?php

namespace App\Repositories;

use App\User;
use App\Budget;
use App\Transection;

class BudgetRepository
{
    /**
     * Get all of the budgets for a given user.
     *
     * @param  User  $user
     * @return Collection
     */
    public function forUser(User $user, $month, $year)
    {
        $return_data = [] ;
        $total_actual_income = $total_actual_expense = 0 ;
        
        $budgets = Budget::where([['user_id', '=', $user->id], ['budget_year', '=', $year], ['budget_month', '=', $month]])
                ->selectRaw('budget_year, budget_month, budget_type, budget_category, sum(budget_amount) as budget_amount')
                ->groupBy('budget_year', 'budget_month', 'budget_type', 'budget_category')
                ->orderBy('budget_type', 'budget_category')->get();
        
        foreach ($budgets as $key => $row) {
            $return_data[$key] = $row;
            
            $transections = Transection::select('budget_type', 'budget_category')
                ->selectRaw('sum(actual) as actual')
                ->whereYear('transection_date', '=', $row->budget_year)
                ->whereMonth('transection_date', '=', $row->budget_month)
                ->where([['user_id', '=', $user->id], ['budget_type', '=', $row->budget_type], ['budget_category', '=', $row->budget_category]])
                ->groupBy('budget_type', 'budget_category')->get();
            
            foreach ($transections as $data) {
                if ($data->budget_type == "Income") {
                    $diff = ((float)$row->budget_amount - (float)$data->actual) *-1;
                    $total_actual_income = $total_actual_income + (float)$data->actual;
                } else {
                    $diff = ((float)$row->budget_amount - (float)$data->actual);
                    $total_actual_expense = $total_actual_expense + (float)$data->actual;
                }
                $return_data[$key]->actual = (float)$data->actual;
                $return_data[$key]->difference = $diff;
            }
        }
        
        $return_data['total'] = new \stdClass();
        $return_data['total']->actual_income = (float)$total_actual_income;
        $return_data['total']->actual_expense = (float)$total_actual_expense;
        $return_data['total']->actual_balance = (float)$total_actual_income - (float)$total_actual_expense;
            
        return $return_data;
    }
}

<div class="panel panel-info">
    <div class="panel-body text-center">
        <div class="row">
            <div class="col-sm-4">
                <div class="text-info">Actual Incomes</div>
                <div class="text-info">{{ number_format($total->actual_income, 2) }}</div>
          </div>
          <div class="col-sm-4">
                <div class="text-info">Actual Expenses</div>
                <div class="text-info">{{ number_format($total->actual_expense, 2) }}</div>
          </div>
          <div class="col-sm-4">
                <div class="text-warning">The Balances</div>
                <div class="text-warning">{{ number_format($total->actual_balance, 2) }}</div>
          </div>
        </div>
    </div>
</div>

<table class="table task-table">
    <thead>
        <th class="text-center">Type</th>
        <th class="text-center">Category</th>
        <th class="text-center">Budget</th>
        <th class="text-center">Actual</th>
        <th class="text-center">Difference</th>
        <th></th>
    </thead>
    <tbody>
        @foreach ($budgets as $key => $budget)
            <tr  @if ($budget->budget_type == 'Income') class="active" @endif>
                <td class="table-text"><div>{{ $budget->budget_type }}</div></td>
                <td class="table-text"><div>{{ $budget->budget_category }}</div></td>
                <td class="table-text text-right">
                    <div>{{ number_format($budget->budget_amount, 2) }}</div>
                </td>
                <td class="table-text text-right">
                    <div>
                    @if (!isset($budget->actual) || empty($budget->actual) || !$budget->actual) 0
                    @else {{ number_format($budget->actual, 2) }}
                    @endif
                    </div>
                </td>
                <td class="table-text text-right">
                    <div>
                    @if (!isset($budget->difference) || empty($budget->difference) || !$budget->difference) 0
                    @else {{ number_format($budget->difference, 2) }}
                    @endif
                    </div>
                </td>

                <!-- Task Delete Button -->
                <td class="text-right">
                    <form action="{{ url('budget/delete') }}" method="POST">
                        {{ csrf_field() }}
                        <input type="hidden" name="budget_year" value="{{ $budget->budget_year }}">
                        <input type="hidden" name="budget_month" value="{{ $budget->budget_month }}">
                        <input type="hidden" name="budget_type" value="{{ $budget->budget_type }}">
                        <input type="hidden" name="budget_category" value="{{ $budget->budget_category }}">
                        <button type="submit" class="btn btn-danger">
                            <i class="fa fa-btn fa-trash"></i>Delete
                        </button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
    
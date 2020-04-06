@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-sm-offset-2 col-sm-8">
            <div class="panel panel-default">
                <div class="panel-heading">
                   
                    <a class="" data-toggle="collapse" href="#collapseOne" role="button" aria-expanded="false" aria-controls="collapseOne">
                       <i class="glyphicon glyphicon-plus"></i>  New Budget 
                    </a>
                    
                </div>

                <div class="panel-body collapse" id="collapseOne">
                    <!-- Display Validation Errors -->
                    @include('common.errors')
                   
                    <!-- New Budget Form -->
                    <form action="{{ url('budget') }}" method="POST" class="form-horizontal">
                        {{ csrf_field() }}

                        <!-- Budget Name -->
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="budget-date-1" >Budget for</label>
                            <div class="col-sm-6">
                                <div class="row">
                                <div class="col-sm-6">
                                <select class="form-control" id="udget-date-1" name="budget_month" required>
                                    @foreach ($list_month as $m => $val)
                                    <option value="{{ $val }}" @if ($month == $m)selected="selected"@endif>{{ $m }}</option>
                                    @endforeach
                                </select>
                                </div>
                                <div class="col-sm-6">
                                <select class="form-control" id="udget-date-2" name="budget_year" required>
                                    @for ($y=($year-10); $y <= $year; $y++)
                                    <option value="{{ $y }}" @if ($year == $y)selected="selected"@endif>{{ $y }}</option>
                                    @endfor
                                </select>
                                </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-budget-type">Type</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="input-budget-type" name="budget_type" required>
                                    <option value="">--</option>
                                    <option value="Income">Income</option>
                                    <option value="Expense">Expense</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-budget-category">Category</label>
                            <div class="col-sm-6">
                                <select class="form-control" id="input-budget-category" class="disabled" disabled="disabled"></select>
                                <select class="form-control" id="input-budget-categoryExpense" style="display:none" name="budget_category" disabled="disabled" required>
                                    <option value="">--</option>
                                    <option value="Auto">Auto</option>
                                    <option value="Electricity">Electricity</option>
                                    <option value="Entertainment">Entertainment</option>
                                    <option value="Food">Food</option>
                                    <option value="Home">Home</option>
                                    <option value="Household repairs">Household repairs</option>
                                    <option value="Loans">Loans</option>
                                    <option value="Medical">Medical</option>
                                    <option value="Oil/Gas">Oil/Gas</option>
                                    <option value="Personal Items">Personal Items</option>
                                    <option value="Rent/Mortgage/Insurance">Rent/Mortgage/Insurance</option>
                                    <option value="Savings">Savings</option>
                                    <option value="Telephone/Internet">Telephone/Internet</option>
                                    <option value="Travel">Travel</option>
                                    <option value="Utilities">Utilities</option>
                                    <option value="Water">Water</option>
                                    <option value="Other">Other</option>
                                </select>
                                <select class="form-control" id="input-budget-categoryIncome" style="display:none" name="budget_category" disabled="disabled" required>
                                    <option value="">--</option>
                                    <option value="Salary">Salary</option>
                                    <option value="Spouse Salary">Spouse Salary</option>
                                    <option value="Bonus">Bonus</option>
                                    <option value="Dividens">Dividens</option>
                                    <option value="Gifts Received">Gifts Received</option>
                                    <option value="Interest">Interest</option>
                                    <option value="Investing Income">Investing Income</option>
                                    <option value="Reimbursements">Reimbursements</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-3 control-label" for="input-budget-amount">Budget</label>
                            <div class="col-sm-6">
                                <input class="form-control" type="text" id="input-budget-amount" name="budget_amount" placeholder="1500" required>
                            </div>
                        </div>
                        
                        <!-- Add Button -->
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-btn fa-plus"></i>Add Budget
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Current Budgets -->
            @if (count($budgets) > 0)
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="text-left">
                        <form class="form-inline" id="filters" method="post" action="javascript:void(0)">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ asset('/') }}" id="host">
                            <input type="hidden" value="budget" id="search_type">
                            <div class="form-group">
                                <label class="" for="upget-date-1">Result Budgets for : </label>
                                <select class="form-control" id="udget-date-1" name="month" required>
                                    @foreach ($list_month as $m => $val)
                                    <option value="{{ $val }}" @if ($month == $m)selected="selected"@endif>{{ $m }}</option>
                                    @endforeach
                                </select> 
                            </div>
                            <div class="form-group">
                                <select class="form-control" id="udget-date-2" name="year" required>
                                    @for ($y=($year-10); $y <= $year; $y++)
                                    <option value="{{ $y }}" @if ($year == $y)selected="selected"@endif>{{ $y }}</option>
                                    @endfor
                                </select> 
                            </div>
                            <button type="submit" class="btn btn-default" id="filter-submit">Search</button>
                        </form>
                    </div>
                </div>
                <!-- Display Budget items -->
                <div class="panel-body" id="search-result">
                    @include('budgets.items')
                </div>
            </div>
            @endif
            
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container">
        <header class="page-header">
            <h1>Salary Checker</h1>
            <p class="lead">To ensure we're aligned, please use this tool to see if an opportunity's compensation meets my minimum requirements.</p>
        </header>

        <div class="salary-checker-app">
            <form id="salary-checker-form" novalidate>
                <div class="form-row">
                    <div class="form-group" style="flex-grow: 2;">
                        <label for="salary-low">Salary Range (Low End)</label>
                        <input type="number" id="salary-low" name="low" required>
                    </div>
                    <div class="form-group" style="flex-grow: 2;">
                        <label for="salary-high">Salary Range (High End)</label>
                        <input type="number" id="salary-high" name="high">
                    </div>
                    <div class="form-group" style="flex-grow: 1;">
                        <label for="salary-type">Rate</label>
                        <select id="salary-type" name="type">
                            <option value="yearly" selected>Per Year</option>
                            <option value="hourly">Per Hour</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="button button-primary">
                    <i class="fa-duotone fa-calculator fa-fw"></i> Check Salary
                </button>
            </form>
            <div id="salary-result-container" style="margin-top: 1.5rem;" aria-live="polite"></div>
        </div>
    </div>
@endsection

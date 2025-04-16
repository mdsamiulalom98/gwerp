<ul class="scroll_menu">
	<li><a href="{{route('companies.index')}}" class="{{ request()->is('admin/company/*') ? 'active' : '' }}">Company</a></li>
	<li><a href="{{route('branches.index')}}" class="{{ request()->is('admin/branch/*') ? 'active' : '' }}">Branch</a></li>
	<li><a href="{{route('departments.index')}}" class="{{ request()->is('admin/department/*') ? 'active' : '' }}">Department</a></li>
	<li><a href="{{route('designations.index')}}" class="{{ request()->is('admin/designation/*') ? 'active' : '' }}">Designation</a></li>
	<li><a href="{{route('allowancetypes.index')}}" class="{{ request()->is('admin/allowancetype/*') ? 'active' : '' }}">Allowance Type</a></li>
    <li><a href="{{route('loanoptions.index')}}" class="{{ request()->is('admin/loanoption/*') ? 'active' : '' }}">Loan Option</a></li>
    <li><a href="{{route('deductionoptions.index')}}" class="{{ request()->is('admin/deductionoption/*') ? 'active' : '' }}">Deduction Option</a></li>
    <li><a href="{{route('documenttypes.index')}}" class="{{ request()->is('admin/documenttype/*') ? 'active' : '' }}">Document Type</a></li>
    <li><a href="{{route('paysliptypes.index')}}" class="{{ request()->is('admin/paysliptype/*') ? 'active' : '' }}">Payslip Type</a></li>
    <li><a href="{{route('leavetypes.index')}}" class="{{ request()->is('admin/leavetype/*') ? 'active' : '' }}">Leave Type</a></li>
    <li><a href="{{route('awardtypes.index')}}" class="{{ request()->is('admin/awardtype/*') ? 'active' : '' }}">Award Type</a></li>
    <li><a href="{{route('terminationtypes.index')}}" class="{{ request()->is('admin/terminationtype/*') ? 'active' : '' }}">Termination Type</a></li>
    <li><a href="{{route('performancetypes.index')}}" class="{{ request()->is('admin/performancetype/*') ? 'active' : '' }}">Performance Type</a></li>
    <li><a href="{{route('competencies.index')}}" class="{{ request()->is('admin/competence/*') ? 'active' : '' }}">Competence</a></li>
    <li><a href="{{route('goaltypes.index')}}" class="{{ request()->is('admin/goaltype/*') ? 'active' : '' }}">Goal Type</a></li>
    <li><a href="{{route('trainingtypes.index')}}" class="{{ request()->is('admin/trainingtype/*') ? 'active' : '' }}">Training Type</a></li>
</ul>
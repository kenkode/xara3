 <nav class="navbar-default navbar-static-side" role="navigation" id="wrap">
    
           


            <div class="sidebar-collapse">

                <ul class="nav" id="side-menu">

                    <li>
                        <a href="{{ URL::to('payrollReports/selectPeriod') }}" ><i class="glyphicon glyphicon-file fa-fw"></i> Monthly Payslips</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectSummaryPeriod') }}" ><i class="glyphicon glyphicon-file fa-fw"></i> Payroll Summary</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectRemittancePeriod') }}" ><i class="glyphicon glyphicon-file fa-fw"></i> Pay Remittance</a>
                    </li>

                    <li>
                        <a href="{{ URL::to('payrollReports/selectEarning') }}"><i class="glyphicon glyphicon-file fa-fw"></i> Earning Report</a>
                    </li>  

                    <li>
                        <a href="{{ URL::to('payrollReports/selectAllowance') }}"><i class="glyphicon glyphicon-file fa-fw"></i> Allowance Report</a>
                    </li>  

                    <li>
                        <a href="{{ URL::to('payrollReports/selectnontaxableincome') }}"><i class="glyphicon glyphicon-file fa-fw"></i> Non Taxable Income Report</a>
                    </li>  

                    

                    <li>
                        <a href="{{ URL::to('payrollReports/selectDeduction') }}" ><i class="glyphicon glyphicon-file fa-fw"></i> Deduction Report</a>
                    </li>  

                    
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
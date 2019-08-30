<!-- <link href="{!! asset('public/web/css/custom.css') !!}" rel='stylesheet'> -->
<style type="text/css">
    body {
      font-family: Calibri (Body);
    }
    .trainee_info tr > td{
      padding: 0 5px;
      border: 1px solid #000;
    }
  </style>
  
  <!-- COMPANY LOGO -->
  <div style="text-align: right; padding: 12px 20px 0;">
      <!-- <img src="https://sudoksho.com/public/web/images/logo.png" style="height: 50px;"> -->
  </div>
  
  <!-- REPORT TITLE -->
  <div style="text-align: center; margin-top: -15px;">
      <h2 style="font-family: sans-serif;">{{$employeeDetails->name}}'s Report</h2>
  </div>
  
  <p style="margin-top: 5px;">&nbsp;</p>
  
  <!-- TRAINEE INFO -->
  <table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" class="trainee_info">
        <tr>
            <td rowspan="2" align="center" style="font-size: 12px">Attendance Date</td>
            <td rowspan="2" align="center" style="font-size: 12px">Check In</td>
            <td  rowspan="2" align="center" style="font-size: 12px">Check Out</td>
        </tr>
        <tr>
    
        </tr>
        @foreach ($employeeReport as $report)
        <?php 
            $start_time = DateTime::createFromFormat('H:i:s', $report->start_time)->format('g:i A');
            $end_time = DateTime::createFromFormat('H:i:s', $report->end_time)->format('g:i A');
        ?>
        <tr>
            <td style="font-size: 12px; text-align:center;">{{$report->attend_date}}</td>
            <td style="font-size: 12px; text-align:center;">{{$start_time}}</td>
            <td style="font-size: 12px; text-align:center;">{{$end_time}}</td>
        </tr>
        @endforeach

  
  
  </table>
<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\BTS;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\Project;
use App\Models\Service;
use App\Models\SpotLightEvent;
use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use DB;
use App\Models\Event;
use App\Models\Gallery;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    $data = array();
    $data['spotlight_events'] = SpotLightEvent::count();
    $data['bts'] = BTS::count();
    $data['pages'] = Page::count();
    $data['events'] = Event::count();
    $data['media'] = Gallery::count();

    return view('dashboard', $data);
  }

  public function ajax(Request $request)
  {
    $date = explode(" - ", $request->date);
    if ($request->action == "invoice") {
      $data = Invoice::where('invoice_date', '>=', date("Y-m-d", strtotime($date[0])))->where('invoice_date', '<=', date("Y-m-d", strtotime($date[1])))->orderBy('id', 'desc')->get();
      $output = '';
      if (count($data)) {
        foreach ($data as $item) {
          $output .= '
          <tr>
              <td>' . $item->id . '</td>
              <td>' . $item->invoice_number . '</td>
              <td>' . $item->customer_name . '</td>
              <td>
                  <span class="badge badge-light-primary">Invoice Date:
                      ' . $item->invoice_date . '</span>
                  <span class="badge badge-light-success">Payment Date:
                      ' . $item->payment_date . '</span>
              </td>
              <td>
                  <span class="badge badge-light-primary">Total:
                      ' . $item->invoice_total . '</span>
                  <span class="badge badge-light-success">Paid:
                      ' . $item->amount_paid . '</span>
                  <span class="badge badge-light-danger">Remaining:
                      ' . $item->balance . '</span>

              </td>
              <td>' . $item->html_status . '
              </td>
          </tr>
          ';
        }
      } else {
        $output .= '
        <tr>
          <td colspan="6" align="center"><b>No Records Found</b></td>
        </tr>
      ';
      }

      echo $output;
    }

    if ($request->action == "projects") {
      $data = Project::where('start_date', '>=', date("Y-m-d", strtotime($date[0])))->where('start_date', '<=', date("Y-m-d", strtotime($date[1])))->orderBy('id', 'desc')->get();
      $output = '';
      if (count($data)) {
        foreach ($data as $item) {
          $output .= '
          <tr>
            <td>' . $item->id . '</td>
            <td>' . $item->project_number . '</td>
            <td>' . $item->customer_name . '</td>
            <td>
                <span class="badge badge-light-primary">To:
                    ' . $item->start_date . '</span>
                <span class="badge badge-light-primary">From:
                    ' . $item->expected_end_date . '</span>
                <span class="badge badge-light-success">
                    ' . $item->day . ' Days
                </span>
            </td>
            <td>
                <span class="badge badge-light-primary">Total:
                    ' . $item->project_total . '</span>
                <span class="badge badge-light-success">Paid:
                    ' . $item->amount_paid . '</span>
                <span class="badge badge-light-danger">Remaining:
                    ' . $item->balance . '</span>

            </td>
            <td>' . $item->html_status . '
            </td>
          </tr>
          ';
        }
      } else {
        $output .= '
        <tr>
          <td colspan="6" align="center"><b>No Records Found</b></td>
        </tr>
      ';
      }

      echo $output;
    }
    if ($request->action == "project_summary") {
      $data = DB::select("select count(*) as total_count,sum(project_total) as total_earning from projects where start_date >=? and start_date <=? ", [date("Y-m-d", strtotime($date[0])), date("Y-m-d", strtotime($date[1]))]);
      $output = '';
      if (count($data)) {
        foreach ($data as $item) {
          $output .= '
          <tr>
            <td>' . $item->total_count . '</td>
            <td>' . $item->total_earning . '</td>
            
          </tr>
          ';
        }
      } else {
        $output .= '
        <tr>
          <td colspan="2" align="center"><b>No Records Found</b></td>
        </tr>
      ';
      }

      echo $output;
    }


    if ($request->action == "sales") {
      $expense_total = (float)Expense::where('expddate', '>=', date("Y-m-d", strtotime($date[0])))->where('expddate', '<=', date("Y-m-d", strtotime($date[1])))->sum("expenseamount");
      $earning_total = (float)Invoice::where('invoice_date', '>=', date("Y-m-d", strtotime($date[0])))->where('invoice_date', '<=', date("Y-m-d", strtotime($date[1])))->sum("amount_paid");
      $data = DB::select("SELECT payment_method,sum(invoice_total) as invoice_total,sum(amount_paid) as amount_paid, sum(balance) as balance FROM `invoices` where invoice_date >= '" . date("Y-m-d", strtotime($date[0])) . "' and invoice_date <= '" . date("Y-m-d", strtotime($date[1])) . "' GROUP BY payment_method;");
      $profit = $earning_total - $expense_total;
      $output = '';
      if (count($data)) {
        foreach ($data as $item) {
          $output .= '
          <tr>
            <td>£' . $item->invoice_total . '</td>
            <td>' . $item->payment_method . '</td>
            <td>£' . $item->amount_paid . '</td>
            <td>£' . $item->balance . '</td>
          </tr>
          ';
        }
      } else {
        $output .= '
        <tr>
          <td colspan="4" align="center"><b>No Records Found</b></td>
        </tr>
      ';
      }


      $output_array[] = number_format($earning_total, 2);
      $output_array[] = number_format($expense_total, 2);
      $output_array[] = number_format($profit, 2);
      $output_array[] = $output;

      echo json_encode($output_array);
    }
  }
}

<?php

namespace App\Http\Controllers\Back;

use DateTime;
use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function report_view(){
        return view('back.admin.report.report_view');
    } // End Method
    
    public function search_by_date(Request $request){
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');

        $orders = Order::where('order_date', $formatDate)->latest()->get();
        return view('back.admin.report.report_by_date', compact('orders', 'formatDate'));
    }

    public function search_by_month(Request $request){
        $month = $request->month;
        $year = $request->year_name;

        $orders = Order::where('order_month', $month)->where('order_year', $year)->latest()->get();
        return view('back.admin.report.report_by_month', compact('orders', 'month', 'year'));
    }// End Method 


    public function search_by_year(Request $request){ 
        $year = $request->year;

        $orders = Order::where('order_year', $year)->latest()->get();
        return view('back.admin.report.report_by_year', compact('orders', 'year'));
    }

    public function order_by_user(){
        $users = User::where('role', 'user')->latest()->get();
        return view('back.admin.report.report_by_user', compact('users'));

    }// End Method 

    public function search_by_user(Request $request){
        $user_id = $request->user;
        $user = User::where('id', $user_id)->first();
        $orders = Order::where('user_id', $user_id)->latest()->get();
        return view('back.admin.report.report_by_user_show', compact('orders', 'user'));
    }
}

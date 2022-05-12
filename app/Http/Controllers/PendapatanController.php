<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Order;

class PendapatanController extends Controller
{
    public function index()
    {
        $dataByMonth = Order::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('m');
        });

        $dataByYear = Order::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('Y');
        });

        $dataByDay = Order::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('d');
        });

        $dataByDayOfWeek = Order::get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->format('l');
        });

        $dataByToday = Order::whereDate('created_at', Carbon::today())->get();

        return view('pages.pendapatan.index', compact('dataByToday','dataByDayOfWeek','dataByMonth', 'dataByYear'));
    }

    public function getData()
    {
        $data = Order::get();

        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } else if ($data == null) {
            return response()->json([
                'status' => 'failed',
                'data' => null,
                'message' => 'Data tidak ditemukan',
            ]);
        } else {
            abort(401, 'Silahkan login terlebih dahulu');
        }
    }

    public function detail($param, $date)
    {
        if ($param == 'day') {
            $data = Order::whereDate('created_at', $date)->whereMonth('created_at', Carbon::parse($date)->format('m'))->get();
            $displayDate = Carbon::parse($date)->format('d F Y');
        } elseif ($param == 'month') {
            $month = Carbon::parse($date)->format('m');
            $data = Order::whereMonth('created_at', $month)->get();
            $displayDate = Carbon::parse($date)->format('F Y');
        }

        return view('pages.pendapatan.detail', compact('data', 'displayDate'));

    }

    public function sort($param)
    {
        if ($param == 'month') {
            $data = Order::get()->groupBy(function($d) {
                return Carbon::parse($d->created_at)->format('m');
            });
        } elseif ($param == 'day') {
            $data = Order::get()->groupBy(function($d) {
                return Carbon::parse($d->created_at)->format('d-m');
            });
        } elseif ($param == 'all') {
            $data = Order::get();
        }

        if ($data) {
            return response()->json([
                'status' => true,
                'data' => $data
            ]);
        } else if ($data == null) {
            return response()->json([
                'status' => 'failed',
                'data' => null,
                'message' => 'Data tidak ditemukan',
            ]);
        } else {
            abort(401, 'Silahkan login terlebih dahulu');
        }
    }

}

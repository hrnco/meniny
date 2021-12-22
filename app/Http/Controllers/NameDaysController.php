<?php

namespace App\Http\Controllers;

use App\Models\NameDays;
use Illuminate\Http\Request;

class NameDaysController extends Controller
{
    public function index() {
        $date = (new \DateTime())->setDate(1972, date("m"), date("d"));
        $nameDay = NameDays::query()->where('name_day', $date->format("Y-m-d"))->get()->first();
        return view('name_days')
            ->with('date', date("d.m.Y"))
            ->with('name', $nameDay ? $nameDay->name : '-')
            ;
    }

    public function ajaxNames(Request $request) {

        $nameDays = NameDays::query()->where('name', 'like', '%'.$request->get('q').'%')->limit(50)->get();
        $results = [];

        foreach($nameDays as $nameDay) {
            $results[] = [
                'id' => $nameDay->id,
                'text' => $nameDay->name,
            ];
        }
        return [
            'results' => $results,
        ];
    }
}

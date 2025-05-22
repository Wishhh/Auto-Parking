<?php

namespace App\Http\Controllers;

use App\Models\ParkingCard;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ParkingCardController extends Controller
{
    public function index()
    {
        $cards = ParkingCard::all()->map(function ($card) {
            $days = Carbon::parse($card->entering_date)->diffInDays(Carbon::now());
            $price = $days * $card->car_size;
            $card->price = $price;
            return $card;
        });

        return view('parking_cards.index', compact('cards'));
    }

    public function create()
    {
        return view('parking_cards.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'entering_date' => 'required|date',
            'car_number' => 'required|string',
            'car_model' => 'required|string',
            'car_size' => 'required|integer|min:1',
        ]);

        ParkingCard::create($request->all());

        return redirect()->route('parking_cards.index')->with('success', 'Parking card created successfully.');
    }

    public function edit(ParkingCard $parking_card)
    {
        return view('parking_cards.edit', compact('parking_card'));
    }

    public function update(Request $request, ParkingCard $parking_card)
    {
        $request->validate([
            'entering_date' => 'required|date',
            'car_number' => 'required|string',
            'car_model' => 'required|string',
            'car_size' => 'required|integer|min:1',
        ]);

        $parking_card->update($request->all());

        return redirect()->route('parking_cards.index')->with('success', 'Parking card updated successfully.');
    }

    public function destroy(ParkingCard $parking_card)
    {
        $parking_card->delete();

        return redirect()->route('parking_cards.index')->with('success', 'Parking card deleted successfully.');
    }

    // New reports method for Reporting and Analytics
    public function reports()
    {
        // Aggregate parking usage per day
        $usagePerDay = ParkingCard::selectRaw('DATE(entering_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // Aggregate total revenue per day
        $revenuePerDay = ParkingCard::all()->groupBy(function($item) {
            return Carbon::parse($item->entering_date)->format('Y-m-d');
        })->map(function($group) {
            $total = 0;
            foreach ($group as $card) {
                $days = Carbon::parse($card->entering_date)->diffInDays(Carbon::now());
                $total += $days * $card->car_size;
            }
            return $total;
        });

        // Calculate peak hours (hour of entering_date with most entries)
        $peakHours = ParkingCard::selectRaw('HOUR(entering_date) as hour, COUNT(*) as count')
            ->groupBy('hour')
            ->orderByDesc('count')
            ->get();

        return view('parking_cards.reports', compact('usagePerDay', 'revenuePerDay', 'peakHours'));
    }
}

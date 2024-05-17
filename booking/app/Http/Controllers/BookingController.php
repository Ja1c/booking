<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        return response()->json(Booking::where('user_id', Auth::id())->get());
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|date|after_or_equal:'.Carbon::now()->addDays(3)->toDateString(),
        ]);

        $booking = Booking::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
        ]);

        return response()->json($booking, 201);
    }

    public function show($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        return response()->json($booking);
    }

    public function update(Request $request, $id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);

        $this->validate($request, [
            'date' => 'required|date|after_or_equal:'.Carbon::now()->addDays(3)->toDateString(),
        ]);

        $booking->update($request->all());

        return response()->json($booking);
    }

    public function destroy($id)
    {
        $booking = Booking::where('user_id', Auth::id())->findOrFail($id);
        $booking->delete();
        return response()->json(null, 204);
    }
}

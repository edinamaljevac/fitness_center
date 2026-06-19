<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainerProfileController extends Controller
{
    public function edit(Request $request)
    {
        $trainer = Auth::user()->trainer;
        $editMode = $request->query('edit') == 1;

        return view('trainer.profile', compact('trainer', 'editMode'));
    }

    public function update(Request $request)
    {
        $trainer = Auth::user()->trainer;

        $validated = $request->validate([
            'oblast_rada' => ['nullable', 'string', 'max:255'],
            'dostupnost' => ['required', 'boolean'],
            'datum_zaposlenja' => ['nullable', 'date'],
            'sertifikat' => ['nullable', 'string', 'max:255'],
        ]);

        $trainer->update($validated);

        return redirect()
            ->route('trainer.profile')
            ->with('success', 'Profil je uspešno ažuriran.');
    }
}

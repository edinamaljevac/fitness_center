<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberProfileController extends Controller
{
    public function edit(Request $request)
    {
        $member = Auth::user()->member;

        $editMode = $request->query('edit') == 1;

        return view('member.profile', compact('member', 'editMode'));
    }

    public function update(Request $request)
    {
        $member = Auth::user()->member;

        $validated = $request->validate([
            'datum_rodjenja' => ['nullable', 'date'],
            'adresa' => ['nullable', 'string', 'max:255'],
            'visina_cm' => ['nullable', 'integer'],
        ]);

        $member->update($validated);

        return redirect()
            ->route('member.profile')
            ->with('success', 'Profil je uspešno ažuriran.');
    }
}

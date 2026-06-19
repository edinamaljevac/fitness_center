<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Models\BodyProgress;
use Illuminate\Http\Request;


class TrainerMemberController extends Controller
{
    public function index()
    {
        $trainer = Auth::user()->trainer;

        $members = Member::whereHas('trainings', function ($query) use ($trainer) {
            $query->where('trainer_id', $trainer->id);
        })->distinct()->get();

        return view('trainer.members.index', compact('members'));
    }

    public function show(Member $member)
    {
        $progresses = $member->bodyProgresses()
            ->orderBy('datum_merenja', 'desc')
            ->get();

        return view('trainer.members.show', compact('member', 'progresses'));
    }

    public function createProgress(Member $member)
    {
        $member->load('user');

        return view('trainer.progress.create', compact('member'));
    }


public function storeProgress(Request $request, Member $member)
    {
        $request->validate([
            'datum_merenja' => 'required|date',
            'tezina_kg' => 'nullable|numeric',
            'procenat_masti' => 'nullable|numeric',
            'obim_grudi' => 'nullable|numeric',
            'obim_struka' => 'nullable|numeric',
            'obim_kukova' => 'nullable|numeric',
            'max_bench_kg' => 'nullable|numeric',
            'max_cucanj_kg' => 'nullable|numeric',
            'napomena' => 'nullable|string',
        ]);

        BodyProgress::create([
            'member_id' => $member->id,
            'datum_merenja' => $request->datum_merenja,
            'tezina_kg' => $request->tezina_kg,
            'procenat_masti' => $request->procenat_masti,
            'obim_grudi' => $request->obim_grudi,
            'obim_struka' => $request->obim_struka,
            'obim_kukova' => $request->obim_kukova,
            'max_bench_kg' => $request->max_bench_kg,
            'max_cucanj_kg' => $request->max_cucanj_kg,
            'napomena' => $request->napomena,
        ]);

        return redirect()
            ->route('trainer.members.show', $member)
            ->with('success', 'Merenje uspešno dodato.');
    }
}

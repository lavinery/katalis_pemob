<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin']);
    }

    public function index()
    {
        try {
            $members = Member::latest()->paginate(10);
            return view('members.index', compact('members'));
        } catch (\Exception $e) {
            Log::error('Error in member index: ' . $e->getMessage());
            return back()->with('error', 'Unable to load members list.');
        }
    }

    public function create()
    {
        try {
            return view('members.create');
        } catch (\Exception $e) {
            Log::error('Error in member create: ' . $e->getMessage());
            return back()->with('error', 'Unable to load create form.');
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nim' => 'required|string|max:20|unique:members',
                'name' => 'required|string|max:255',
                'batch_year' => 'required|integer|min:2000|max:' . (date('Y')),
                'faculty' => 'required|string|max:255',
                'study_program' => 'required|string|max:255',
                'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file gambar
            ]);

            if ($request->hasFile('profile_image')) {
                $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
            }

            Member::create($validated);

            return redirect()->route('members.index')
                ->with('success', 'Member created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating member: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Failed to create member.');
        }
    }

    public function edit(Member $member)
    {
        try {
            return view('members.edit', compact('member'));
        } catch (\Exception $e) {
            Log::error('Error in member edit: ' . $e->getMessage());
            return back()->with('error', 'Unable to load edit form.');
        }
    }

    public function update(Request $request, Member $member)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'nim' => 'required|string|max:20|unique:members,nim,' . $member->id,
                'name' => 'required|string|max:255',
                'batch_year' => 'required|integer|min:2000|max:' . (date('Y')),
                'faculty' => 'required|string|max:255',
                'study_program' => 'required|string|max:255',
                'profile_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Validasi file gambar
            ]);

            // Periksa jika ada file gambar baru yang diunggah
            if ($request->hasFile('profile_image')) {
                // Hapus gambar lama jika ada
                if ($member->profile_image && Storage::disk('public')->exists($member->profile_image)) {
                    Storage::disk('public')->delete($member->profile_image);
                }

                // Simpan gambar baru
                $validated['profile_image'] = $request->file('profile_image')->store('profiles', 'public');
            }

            // Update data member
            $member->update($validated);

            return redirect()->route('members.index')
                ->with('success', 'Member updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating member: ' . $e->getMessage());
            return back()->withInput()
                ->with('error', 'Failed to update member.');
        }
    }


    public function destroy(Member $member)
    {
        try {
            // Hapus gambar jika ada
            if ($member->profile_image) {
                Storage::disk('public')->delete($member->profile_image);
            }

            $member->delete();

            return redirect()->route('members.index')
                ->with('success', 'Member deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting member: ' . $e->getMessage());
            return back()->with('error', 'Failed to delete member.');
        }
    }
}

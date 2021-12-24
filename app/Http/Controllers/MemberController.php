<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
{
    public function show()
    {
        $members = Member::all();

        if ($members) {
            return response()->json([
                'status' => 200,
                'members' => $members,
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Table Empty !!',
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'cin' => 'required|max:14',
            'age' => 'required|max:11',
            'adresse' => 'required|max:100',
            'tele' => 'required|max:16',
            'subscribe' => 'required|max:11',
            'assurance' => 'required|max:11',
            'date_assurance' => 'required',
            'date_payment_assurance' => 'required',
            'etat' => 'required|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {

            $members = Member::create([

                'name' => $request->input('name'),
                'tele' => $request->input('tele'),
                'cin' => $request->input('cin'),
                'age' => $request->input('age'),
                'adresse' => $request->input('adresse'),
                'subscribe' => $request->input('subscribe'),
                'assurance' => $request->input('assurance'),
                'date_assurance' => Carbon::now()->format('y-m-d'),
                'date_payment_assurance' => Carbon::now()->addYear()->format('y-m-d'),
                'etat' => $request->input('etat'),
            ]);

            return response()->json([
                'status' => 200,
                'message' => 'Created With Successfully ^-^',
            ]);
        }
    }

    public function edit($id)
    {
        $member = Member::find($id);

        if ($member) {
            return response()->json([
                'status' => 200,
                'member' => $member,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Not Found 404',
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:100',
            'cin' => 'required|max:14',
            'age' => 'required|max:11',
            'adresse' => 'required|max:100',
            'tele' => 'required|max:16',
            'subscribe' => 'required|max:11',
            'assurance' => 'required|max:11',
            'date_payment_assurance' => 'required',
            'etat' => 'required|max:3',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {

            $members = Member::find($id);

            if ($members) {

                $members->name = $request->input('name');
                $members->tele = $request->input('tele');
                $members->cin = $request->input('cin');
                $members->age = $request->input('age');
                $members->adresse = $request->input('adresse');
                $members->subscribe = $request->input('subscribe');
                $members->assurance = $request->input('assurance');
                $members->date_assurance = $request->input('date_assurance');
                $members->date_payment_assurance = $request->input('date_payment_assurance');
                $members->etat = $request->input('etat');
                $members->save();

                return response()->json([
                    'status' => 200,
                    'message' => 'Updated With Successfully ^-^',
                ]);
            } else {
                return response()->json([
                    'status' => 404,
                    'message' => 'Member Not Found 404 ^+^',
                ]);
            }
        }
    }

    public function delete($id)
    {
        $members = Member::find($id);

        if ($members) {
            $members->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted With Successfully ^-^',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Message Not Found 404 ^+^',
            ]);
        }
    }
}

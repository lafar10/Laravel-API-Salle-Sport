<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Facture;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FactureController extends Controller
{

    public function get_members_id()
    {
        $members_ids = Member::all();

        if ($members_ids) {
            return response()->json([
                'status' => 200,
                'members_ids' => $members_ids,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => '404 Not Found',
            ]);
        }
    }

    public function show()
    {
        $factures = Facture::all();

        if ($factures) {
            return response()->json([
                'status' => 200,
                'factures' => $factures,
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Not Found 404',
            ]);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:191',
            'cin' => 'required|max:191',
            'subscribe' => 'required|integer',
            'member_id' => 'required|integer',
            'date_payment' => 'required',
            'etat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {

            if (Carbon::now()->format('m-d') == '01-29') {
                $date = Carbon::now()->addDays(30);
            } elseif (Carbon::now()->format('m-d') == '01-30') {
                $date = Carbon::now()->addDays(29);
            } elseif (Carbon::now()->format('m-d') == '01-31') {
                $date = Carbon::now()->addDays(28);
            } else {
                $date = Carbon::now()->addMonth();
            }

            $factures = Facture::create([
                'name' => $request->input('name'),
                'cin' => $request->input('cin'),
                'subscribe' => $request->input('subscribe'),
                'member_id' => $request->input('member_id'),
                'date_payment' => $date,
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
        $factures = Facture::find($id);

        if ($factures) {
            return response()->json([
                'status' => 200,
                'factures' => $factures,
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
            'name' => 'required|max:191',
            'cin' => 'required|max:191',
            'subscribe' => 'required|integer',
            'member_id' => 'required|integer',
            'date_payment' => 'required',
            'etat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 500,
                'errors' => $validator->messages(),
            ]);
        } else {

            $factures = Facture::find($id);

            if ($factures) {

                $factures->name = $request->input('name');
                $factures->cin = $request->input('cin');
                $factures->subscribe = $request->input('subscribe');
                $factures->member_id = $request->input('member_id');
                $factures->date_payment = $request->input('date_payment');
                $factures->etat = $request->input('etat');
                $factures->save();

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
        $factures = Facture::find($id);

        if ($factures) {
            $factures->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Deleted With Successfully ^-^',
            ]);
        } else {
            return response()->json([
                'status' => 404,
                'message' => 'Message Not Found 404 ^+^',
            ]);
        }
    }

    public function pdf($id)
    {
        $pdf = Facture::find($id);

        if($pdf)
        {
            return response()->json([
                'pdf_data' => $pdf,
                'status' => 200,
                'message' => 'Pdf Find With Success -*-'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 404,
                'message' => 'Pdf Not Found -+-',
            ]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\UserWalletTransaction;
use Illuminate\Http\Request;
use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Exports\WalletTransactionsExport;
use Maatwebsite\Excel\Facades\Excel;

class UserWalletTransactionController extends Controller
{
    // Get all transactions for the authenticated user
    public function index()
    {
        try {
            $user = Auth::user();
            $transactions = UserWalletTransaction::with(['car_detail', 'user'])
                ->where('user_id', $user->id)
                ->get();

            return ResponseHelper::success($transactions, 'Transactions retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Get a single transaction by ID for the authenticated user
    public function show($id)
    {
        try {
            $user = Auth::user();
            $transaction = UserWalletTransaction::with(['car_detail', 'user'])
                ->where('user_id', $user->id)
                ->where('id', $id)->first();
            if (!$transaction) {
                return ResponseHelper::error('Transaction not found', 404);
            }
            return ResponseHelper::success($transaction, 'Transaction retrieved successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Create a new transaction for the authenticated user
    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'amount' => 'required|numeric',
                'transaction_type' => 'required|string',
            ]);

            $user = Auth::user();

            $path=null;
            if ($request->hasFile('car_image')) {
                $path = $request->file('car_image')->store('public/transaction_images');
                $path = Storage::url($path);
            }

            $transaction = UserWalletTransaction::create([
                'user_id' => $user->id,
                'car_details_id' => $request->input('car_details_id'),
                'car_image' => $path,
                'car_name' => $request->input('car_name'),
                'date' => $request->input('date'),
                'amount' => $request->input('amount'),
                'transaction_type' => $request->input('transaction_type'),
            ]);


            return ResponseHelper::success($transaction, 'Transaction created successfully', 201);
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    // Update a transaction for the authenticated user
    // public function update(Request $request, $id)
    // {
    //     return $request->all();
    //     try {
    //         $request->validate([
    //             'car_details_id' => 'required|exists:car_details,id',
    //             'date' => 'required|date',
    //             'amount' => 'required|numeric',
    //             'transaction_type' => 'required|string',
    //         ]);

    //         $user = Auth::user();
    //         $transaction = UserWalletTransaction::where('user_id', $user->id)
    //             ->findOrFail($id);

    //         $transaction->update([
    //             'car_details_id' => $request->input('car_details_id'),
    //             'car_image' => $request->input('car_image'),
    //             'car_name' => $request->input('car_name'),
    //             'date' => $request->input('date'),
    //             'amount' => $request->input('amount'),
    //             'transaction_type' => $request->input('transaction_type'),
    //         ]);

    //         return ResponseHelper::success($transaction, 'Transaction updated successfully');
    //     } catch (\Exception $e) {
    //         return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
    //     }
    // }

    // Delete a transaction for the authenticated user
    public function destroy($id)
    {
        try {
            $user = Auth::user();
            $transaction = UserWalletTransaction::where('user_id', $user->id)
                ->where('id', $id)->first();

            if (!$transaction) {
                return ResponseHelper::error('Transaction not found', 404);
            }
            $transaction->delete();

            return ResponseHelper::success(null, 'Transaction deleted successfully');
        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }

    public function transactionHistory(Request $request)
    {
        try {
            $request->validate([
                'start_date' => 'required|date',
                'end_date' => 'required|date',
            ]);

            // Get the start and end dates from the request
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');

            // Define the file path and name
            $fileName = 'wallet_transactions_' . time() . '.xlsx';
            $filePath = 'public/exports/' . $fileName;

            // Store the Excel file in the storage/app/exports directory
            Excel::store(new WalletTransactionsExport($startDate, $endDate), $filePath);

            // Generate a public URL to the file
            $fileUrl = Storage::url($filePath);

            // Return a JSON response with the file download link
            return ResponseHelper::success(asset($fileUrl), 'Wallet transactions exported successfully');

        } catch (\Exception $e) {
            return ResponseHelper::error('An error occurred: ' . $e->getMessage(), 500);
        }
    }


}

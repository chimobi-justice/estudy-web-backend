<?php

namespace App\Http\Controllers\Api;

use App\Models\EnrollCourse;
use Illuminate\Http\Request;
use App\Models\CoursePayment;
use App\Http\Controllers\Controller;
use KingFlamez\Rave\Facades\Rave as Flutterwave;

class PaymentController extends Controller
{
    public function initialize() {
        try {
            $reference = Flutterwave::generatereference();

            $data = [
                'payment_options' => 'card,banktransfer',
                'amount' => request()->amount,
                'email' => auth()->user()->email,
                'tx_ref' => $reference,
                'currency' => "NGN",
                'redirect_url' => env('Frontend_Url') . '/payment/checkout/callback',
                'customer' => [
                    'email' => auth()->user()->email,
                    "name" => auth()->user()->fullname,
                ],
    
                "customizations" => [
                    "title" => 'Estudy',
                    "description" => "Course Enrollment"
                ],

                "meta" => [
                    "user_id" => auth()->user()->id,
                    "course_id" => request()->course_id,
                    'course_owner_id' => request()->course_owner_id
                ]
            ];
    
            $payment = Flutterwave::initializePayment($data);
    
            if ($payment['status'] !== 'success') {
                return response([
                    'message' => 'Payment initialization failed'
                ], 400);
            }
    
            return response([
                'url' => $payment['data']['link'] 
            ]);
        } catch (\Exception $e) {
            return response([
                'message' => 'Something went wrong!'
            ], 500);
        }
    }

    public function callback(Request $request) {
        $transactionID = $request->transaction_id;

        $request->validate([
            'transaction_id' => 'required|integer|unique:course_payments,transaction_id',
         ]);

         try {
            if ($transactionID) {
                $data = Flutterwave::verifyTransaction($transactionID);
                
                CoursePayment::create([
                    'transaction_id' => $data['data']['id'],
                    'tx_ref' => $data['data']['tx_ref'],
                    'customer_name' => $data['data']['customer']['name'],
                    'customer_email' => $data['data']['customer']['email'],
                    'day_created' => $data['data']['created_at'],
                    'course_id' => $data['data']['meta']['course_id'],
                    'status' => $data['data']['status'],
                ]);

                EnrollCourse::create([
                    'user_id' => $data['data']['meta']['user_id'],
                    'course_id' => $data['data']['meta']['course_id'],
                    'owner_id' => $data['data']['meta']['user_id']
                ]);    
            }
         } catch(\Exception $e) {
            return response()->json([
                "message" => "Verification failed!"
            ], 400);
        }
    }
}

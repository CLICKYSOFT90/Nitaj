<?php

namespace App\Http\Controllers;

use App\Models\FinancialStatus;
use App\Models\GeneralInfo;
use App\Models\NationalIdVerification;
use App\Models\Notifications;
use App\Models\RegistrationStep;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use function GuzzleHttp\Promise\all;
use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function registerIdVerification()
    {
        $data = NationalIdVerification::whereuser_id(auth()->user()->id)->first();
        return view('investor.id-verification')->with('data', $data);
    }
    public function postRegisterIdVerification(Request $request)
    {
        $message = [
            'nat_id.required' => 'The national id field is required.',
            'dob.required' => 'The date of birth field is required.'
        ];
        $validate_data = [
            'nat_id' => 'required',
            'dob' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data, $message);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            // Make Post Fields Array
            $data1 = [
                'data1' => 'value_1',
                'data2' => 'value_2',
            ];

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => route('fake-data'),
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30000,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => json_encode($data1),
                CURLOPT_HTTPHEADER => array(
                    // Set here requred headers
                    "accept: */*",
                    "accept-language: en-US,en;q=0.8",
                    "content-type: application/json",
                ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            $response = json_decode($response, true);
            curl_close($curl);

            $user_date = User::find(auth()->user()->id);
            $user_date->fname = $response['first_name'];
            $user_date->lname = $response['last_name'];
            $user_date->save();

            $is_nationalidverified = NationalIdVerification::whereuser_id(auth()->user()->id)->wherelang_type('en')->first();
            $user_id_verification = $is_nationalidverified ? NationalIdVerification::whereuser_id(auth()->user()->id)->wherelang_type('en')->first() : new NationalIdVerification();
            $user_id_verification->lang_type = 'en';
            $user_id_verification->user_id = auth()->user()->id;
            $user_id_verification->national_id = $request->nat_id;
            $user_id_verification->dob = date('Y-m-d', strtotime($request->dob));
            $user_id_verification->first_name = $response['first_name'];
            $user_id_verification->second_name = $response['second_name'];
            $user_id_verification->third_name = $response['third_name'];
            $user_id_verification->last_name = $response['last_name'];
            $user_id_verification->id_expire = $response['id_expire'];
            $user_id_verification->gender = $response['gender'];
            $user_id_verification->unit_address = $response['unit_address'];
            $user_id_verification->building_number = $response['building_number'];
            $user_id_verification->street_name = $response['street_name'];
            $user_id_verification->district = $response['district'];
            $user_id_verification->city = $response['city'];
            $user_id_verification->postal_code = $response['postal_code'];
            $user_id_verification->additional_code = $response['additional_code'];
            $user_id_verification->location = $response['location'];
            $user_id_verification->save();

            $is_nationalidverified_ar = NationalIdVerification::whereuser_id(auth()->user()->id)->wherelang_type('ar')->first();
            $user_id_verification_ar = $is_nationalidverified_ar ? NationalIdVerification::whereuser_id(auth()->user()->id)->wherelang_type('ar')->first() : new NationalIdVerification();
            $user_id_verification_ar->lang_type = 'ar';
            $user_id_verification_ar->user_id = auth()->user()->id;
            $user_id_verification_ar->national_id = $request->nat_id;
            $user_id_verification_ar->dob = date('Y-m-d', strtotime($request->dob));
            $user_id_verification_ar->first_name = $response['first_name'];
            $user_id_verification_ar->second_name = $response['second_name'];
            $user_id_verification_ar->third_name = $response['third_name'];
            $user_id_verification_ar->last_name = $response['last_name'];
            $user_id_verification_ar->id_expire = $response['id_expire'];
            $user_id_verification_ar->gender = $response['gender'];
            $user_id_verification_ar->unit_address = $response['unit_address'];
            $user_id_verification_ar->building_number = $response['building_number'];
            $user_id_verification_ar->street_name = $response['street_name'];
            $user_id_verification_ar->district = $response['district'];
            $user_id_verification_ar->city = $response['city'];
            $user_id_verification_ar->postal_code = $response['postal_code'];
            $user_id_verification_ar->additional_code = $response['additional_code'];
            $user_id_verification_ar->location = $response['location'];
            $user_id_verification_ar->save();

            return redirect()->route('stepAddressVerification');
        }
    }
    public function idVerificationStatus(Request $request)
    {
        $add_reg_step = new RegistrationStep();
        $add_reg_step->user_id = auth()->user()->id;
        $add_reg_step->step = 'id-verification';
        $add_reg_step->status = 1;
        $add_reg_step->save();
        return response()->json([
            "success" => true,
            "message" => "Status Updated",
        ], 200);
    }


    public function registerNationalAddress()
    {
        $data = NationalIdVerification::whereuser_id(auth()->user()->id)->first();
        return view('investor.national-address-verification')->with('data', $data);
    }

    public function registerGeneralInfo()
    {
        return view('investor.general-info');
    }

    public function postRegisterGeneralInfo(Request $request)
    {
        $message = [
            'social_status.required' => 'Please select the field first',
            'curr_occupation.required' => 'Please select the field first',
            'edu_lvl.required' => 'Please select the field first',
            'worked_in_financial_sector.required' => 'Please select the field first',
            'practical_experience.required' => 'Please select the field first',
            'real_estate_investing_exp.required' => 'Please select the field first',
            'board_director_audit_commitee.required' => 'Please select the field first',
            'relationship.required' => 'Please select the field first',
            'beneficial_owner_business.required' => 'Please select the field first',
        ];
        $validate_data = [
            'social_status' => 'required',
            'curr_occupation' => 'required',
            'edu_lvl' => 'required',
            'worked_in_financial_sector' => 'required',
            'practical_experience' => 'required',
            'real_estate_investing_exp' => 'required',
            'board_director_audit_commitee' => 'required',
            'relationship' => 'required',
            'beneficial_owner_business' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data, $message);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{

            $is_genInfo = GeneralInfo::whereuser_id(auth()->user()->id)->first();
            $gen_info = $is_genInfo ? GeneralInfo::whereuser_id(auth()->user()->id)->first() : new GeneralInfo();
            $gen_info->user_id = auth()->user()->id;
            $gen_info->social_status = $request->social_status;
            $gen_info->current_occupation = $request->curr_occupation;
            $gen_info->education_level = $request->edu_lvl;
            $gen_info->worked_in_financial_sector = $request->worked_in_financial_sector;
            $gen_info->practical_experience = $request->practical_experience;
            $gen_info->real_estate_investing_exp = $request->real_estate_investing_exp;
            $gen_info->board_director_audit_commitee = $request->board_director_audit_commitee;
            $gen_info->relationship = $request->relationship;
            $gen_info->beneficial_owner_business = $request->beneficial_owner_business;
            $gen_info->save();

            return redirect()->route('financial-status');

        }
    }

    public function registerFinancialStatus()
    {
        return view('investor.financial-status');
    }


    public function postRegisterFinancialStatus(Request $request)
    {
        $message = [
            'net_worth.required' => 'This field is required.',
            'invest_obj.required' => 'This field is required.',
            'curr_invested.required' => 'This field is required.',
            'annual_income.required' => 'This field is required.',
            'expected_invest_oppornity.required' => 'This field is required.',
            'expected_amount_annually.required' => 'This field is required.',
        ];
        $validate_data = [
            'net_worth' => 'required',
            'invest_obj' => 'required',
            'curr_invested' => 'required',
            'annual_income' => 'required',
            'expected_invest_oppornity' => 'required',
            'expected_amount_annually' => 'required',
        ];

        $validator = Validator::make($request->all(),$validate_data, $message);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }else{
            $imploded_field = implode(',', $request->curr_invested);
            $is_financial = FinancialStatus::whereuser_id(auth()->user()->id)->first();
            $gen_info = $is_financial ? FinancialStatus::whereuser_id(auth()->user()->id)->first() : new FinancialStatus();
            $gen_info->user_id = auth()->user()->id;
            $gen_info->net_worth = $request->net_worth;
            $gen_info->invest_obj = $request->invest_obj;
            $gen_info->curr_invested = $imploded_field;
            $gen_info->annual_income = $request->annual_income;
            $gen_info->expected_invest_oppornity = $request->expected_invest_oppornity;
            $gen_info->expected_amount_annually = $request->expected_amount_annually;
            $gen_info->save();

            $is_genInfo = GeneralInfo::whereuser_id(auth()->user()->id)->first();
            $add_reg_step = new RegistrationStep();
            $add_reg_step->user_id = auth()->user()->id;
            $add_reg_step->step = 'general-info';
            $add_reg_step->status = 1;
            $add_reg_step->save();

            $add_reg_step = new RegistrationStep();
            $add_reg_step->user_id = auth()->user()->id;
            $add_reg_step->step = 'financial-status';
            $add_reg_step->status = 1;
            $add_reg_step->save();

            return redirect()->route('investor.home');

        }
    }

    public function aboutUs(){
        $about_us = AboutUs::first();
        return view('about-us',compact('about_us'));
    }
    public function termsAndConditions(){
        $terms_conditions = TermsAndConditions::first();
        return view('terms-conditions',compact('terms_conditions'));
    }
    public function privacyPolicy(){
        $privacy_policy = PrivacyPolicy::first();
        return view('privacy-policy',compact('privacy_policy'));
    }
    public function faq(){
        $faq = Faq::first();
        return view('faq',compact('faq'));
    }

    public function usersNotification(){
        $option = '';
        $user_notitfication = Notifications::whereTo(auth()->user()->id)->orWhere('to',0)->orderBy('created_at', 'DESC')->get();
        if(!$user_notitfication->isEmpty()){
            foreach ($user_notitfication as $notification) {
//            $option .= '<li>' . $notification->subject . '</li>';
                $option .= '<a href="javascript:;" class="navi-item">
                            <div class="navi-link">
                                <div class="navi-text">
                                    <div class="font-weight-bold">'.$notification->subject.'</div>
                                    <div class="text-muted">'.$notification->created_at->diffForHumans().'</div>
                                </div>
                            </div>
                        </a>';
            }
            return response()->json([
                'status' => true,
                'data' => $option,
            ]);
        } else{
            return response()->json([
                'status' => false,
            ]);
        }
    }
}

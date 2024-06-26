<?php

namespace App\Http\Controllers;

use App\Models\NationalIdVerification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Countries;
use App\Models\Cities;
use App\Models\Settings;
use App\Models\Faq;
use App\Models\PrivacyPolicy;
use App\Models\TermsAndConditions;
use App\Models\AboutUs;
use Illuminate\Support\Facades\Validator;

class SettingsController extends Controller
{
    public function index(){

        // if admin
        if(auth()->user()->is_admin){
            $countries = Countries::where('name','Saudi Arabia')->get();
            $settings = Settings::first();
            $faqs = Faq::first();
            $privacy_policy = PrivacyPolicy::first();
            $terms_and_conditions = TermsAndConditions::first();
            $about_us = AboutUs::first();
            return view('admin.settings.settings',compact('countries','settings','faqs','privacy_policy','terms_and_conditions','about_us'));
        }

        // if investor
        $investor = User::with('nationalIdVeriification')->where('id',auth()->user()->id)->firstOrFail();
        return view('investor.settings.settings',compact('investor'));
    }

    public function updateProfileSettings(Request $request){

        // if admin
        if(auth()->user()->is_admin){

        }

        // if investor
        $id_expire = NationalIdVerification::getDate($request->id_expire);
        $dob = NationalIdVerification::getDate($request->dob);

        User::where('id',auth()->user()->id)->update(['fname'=>$request->fname,'lname'=>$request->lname]);
        NationalIdVerification::where('user_id',auth()->user()->id)->update(['national_id'=>$request->national_id,'dob'=>$dob,'id_expire'=>$id_expire]);

        return redirect()->route('investor.settings');
    }

    public function updateBankAccount(Request $request){
        User::where('id',auth()->user()->id)->update([
            'iban' => $request->iban,
            'bank_name' => $request->name
        ]);
        return redirect()->route('investor.settings')->with('success','Bank Account updated successfully.');
    }

    public function updateMobileNumber(Request $request){

        // investor
        User::where('id',auth()->user()->id)->update(['mobile'=>$request->mobile]);
        return redirect()->route('investor.settings')->with('success','Mobile updated successfully.');
    }

    public function getCountries(Request $request){

        $countries = Countries::where('name','Saudi Arabia')->get();
        return response()->json([
            'status'=>true,
            'countries'=>$countries
        ]);
    }

    public function getCities(Request $request){

        $cities = Cities::get();
        return response()->json([
            'status'=>true,
            'cities'=>$cities
        ]);
    }

    public function updateCountries(Request $request){

        try{

            if($request->selected_countries == ''){
                Countries::where('status',1)->update(['status' => 0]);

            }else{
                Countries::whereIn('id', $request->selected_countries)->update(['status'=>1]);
                Countries::whereNotIn('id', $request->selected_countries)->update(['status'=>0]);
            }

            return response()->json([
                'status'=>true,
                'message'=>'Countries updated successfully.'
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }

    }

    public function updateLimit(Request $request){

        $validate_data = [
            'limit' => 'required|numeric'
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $settings = Settings::first();
            $settings->regular_limit = $request->limit;
            $settings->save();
            return redirect()->back()->with('success','Limit updated successfully.');

        }catch(\Exception $e){

            return redirect()->back()->with('alert',$e->getMessage());
        }
    }

    public function updateVat(Request $request){

        $validate_data = [
            'vat' => 'required|numeric|min:1|',
            'withdrawal_fee' => 'required|numeric|min:1|',
            'fee' => 'required|numeric|min:1|',
            'service_fee'=>'required|numeric|min:1|'
        ];

        $validator = Validator::make($request->all(),$validate_data);
        if($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
        try{
            $settings = Settings::first();

            if(empty($settings)){
                Settings::create($request->except(['_token']));
            }else{
                $settings->update($request->except(['_token']));
            }
            return redirect()->back()->with('success','Vat updated successfully.');

        }catch(\Exception $e){

            return redirect()->back()->with('alert',$e->getMessage());
        }
    }

    public function faq(Request $request){

        try{
            $faq = Faq::first();

            if(empty($faq)){
                Faq::create($request->all());
            }else{
                $faq->update($request->all());
            }

            return response()->json([
                'status'=>true,
                'message'=>'Faqs updated successfully.'
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }
    }

    public function termsAndConditions(Request $request){

        try{
            $terms_and_conditions = TermsAndConditions::first();

            if(empty($terms_and_conditions)){
                TermsAndConditions::create($request->all());
            }else{
                $terms_and_conditions->update($request->all());
            }

            return response()->json([
                'status'=>true,
                'message'=>'Terms And Conditions updated successfully.'
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }
    }

    public function privacyPolicy(Request $request){

        try{
            $privacy_policy = PrivacyPolicy::first();

            if(empty($privacy_policy)){
                PrivacyPolicy::create($request->all());
            }else{
                $privacy_policy->update($request->all());
            }

            return response()->json([
                'status'=>true,
                'message'=>'Privacy policy updated successfully.'
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }
    }

    public function aboutUs(Request $request){

        try{
            $about_us = AboutUs::first();

            if(empty($about_us)){
                AboutUs::create($request->all());
            }else{
                $about_us->update($request->all());
            }

            return response()->json([
                'status'=>true,
                'message'=>'About us updated successfully.'
            ]);

        }catch(\Exception $e){

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ]);
        }
    }


}

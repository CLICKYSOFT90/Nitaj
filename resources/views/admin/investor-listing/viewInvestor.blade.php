@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | View Investor</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec vote-sec-text">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <ul class="tags-listing">
                        <li class="tags-list-item"><a href="{{ route('admin.investor.listing') }}"
                                                      class="tags-list-text"><i
                                    class="fa fa-angle-left tag-icon" aria-hidden="true"></i> Back</a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text">Investor
                                Management</a>
                        </li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text"><i
                                    class="fa fa-angle-double-right tag-icon" aria-hidden="true"></i></a></li>
                        <li class="tags-list-item"><a href="javascriptvoid:(0)" class="tags-list-text">View</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="campaign-field-text management-profile-sec for-bdr">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <h4 class="profile-address user-prof">Investor Profile</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Account Type</label>
                                        <input type="text" readonly value="{{ ucwords($role[0]) }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12 account-after">
                                    <div class="input-options">
                                        <label>Date Registered</label>
                                        <input type="text" readonly value="{{ date('d-M-Y', strtotime($user->created_at)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>First Name</label>
                                        <input type="text" readonly
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->first_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Last Name</label>
                                        <input type="text" readonly
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->last_name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Email</label>
                                        <input type="text" readonly value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12 account-col-border">
                                    <div class="input-options">
                                        <label>Mobile no.</label>
                                        <input type="text" readonly value="{{ $user->mobile }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Gender</label>
                                        <input type="text" readonly
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->gender : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12 account-col-border">
                                    <div class="input-options">
                                        <label>Nationality</label>
                                        <input type="text" readonly
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->national_id : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12 ">
                            <h4 class="profile-address user-prof text-right">ملف تعريفي للمستخدم</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right w-85">نوع الحساب</label>
                                        <input type="text" readonly class="dir-rtl" value="{{ ucwords($role[0]) }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right w-85">تاريخ مسجل</label>
                                        <input type="text" readonly class="text-right"
                                               value="{{ date('d-M-Y', strtotime($user->created_at)) }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right w-85">الكنية</label>
                                        <input type="text" readonly class="dir-rtl"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->last_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right w-85">الاسم الأول</label>
                                        <input type="text" readonly class="dir-rtl"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->first_name : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12 account-col-border">
                                    <div class="input-options">
                                        <label class="text-right w-85">رقم الموبايل.</label>
                                        <input type="text" readonly class="dir-rtl" value="{{ $user->mobile }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right w-85">بريد الالكتروني</label>
                                        <input type="text" readonly class="dir-rtl" value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12 account-col-border">
                                    <div class="input-options">
                                        <label class="text-right w-85">جنسية</label>
                                        <input type="text" readonly class="dir-rtl"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->national_id : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right w-85">جنس</label>
                                        <input type="text" readonly class="dir-rtl"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->gender : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign-field-text management-investment-sec for-bdr">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-12">
                            <h4 class="profile-address user-prof">Address</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Unit Address</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->unit_address : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Building No</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->building_number : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Street Name</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->street_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>District</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->district : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>City</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->city : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Postal Code</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->postal_code : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Additional Code</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->additional_code : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>Location</label>
                                        <input type="text"
                                               value="{{ !empty($user->nationalIdVeriification[0]) ? $user->nationalIdVeriification[0]->location : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-12">
                            <h4 class="profile-address user-prof text-right">عنوان</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">عنوان الوحدة</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->unit_address : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">لا للبناء</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->building_number : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">اسم الشارع</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->street_name : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">يصرف</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->district : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">مدينة</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->city : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">رمز بريدي</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->postal_code : '' }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">كود إضافي</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->additional_code : '' }}">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label class="text-right">موقع</label>
                                        <input type="text" class="dir-rtl w-85"
                                               value="{{ !empty($user->nationalIdVeriification[1]) ? $user->nationalIdVeriification[1]->location : '' }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign-field-text management-investment-sec for-bdr">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="row">

                        <div class="col-md-6 col-sm-6 col-12">
                            <h4 class="user-prof">Bank Details</h4>
                            <div class="row">
                                <div class="col-md-6 col-sm-12 col-12 ">
                                    <div class="input-options">
                                        <label>Bank Name</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12 col-12">
                                    <div class="input-options">
                                        <label>IBAN</label>
                                        <input type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-12">
                                    <div class="input-options">
                                        <label>SWIFT Code</label>
                                        <input type="text">
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6 col-12">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign-field-text details-account-sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <h4 class="details-text">Account Details</h4>
                    <div class="row dividend-sec">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="account-field-boxes">
                                <p>SAR</p>
                                <span>S.R {{ getUserInvestments($user->id) }}</span>
                                <p>Total Investments Value </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="account-field-boxes">
                                <p>SAR</p>
                                <span>S.R {{ getUserEquityWallet($user->id) }}</span>
                                <p>Equity Wallet </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="account-field-boxes">
                                <p>SAR</p>
                                <span>S.R {{ getUserDebitWallet($user->id) }}</span>
                                <p>Debt Wallet </p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="account-field-boxes">
                                <p>SAR</p>
                                <span>{{ getUserTransactions($user->id) }}</span>
                                <p>Total Transactions</p>
                            </div>
                        </div>
                    </div>
                    <div class="row dividend-sec">
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="account-field-boxes">
                                <p>SAR</p>
                                <span>S.R 0</span>
                                <p>Dividends Received</p>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-12">
                            <div class="account-field-boxes">
                                <p>SAR</p>
                                <span>S.R 0</span>
                                <p>Sales Proceeds</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="campaign-field-text Investment-portfolio-sec class-hide">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <h4 class="details-text">Investment Portfolio</h4>
                    <div class="row investment-row-sec">

                        <div class="col-md-12 col-sm-12 col-12">
                            <div class="row">
                                @if($user->usersInvestments->count() > 0)
                                    @foreach($user->usersInvestments as $project_details)
                                        <div class="col-md-4 col-sm-6 col-12">
                                            <div class="scrapper_pc">
                                                <img
                                                    src="{{ asset('project-visual-uploads'.'/'.$project_details->projects->projectImages[0]->filename) }}"
                                                    alt="" class="img-fluid">
                                            </div>
                                            <div class="pr_ent">
                                                <div class="row bdf_fgr for-margin df_aic">
                                                    <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="cgr_hd">
                                                            <h6>{{ ucfirst($project_details->projects->project_name_en) }}</h6>
                                                            <p>{{ ucfirst($project_details->projects->projectCompany->name_en) }}</p>
                                                            <span>{{ $project_details->projects->projectCities->name }}</span>
                                                        </div>
                                                    </div>
                                                    @php
                                                        $user_wallet = convertCommaToInteger(getUserWallet($user->id));
                                                        $total_amount = $project_details->amount_invested + $user_wallet;
                                                        $abc = $total_amount - $user_wallet;
                                                        $abc = ($abc / $total_amount) * 100;
                                                        $percentage = round($abc, 2).' %';
                                                    @endphp
                                                    <div class="col-md-6 col-sm-6 col-6">
                                                        <div class="ten_percent_dsgn">
                                                            <span>{{ $percentage }}</span>
                                                            <p>Of total Portfolio</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row gx_pl_pr for-mng-border">
                                                    <div class="col-md-4 col-sm-4 col-12">
                                                        <div class="bdr_ph1 gK_after">
                                                            <h5>Asset Type</h5>
                                                            <p>{{ $project_details->projects->asset_type_en }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-12">
                                                        <div class="bdr_ph1 gK_after">
                                                            <h5>Projected Returns</h5>
                                                            <p>0%</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 col-sm-4 col-12">
                                                        <div class="bdr_ph1">
                                                            <h5>Invest. Type</h5>
                                                            <p>{{ $project_details->projects->projectFunding->structure }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <a href="javascriptvoid:(0)" class="performance-link">
                                                    View Performance
                                                    <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-md-4 col-sm-6 col-12">
                                        <h4>No Record Found</h4>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{--        <div class="report-shadow-box">--}}
        {{--            <div class="funding-campaign-table">--}}
        {{--                <div class="d-flex flex-column-fluid">--}}
        {{--                    <div class="container">--}}
        {{--                        <h4 class="details-text">Reports</h4>--}}
        {{--                        <div class="row">--}}
        {{--                            <div class="col-md-12 col-sm-12 col-12">--}}
        {{--                                <div class="table-responsive">--}}
        {{--                                    <table class="table">--}}
        {{--                                        <thead>--}}
        {{--                                        <tr>--}}
        {{--                                            <th class="for-left-td">Project Name</th>--}}
        {{--                                            <th>Report Name</th>--}}
        {{--                                            <th>Report Type</th>--}}
        {{--                                            <th>Published on</th>--}}
        {{--                                            <th>Updates published</th>--}}
        {{--                                            <th>Last Updated</th>--}}
        {{--                                            <th class="for-right-td"></th>--}}
        {{--                                        </tr>--}}
        {{--                                        </thead>--}}
        {{--                                        <tbody>--}}
        {{--                                        </tbody>--}}
        {{--                                    </table>--}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        <div class="report-shadow-box">
            <div class="funding-campaign-table">
                <div class="d-flex flex-column-fluid">
                    <div class="container">
                        <h4 class="details-text">Vote Campaigns</h4>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12">
                                <div class="table-responsive">
                                    <table class="table data-table">
                                        <thead>
                                        <tr>
                                            <th class="for-left-td">Project Name</th>
                                            <th>Issued On</th>
                                            <th>Expiry Date</th>
                                            <th>Voted Sell/Extend</th>
                                            <th>Voted Agreed/Disagree</th>
                                            <th>Voted Accept/Reject</th>
                                            <th>Status</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(function () {
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.investor.vote-campaign.list') }}",
                oLanguage: {sLengthMenu: " _MENU_ entries"},
                columns: [
                    {data: 'project_name'},
                    {data: 'issued_on'},
                    {data: 'expiry_date'},
                    {data: 'sell_extend'},
                    {data: 'agree_disagree'},
                    {data: 'accept_reject'},
                    {data: 'status'},
                    {data: 'action', orderable: false, searchable: false},
                ],
            });
        });
    </script>
@endsection

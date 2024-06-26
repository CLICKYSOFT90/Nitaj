@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Portfolio</title>
@endsection

@section('content')
    <!--begin::Content-->

    <div class="content d-flex flex-column flex-column-fluid for_fmly" id="kt_content">
        <div class="for-dsb-5">
            <div class="container">
                <div class="folio-view">
                    <div class="row ff_s">
                        <!-- <div class="col-md-1 col-sm-1"></div> -->


                        <div class="col-md-4 col-sm-4 col-12">

                            <div class="for_fil_sort">
                                <select name="" id="">
                                    <option value="1">{{ __('portfolio.Filters') }}</option>
                                    <option value="2">{{ __('portfolio.sorts') }}</option>
                                    <option value="3">{{ __('portfolio.Owned') }}</option>
                                </select>
                                <select name="" id="">
                                    <option value="1">{{ __('portfolio.Sort by') }}</option>
                                    <option value="2">{{ __('portfolio.Assets') }}</option>
                                    <option value="3">{{ __('portfolio.Owned') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="for_tabs_1">
                                <!-- <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="tab" href="#tabs-1"
                                            role="tab">Active Project</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">View
                                            all
                                        </a>
                                    </li>

                                </ul> -->
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-4 col-12">
                            <div class="form-89 hg_rbt">

                                <input type="search" placeholder="{{ __('portfolio.Type in to Search') }}...">

                                <div class="search-icon">
                                    <i class="fa fa-search"></i>
                                </div>
                            </div>



                        </div>


                        <!-- <div class="col-md-1 col-sm-1"></div> -->
                    </div>

                </div>
            </div>
        </div>

        <div class="table_sck">
            <div class="d-flex flex-column-fluid">
                <div class="container">


                </div>
            </div>
        </div>
        <div class="card_projects">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <div class="sx_cards">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="tb_sec">
                                    <div class="pro_cons">
                                        <h4>{{ __('portfolio.My Portfolio') }}</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-12">
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col" class="for-left-radius">
                                                            {{ __('portfolio.Project Name') }}</th>
                                                        <th scope="col">{{ __('portfolio.Project Type') }}</th>
                                                        <th scope="col">{{ __('portfolio.Project Market Value') }} </th>
                                                        <th scope="col">{{ __('portfolio.Equity share') }}</th>
                                                        <th scope="col">{{ __('portfolio.% of Portfolio') }}</th>
                                                        <th scope="col">{{ __('portfolio.Position total') }} </th>
                                                        <th class="for-right-radius"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <td>X</td>
                                                        <td>Development</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>10%</td>
                                                        <td>$19,291</td>
                                                        <td class="custom_td"><span
                                                                class="view_table_bn"><a href="">
                                                                                    View</a></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Y</td>
                                                        <td>Acquisition</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>$17,638</td>
                                                        <td class="custom_td"><span
                                                                class="view_table_bn"><a href="">
                                                                                    View</a></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>z</td>
                                                        <td>......</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>$16,218</td>
                                                        <td class="custom_td"><span
                                                                class="view_table_bn"><a href="">
                                                                                    View</a></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td>xl</td>
                                                        <td>......</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>$14,421</td>
                                                        <td class="custom_td"><span
                                                                class="view_table_bn"><a href="">
                                                                                    View</a></span></td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row" class="rmv_bdr"></th>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <!-- <td></td> -->
                                                        <td>
                                                        </td>
                                                    </tr>
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
            </div>
        </div>
        <!--end::Content-->
        <!--begin::Footer-->

        <!--end::Footer-->
    </div>
    <!--end::Wrapper-->
@endsection

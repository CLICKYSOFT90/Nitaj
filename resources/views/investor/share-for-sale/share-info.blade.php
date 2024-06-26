@extends('layouts.investor.investor')
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Share Information</title>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="shres-market-sec">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-12">
                        <ul class="tags-listing">
                            <li class="tags-list-item"><a href="{{ route('investor.sell.shares') }}"
                                                          class="tags-list-text"><i class="fa fa-angle-left tag-icon"
                                                                                    aria-hidden="true"></i> {{ __('shares.Back') }}
                                </a>
                            </li>
                            <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                          class="tags-list-text for-color">{{ __('shares.Shares Market') }}</a>
                            </li>
                            <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                          class="tags-list-text"><i
                                        class="fa fa-angle-double-right tag-icon"
                                        aria-hidden="true"></i></a></li>
                            <li class="tags-list-item"><a href="javascriptvoid:(0)"
                                                          class="tags-list-text">{{ __('shares.Share Information') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="shares-information">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xl-8 col-lg-12 col-sm-12 col-12">
                        <div class="select-proj">
                            <div class="dropdown">
                                <label for="">{{ __('shares.Select Project') }}</label>
                                <button class="btn btn-secondary dropdown-toggle" type="button"
                                        id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                    {{ __('shares.Select Project') }}
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @if(count($data['projects']) > 0)
                                        @foreach($data['projects']  as $project)
                                            <a class="dropdown-item"
                                               href="{{ route('investor.sell.ownShares') }}?id={{$project->projects->id}}">{{ App::getLocale() == 'en' ? $project->projects->project_name_en : $project->projects->project_name_ar }}</a>
                                        @endforeach
                                    @else
                                        <a class="dropdown-item"
                                           href="javascript:;">No Project Found</a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        @if(isset($_GET['id']))
                            <div>
                                <div class="share-info-details">
                                    <div class="share-info-detail-main">
                                        <div class="share-info-detail-box">
                                            <div class="shared-info-detail-thumb">
                                                <img
                                                    src="{{ asset('project-visual-uploads'.'/'.$data['investment']->projects->projectImages[0]->filename) }}"
                                                    alt="" style="width: 222px;">
                                            </div>
                                            <div class="shared-info-detail-content">
                                                <h3>{{ App::getLocale() == 'en' ? $data['investment']->projects->project_name_en : $data['investment']->projects->project_name_ar }}</h3>
                                                <p>{{ App::getLocale() == 'en' ? $data['investment']->projects->projectCompany->name_en : $data['investment']->projects->projectCompany->name_ar }}</p>
                                            </div>
                                        </div>
                                        <div class="info-numbers-share-box">
                                            <h6>{{ __('shares.Number of Shares Available') }}</h6>
                                            <h3>{{ $data['investment']->total_shares }}</h3>
                                        </div>
                                    </div>
                                </div>
                                <form action="{{ route('investor.sell.sellshare') }}" method="post"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="project_id" value="{{ $_GET['id'] }}">
                                    <div class="share-info-project-reports">
                                        <h4>{{ __('shares.Project Reports') }}</h4>
                                        <div class="proj-upload-button">
                                            <div class="proj-upload-button">
                                                <div class="upload__box">
                                                    <div class="upload__btn-box">
                                                        <label class="upload__btn pr-upload-btn">
                                                            <img src="{{ asset('images/upload-btn.png') }}" alt=""
                                                                 class="img-fluid">
                                                            {{ __('shares.Upload Project Report') }}
                                                            <input type="file" data-max_length="20"
                                                                   class="upload__inputfile"
                                                                   accept="application/pdf,application/vnd.ms-excel"
                                                                   name="project_report">
                                                        </label>
                                                    </div>
                                                    <div class="upload__img-wrap"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shre-details">
                                        <h4>{{ __('shares.Share Details') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="shre-details-listing">
                                                    <ul>
                                                        <li>{{ __('shares.Number of share') }}</li>
                                                        <li>{{ __('shares.Price Per Share') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="shre-details-listing align-end">
                                                    <ul>
                                                        <li>
                                                            <div class="bidding-field">
                                                                <input type="text" name="no_of_shares"
                                                                       value="{{ old('no_of_shares') }}"
                                                                       id="no_of_shares"
                                                                       class="@error('no_of_shares') is-invalid @enderror"
                                                                       onkeyup="totalShares(this, {{ $data['investment']->total_shares }})">
                                                                @error('no_of_shares')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="bidding-field">
                                                                <input type="text" name="price_per_share"
                                                                       value="{{ old('price_per_share') }}"
                                                                       id="price_per_share"
                                                                       onkeyup="calculateFees(this)"
                                                                       class="@error('price_per_share') is-invalid @enderror">
                                                                @error('price_per_share')
                                                                <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                                @enderror
                                                            </div>
                                                            <span id="c-error"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="shre-details">
                                        <h4 class="total-sum">{{ __('shares.Summary') }}</h4>
                                        <div class="row">
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="shre-details-listing">
                                                    <ul>
                                                        <li>{{ __('shares.Nitaj Exit Fees') }}</li>
                                                        <li>{{ __('shares.Service Fees') }}</li>
                                                        <li class="mb-4">{{ __('shares.VAT') }} %</li>
                                                        <li class="total-sum">{{ __('shares.Total') }}</li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-6 col-6">
                                                <div class="shre-details-listing align-end">
                                                    <ul>
                                                        <li id="nitaj_fee">0</li>
                                                        <li id="service_fee">0</li>
                                                        <li class="mb-4" id="vat">0</li>
                                                        <li class="total-sum" id="total">0</li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="shre-submit">
                                        <button type="submit" class="vot-btn">{{ __('shares.SUBMIT') }}</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        function calculateFees(val) {
            if (isNaN(val.value)) {
                $('#c-error').html('<div class="alert alert-danger">' + '{{ __('shares.Characters not allowed') }}' + '</div>');
                setTimeout(function () {
                    $('#c-error').empty();
                }, 1000)
            } else {
                // VAT
                const vat = {{ $settings->vat }} / 100 * val.value;
                const fee = {{ $settings->service_fee }} / 100 * val.value;
                const nitaj_fee = {{ $settings->nitaj_exit_fee }} / 100 * val.value;
                const total = (+val.value) + (+vat) + (+fee) + (+nitaj_fee);
                $('#nitaj_fee').html(nitaj_fee + ' SAR')
                $('#vat').html(vat + ' SAR')
                $('#service_fee').html(fee + ' SAR')
                $('#total').html(total + ' SAR')
            }
        }

        function totalShares(val, total_shares) {
            if (isNaN(val.value)) {
                $('#c-error').html('<div class="alert alert-danger">' + '{{ __('shares.Characters not allowed') }}' + '</div>');
                setTimeout(function () {
                    $('#c-error').empty();
                }, 1000)
            } else {
                if (val.value > total_shares) {
                    $('#c-error').html('<div class="alert alert-danger">' + '{{ __('shares.You cannot enter more than total no of shares') }}' + '</div>');
                    setTimeout(function () {
                        $('#c-error').empty();
                    }, 1000);
                }
            }
        }

        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            var imgWrap = "";
            var imgArray = [];
            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    var maxLength = $(this).attr('data-max_length');
                    var files = e.target.files;
                    var filesArr = Array.prototype.slice.call(files);
                    var iterator = 0;
                    filesArr.forEach(function (f, index) {
                        // if (!f.type.match('image.*')) {
                        //     return;
                        // }
                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            var len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    // var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    var html = "<div class='upload__img-box'><a href='" + e.target.result + "'>" + files[0].name + "</a> <div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });
            $('body').on('click', ".upload__img-close", function (e) {
                var file = $(this).parent().data("file");
                for (var i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });
        }

    </script>
@endsection

@extends('layouts.investor.investor')

@section('styles')
    <link rel="stylesheet" href="{{ asset('investor/assets/css/main.css') }}">
    <link href="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/css/bootstrap-multiselect.css"
          rel="stylesheet" type="text/css" />
@endsection
@section('title')
    <title>{{ config('app.name', 'Laravel') }} | Fund Request</title>
@endsection

@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="help_sec funding-campaign-sec">
            <div class="d-flex flex-column-fluid">
                <div class="container">
                    <h4 class="campaign-text">Settings</h4>
                    <div class="row boxes-row">
                        <div class="col-md-12 col-sm-12 col-12 p-0">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>Countries</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="country-arrow">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>Cities</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="cities-arrow">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascript:;">
                                            <h2>VAT/Withdrawal Fee/Fee</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="vat-arrow">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row boxes-row">
                        <div class="col-md-12 col-sm-12 col-12 p-0">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>FAQ</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="faq-arrow">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>T&C</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="tac-arrow">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>Privacy Policy</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="privacy-policy-arrow">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row boxes-row">
                        <div class="col-md-12 col-sm-12 col-12 p-0">
                            <div class="row">
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>About Us</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="about-us-arrow">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6 col-12">
                                    <div class="menu-boxes">
                                        <a href="javascriptvoid:(0)">
                                            <h2>Investment Limit</h2>
                                            <img src="{{ asset('images/right-arrow.png') }}" id="investment-limit-arrow">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row boxes-row">
            <div class="col-md-12 col-sm-12 p-0 ">
              <div class="row">
                <div class="col-md-4 col-sm-6 col-12">
                  <div class="menu-boxes">
                    <a href="javascriptvoid:(0)">
                      <h2>Download Reports </h2>
                      <img src="{{asset('images/right-arrow.png')}}">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div> --}}
                </div>
            </div>
        </div>
    </div>

    {{-- bootstap modal for countries --}}
    <div class="modal fade countries-modal" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Countries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="selected-countries">
                        {{-- <pre> @php print_r($countries); @endphp</pre> --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-countries">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- bootstap modal for cities --}}
    <div class="modal fade cities-modal" id="exampleModalLong" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Countries</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="selected-countries">
                        {{-- <pre> @php print_r($countries); @endphp</pre> --}}

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update-cities">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- bootstrap modal for VAT --}}
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Vat Withdrwal Fee</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.update-vat') }}" method="post" id="vat-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="vat" class="col-form-label">VAT:</label>
                            <input type="text"
                                class="form-control @error('vat') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                id="vat" name="vat" value="{{ isset($settings->vat) ? $settings->vat : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="withdrawal_fee" class="col-form-label">Withdrawal Fee:</label>
                            <input type="text"
                                class="form-control @error('withdrawal_fee') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                id="withdrawal_fee" name="withdrawal_fee"
                                value="{{ isset($settings->withdrawal_fee) ? $settings->withdrawal_fee : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="fee" class="col-form-label">Fee:</label>
                            <input type="text"
                                class="form-control @error('fee') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                id="fee" name="fee" value="{{ isset($settings->fee) ? $settings->fee : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="nitaj-exit-fee" class="col-form-label">Nitaj Exit Fees:</label>
                            <input type="text"
                                class="form-control @error('nitaj_exit_fee') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                id="nitaj-exit-fee" name="nitaj_exit_fee"
                                value="{{ isset($settings->nitaj_exit_fee) ? $settings->nitaj_exit_fee : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="service-fee" class="col-form-label">Service Fees:</label>
                            <input type="text"
                                class="form-control @error('service_fee') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                id="service-fee" name="service_fee"
                                value="{{ isset($settings->service_fee) ? $settings->service_fee : '' }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- bootstrap modal for Investment Limit --}}
    <div class="modal fade" id="limitModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Investment Limit for Regular Investor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('admin.update-limit') }}" method="post" id="limit-form">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="vat" class="col-form-label">Limit (SAR):</label>
                            <input type="text"
                                class="form-control @error('limit') is-invalid @enderror {{ session()->has('error') ? 'is-invalid' : '' }}"
                                id="limit" name="limit" value="{{ isset($settings->regular_limit) ? $settings->regular_limit : '' }}">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button class="btn btn-primary" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- editor modal --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <form action="" method="post" id="editor-form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title editor-heading" id="exampleModalLongTitle">Editor</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea class="ckeditor form-control" name="html" id="text-area"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
@section('scripts')
{{--    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.3/js/bootstrap.min.js">--}}
{{--    </script>--}}
    <script src="http://cdn.rawgit.com/davidstutz/bootstrap-multiselect/master/dist/js/bootstrap-multiselect.js"
        type="text/javascript"></script>

    {{-- ck-editor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>

    <script>
        var selected_countries = [];
        var text = '';
        $(document).ready(function() {

            // initialize ck-editor
            ClassicEditor.create(document.querySelector('.ckeditor'), {
                removePlugins: ['CKFinderUploadAdapter', 'CKFinder', 'EasyImage', 'Image', 'ImageCaption',
                    'ImageStyle', 'ImageToolbar', 'ImageUpload', 'MediaEmbed'
                ],
            });

            // show countries modal
            $('#country-arrow').click(function(e) {
                e.preventDefault();

                $.ajax({
                    method: "get",
                    url: "{{ route('admin.get-countries') }}",
                    success: function(result) {
                        var countries = result.countries;
                        let options = '';
                        $.each(countries, function(index, val) {
                            console.log(val.status)
                            var selected = val.status == 1 ? "selected" : "";
                            options += '<option value="' + val.id + '" ' + selected +
                                '>' + val.name + '</option>';
                        });

                        $('.selected-countries').append(
                            '<select name="countries" class="select"  multiple="multiple">' +
                            options +
                            '</select>'
                        );

                        // initialize multiselect
                        $('.select').multiselect({
                            includeSelectAllOption: true
                        });
                        $('.countries-modal').modal('show');
                    }
                });
                // $('.countries-modal').modal('show');
            });

            // show cities modal
            $('#cities-arrow').click(function(e) {
                e.preventDefault();
                console.log("sdf")

                $.ajax({
                    method: "get",
                    url: "{{ route('admin.get-cities') }}",
                    success: function(result) {
                        var cities = result.cities;
                        let options = '';
                        $.each(cities, function(index, val) {
                            console.log(val.status)
                            var selected = val.status == 1 ? "selected" : "";
                            options += '<option value="' + val.id + '" ' + selected +
                                '>' + val.name + '</option>';
                        });

                        $('.selected-countries').append(
                            '<select name="cities" class="select"  multiple="multiple">' +
                            options +
                            '</select>'
                        );

                        // initialize multiselect
                        $('.select').multiselect({
                            includeSelectAllOption: true
                        });
                        $('.countries-modal').modal('show');
                    }
                });
            });

            // update countries
            $('#update-countries').click(function() {
                selected_countries = [];
                $('input:checkbox').each(function() {
                    if ($(this).is(':checked') && $(this).val() != 'multiselect-all') {
                        selected_countries.push($(this).val())
                    }
                });
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ route('admin.update-countries') }}",
                    method: 'post',
                    data: {
                        selected_countries: selected_countries,
                    },
                    success: function(result) {
                        if (result.status) {
                            selected_countries = [];
                            $('input:checkbox').each(function() {
                                $(this).prop('checked', false);
                            });
                            $('.countries-modal').modal('hide');
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: 'Status Changed!',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'Warning',
                                text: 'Status Not Changed!',
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                        }
                    }
                });
            });

            // show vat modal
            $('#vat-arrow').click(function(e) {
                e.preventDefault();
                $('#exampleModal').modal('show');
            });
            // show vat modal
            $('#investment-limit-arrow').click(function(e) {
                e.preventDefault();
                $('#limitModal').modal('show');
            });

            $.validator.addMethod('minStrict', function(value, el, param) {
                return value > param;
            });

            $('#vat-form').validate({
                rules: {
                    vat: {
                        required: true,
                        number: true,
                        minStrict: 1,
                    },
                    withdrawal_fee: {
                        required: true,
                        number: true,
                        minStrict: 1,
                    },
                    fee: {
                        required: true,
                        number: true,
                        minStrict: 1,
                    },
                    nitaj_exit_fee: {
                        required: true,
                        number: true,
                        minStrict: 1,
                    },
                    service_fee: {
                        required: true,
                        number: true,
                        minStrict: 1,
                    },
                },
                messages: {
                    vat: {
                        required: '{{ __('auth.required') }}',
                        number: 'vat can only contain numbers',
                        minStrict: "vat should be greater than one."
                    },
                    withdrawal_fee: {
                        required: '{{ __('auth.required') }}',
                        number: 'withdrawal_fee can only contain numbers',
                        minStrict: "withdrawal_fee should be greater than one."
                    },
                    fee: {
                        required: '{{ __('auth.required') }}',
                        number: 'withdrawal_fee can only contain numbers',
                        minStrict: "fee should be greater than one."
                    },
                    nitaj_exit_fee: {
                        required: '{{ __('auth.required') }}',
                        number: 'withdrawal_fee can only contain numbers',
                        minStrict: "fee should be greater than one."
                    },
                    service_fee: {
                        required: '{{ __('auth.required') }}',
                        number: 'withdrawal_fee can only contain numbers',
                        minStrict: "fee should be greater than one."
                    },
                }
            });

            $('#limit-form').validate({
                rules: {
                    limit: {
                        required: true,
                        number: true,
                    },
                },
                messages: {
                    limit: {
                        required: '{{ __('auth.required') }}',
                        number: 'Limit can only contain numbers',
                    },
                }
            });

            // show investor limit modal
            $('#faq-arrow').click(function(e) {
                e.preventDefault();
                $('.editor-heading').text('FAQ');
                text = '<?php echo isset($faqs) ? $faqs->html : ''; ?>'

                // ClassicEditor.instances[ckeditor].insertText(text);
                const domEditableElement = document.querySelector('.ck-editor__editable');
                const editorInstance = domEditableElement.ckeditorInstance;
                editorInstance.setData('');
                editorInstance.setData(text);
                $('#exampleModalCenter').modal('show');
            });

            // show faq modal
            $('#faq-arrow').click(function(e) {
                e.preventDefault();
                $('.editor-heading').text('FAQ');
                text = '<?php echo isset($faqs) ? $faqs->html : ''; ?>'

                // ClassicEditor.instances[ckeditor].insertText(text);
                const domEditableElement = document.querySelector('.ck-editor__editable');
                const editorInstance = domEditableElement.ckeditorInstance;
                editorInstance.setData('');
                editorInstance.setData(text);
                $('#exampleModalCenter').modal('show');
            });

            // show T&C modal
            $('#tac-arrow').click(function(e) {
                e.preventDefault();
                $('.editor-heading').text('Terms & Conditions');
                text = "<?php echo isset($terms_and_conditions) ? $terms_and_conditions->html : ''; ?>"

                // ClassicEditor.instances[ckeditor].insertText(text);
                const domEditableElement = document.querySelector('.ck-editor__editable');
                const editorInstance = domEditableElement.ckeditorInstance;
                editorInstance.setData('');
                editorInstance.setData(text);
                $('#exampleModalCenter').modal('show');
            });

            // show Privacy Policy modal
            $('#privacy-policy-arrow').click(function(e) {
                e.preventDefault();
                $('.editor-heading').text('Privacy Policy');
                text = "<?php echo isset($privacy_policy) ? $privacy_policy->html : ''; ?>"

                // ClassicEditor.instances[ckeditor].insertText(text);
                const domEditableElement = document.querySelector('.ck-editor__editable');
                const editorInstance = domEditableElement.ckeditorInstance;
                editorInstance.setData('');
                editorInstance.setData(text);
                $('#exampleModalCenter').modal('show');
            });

            // show About Us modal
            $('#about-us-arrow').click(function(e) {
                e.preventDefault();
                $('.editor-heading').text('About Us');
                text = "<?php echo isset($about_us) ? $about_us->html : ''; ?>"

                // ClassicEditor.instances[ckeditor].insertText(text);
                const domEditableElement = document.querySelector('.ck-editor__editable');
                const editorInstance = domEditableElement.ckeditorInstance;
                editorInstance.setData('');
                editorInstance.setData(text);
                $('#exampleModalCenter').modal('show');
            });

            var url = '';
            $('#editor-form').on('submit', function(e) {
                e.preventDefault();
                var formValues = $(this).serialize();
                if ($('.editor-heading').text() == 'FAQ') {
                    url = "{{ route('admin.faq') }}";
                } else if ($('.editor-heading').text() == 'Terms & Conditions') {
                    url = "{{ route('admin.terms-conditions') }}";
                } else if ($('.editor-heading').text() == 'Privacy Policy') {
                    url = "{{ route('admin.privacy-policy') }}";
                } else {
                    url = "{{ route('admin.about-us') }}";
                }

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    }
                });

                $.ajax({
                    method: "post",
                    url: url,
                    data: formValues,
                    success: function(result) {
                        if (result.status == true) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Success',
                                text: result.message,
                                timer: 2000,
                                showCancelButton: false,
                                showConfirmButton: false
                            });
                            location.reload();
                        } else {
                            Swal.fire('Oops Something went wrong!', '', 'warning')
                        }
                    }
                });

            });
        });
    </script>
@endsection

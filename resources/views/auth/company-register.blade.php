@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="register-wrap">
    <div class="container">
        <div class="stepwizard">
            <div class="stepwizard-row setup-panel">
                <div class="stepwizard-step col-xs-3"> 
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Company</small></p>
                </div>
                <div class="stepwizard-step col-xs-3"> 
                    <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                    <p><small>Admin</small></p>
                </div>
                <div class="stepwizard-step col-xs-3"> 
                    <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                    <p><small>Manager</small></p>
                </div>
            </div>
        </div>
                    
        <form role="form" action="{{ route('company.store') }}" method="POST">
            @csrf
            <div class="panel panel-primary setup-content" id="step-1">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Company Name <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="company_name" type="text" class="input-r @error('company_name') is-invalid @enderror" name="company_name" value="{{ old('company_name') }}" required>
                            <span class="focus-input100 @error('company_name') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Company Address <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="address" type="text" class="input-r @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required>
                            <span class="focus-input100 @error('address') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                        </div>
                    </div>
                </div>
            </div>
                        
            <div class="panel panel-primary setup-content" id="step-2">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Name <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="admin_name" type="text" class="input-r @error('admin_name') is-invalid @enderror" name="admin_name" value="{{ old('admin_name') }}" required>
                            <span class="focus-input100 @error('admin_name') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="admin_email" type="email" class="input-r @error('admin_email') is-invalid @enderror" name="admin_email" value="{{ old('admin_email') }}" required>
                            <span class="focus-input100 @error('admin_email') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="admin_pass" type="password" class="input-r @error('admin_pass') is-invalid @enderror" name="admin_pass" value="{{ old('admin_pass') }}" required>
                            <span class="focus-input100 @error('admin_pass') no-focus @enderror"></span>
                        </div>
                     </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button class="btn btn-primary nextBtn pull-right" type="button">Next</button>
                        </div>
                    </div>
                </div>
            </div>
                        
            <div class="panel panel-primary setup-content" id="step-3">
                <div class="panel-heading"></div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label">Name <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="mng_name" type="text" class="input-r @error('mng_name') is-invalid @enderror" name="mng_name" value="{{ old('mng_name') }}" required>
                            <span class="focus-input100 @error('mng_name') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Email <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="mng_email" type="email" class="input-r @error('mng_email') is-invalid @enderror" name="mng_email" value="{{ old('mng_email') }}" required>
                            <span class="focus-input100 @error('mng_email') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password <span class="text-danger">*</span></label>
                        <div class="wrap-input100 m-b-20">
                            <input id="mng_pass" type="password" class="input-r @error('mng_pass') is-invalid @enderror" name="mng_pass" value="{{ old('mng_pass') }}" required>
                            <span class="focus-input100 @error('mng_pass') no-focus @enderror"></span>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-6">
                            <button class="btn btn-primary nextBtn pull-right" type="submit">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row text-center mt-5">
        <div class="col-md-12">
            <a href="{{ url('/') }}">I have an account</a>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

        allWells.hide();

        navListItems.click(function (e) {
            e.preventDefault();
            var $target = $($(this).attr('href')),
                $item = $(this);

            if (!$item.hasClass('disabled')) {
                navListItems.removeClass('btn-success').addClass('btn-default');
                $item.addClass('btn-success');
                allWells.hide();
                $target.show();
                $target.find('input:eq(0)').focus();
            }
        });

        allNextBtn.click(function () {
            var curStep = $(this).closest(".setup-content"),
                curStepBtn = curStep.attr("id"),
                nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
                curInputs = curStep.find("input[type='text'],input[type='password'],input[type='email']"),
                isValid = true;

            for (var i = 0; i < curInputs.length; i++) {
                $(curInputs[i]).removeClass("is-invalid");
                if (!curInputs[i].validity.valid) {
                    isValid = false;
                    $(curInputs[i]).addClass("is-invalid");
                }
            }

            if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
        });

        $('div.setup-panel div a.btn-success').trigger('click');
    });
</script>
@endsection

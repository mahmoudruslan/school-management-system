{{-- begin mother data --}}
@if ($currentStep != 2)
    <div style="display: none" id="step-2">
    @else
        <div id="step-2">
@endif

<div class="form-row">
    <div class="form-group col-md">
        <label for="title">{{ __('Email') }}</label><br>
        @error('email')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="email" class="form-control">
    </div>
    <div class="form-group col-md">
        <label for="title">{{ __("Password") }}</label><br>
        @error('password')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="password" wire:model="password" class="form-control">
    </div>
    <div class="form-group col-md">
        <label for="title">{{ __("Father's Phone") }}</label><br>
        @error('father_phone')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="number" wire:model="father_phone" class="form-control">
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <label for="title">{{ __("Father's Name_ar") }}</label><br>
        @error('father_name_ar')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="father_name_ar" class="form-control">
    </div>
    <div class="form-group col-md-6">
        <label for="title">{{ __("Father's Name_en") }}</label><br>
        @error('father_name_en')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="father_name_en" class="form-control">
    </div>
</div>

<div class="form-row">
    <div class="col-md-4">
        <label for="title">{{ __("Father's Job_ar") }}</label><br>
        @error('father_job_ar')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="father_job_ar" class="form-control">
    </div>
    <div class="form-group col-md-4">
        <label for="title">{{ __("Father's Job_en") }}</label><br>
        @error('father_job_en')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="father_job_en" class="form-control">
    </div>
    <div class="form-group col-md-4">
        <label for="title">{{ __("Father's National Id") }}</label><br>
        @error('father_national_id')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="father_national_id" class="form-control">
    </div>
</div>

<div class="form-row">
    <div class="col-md-6">
        <label for="title">{{ __("Mother's Name_en") }}</label><br>
        @error('mother_name_ar')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input class="form-control" type="text" wire:model="mother_name_ar">
    </div>
    <div class="form-group col-md-6">
        <label for="title">{{ __("Mother's Name_en") }}</label><br>
        @error('mother_name_en')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="mother_name_en" class="form-control">
    </div>
</div>
<br>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="title">{{ __("Mother's National Id") }}</label><br>
        @error('mother_national_id')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <input type="text" wire:model="mother_national_id" class="form-control">
    </div>


    <div class="form-group col-md-6">
        <label for="inputPassword4">{{ __("Father's Nationality") }}</label><br>
        @error('father_nationality_id')
            <span class="error text-danger">{{ $message }}</span>
        @enderror
        <select wire:model="father_nationality_id" class="custom-select">
            <option value="" selected disabled>{{ __('Choose Nationality') }}</option>
            @foreach ($nationalitys as $nationality)
                <option value="{{ $nationality->id }}">{{ $nationality['name_' . app()->getLocale()] }}</option>
            @endforeach
        </select>
    </div>
</div>


<button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="step3"
    type="button">{{ __('Next') }}</button>
<button class="btn btn-sm nextBtn btn-lg mt-3 btn-danger" type="button"
    wire:click="back(1)">{{ __('Back') }}</button>
</div>

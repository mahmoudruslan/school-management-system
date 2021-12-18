
        {{-- begin mother data --}}
        @if ($currentStep != 2)
            <div  style="display: none" id="step-2">
        @else
            <div id="step-2">
        @endif
        {{-- start part 1 --}}
        <div class="form-row">
            <div class="col">{{--يمين--}}

                <label for="title">{{__("Mother's Name_ar")}}</label><br>
                @error('name_mother_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_mother_ar" class="form-control" id="taskTitle">
            </div>

            <div class="col">{{--شمال--}}


                <label for="title">{{__("Mother's Name_en")}}</label><br>
                @error('name_mother_en') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_mother_en" class="form-control" id="taskTitle">

            </div>
            </div><br>
            {{-- end part 1 --}}
            {{-- start part 2 --}}
            <div class="form-row">
                <div class="col">{{--يمين--}}
                    <div class="form-row">
                        <div class="col">
                            <label for="title">{{__("Mother's Job_ar")}}</label><br>
                            @error('job_mother_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="job_mother_ar" class="form-control" id="taskTitle">
                        </div>
                        <div class="col">
                            <label for="title">{{__("Mother's Job_en")}}</label><br>
                            @error('job_mother_en') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="job_mother_en" class="form-control" id="taskTitle">
                        </div>
                    </div><br>
                </div>
                <div class="col">{{--شمال--}}
                    <div class="form-row">
                        <div class="col">
                            <label for="title">{{__("Mother's Passport Number")}}</label><br>
                            @error('passport_id_mother') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="passport_id_mother" class="form-control" id="taskTitle">

                        </div>
                        <div class="col">
                            <label for="title">{{__("Mother's National Id")}}</label><br>
                            @error('national_id_mother') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="national_id_mother" class="form-control" id="taskTitle">

                        </div>
                        <div class="col">
                            <label for="title">{{__("Mother's Phone")}}</label><br>
                            @error('phone_mother') <span class="error text-danger">{{ $message }}</span> @enderror
                            <input type="text" wire:model="phone_mother" class="form-control" id="taskTitle">

                        </div>
                    </div><br>
                </div>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="title">{{__("Mother's Religion")}}</label><br>
                    @error('religion_mother_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    <select wire:model="religion_mother_id" class="custom-select">
                        <option selected>{{__('Choose Religion')}}...</option>
                        @foreach ($religions as $religion)
                            <option value="{{$religion->id}}">{{$religion['name_'.app()->getLocale()]}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="title">{{__("Mother's Nationality")}}</label><br>
                    @error('nationality_mother_id') <span class="error text-danger">{{ $message }}</span> @enderror
                    <select wire:model="nationality_mother_id" class="custom-select">
                        <option selected>{{__('Choose Nationality')}}...</option>
                        @foreach ($nationalitys as $nationality)
                            <option value="{{$nationality->id}}">{{$nationality['name_'.app()->getLocale()]}}</option>
                        @endforeach
                    </select>
                </div>
            </div><br>

                    <div class="form-row">
                    <div class="col">
                        <label for="title">{{__("Mother's Blood Type")}}</label><br>
                        @error('blood_Type_mother_id') <span class="error text-danger">{{ $message }}</span> @enderror
                        <select wire:model="blood_Type_mother_id" class="custom-select">
                            <option selected>{{__('Choose Blood type')}}...</option>
                            @foreach ($bloodtypes as $bloodtype)
                                <option value="{{$bloodtype->id}}">{{$bloodtype->name}}</option>
                            @endforeach
                        </select>

                    </div>
                                        <div class="col">
                                            <label for="title">{{__("Parent's Attachments")}}</label><br>
                                            @error('photos') <span class="error text-danger">{{ $message }}</span> @enderror
                                            <div class="form-group">
                                                <input type="file" wire:model="photos" accept="image/*" multiple>
                                            </div>
                                        </div>
                    </div><br>
            <label for="title">{{__("Mother's Address")}}</label><br>
            @error('address_mother') <span class="error text-danger">{{ $message }}</span> @enderror
            <textarea id="taskTitle" wire:model="address_mother" class='form-control'>
            </textarea>
            @if ($addMode)
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="secondStepSubmit" type="button">{{__('Next')}}</button>
            @else
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="secondStepSubmitEdit" type="button">{{__('Next')}}</button>
            @endif
            <button class="btn btn-sm nextBtn btn-lg mt-3 btn-danger" type="button" wire:click="back(1)">{{__('Back')}}</button>

        </div>

        {{-- begin mother data --}}



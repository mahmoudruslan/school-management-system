
        {{-- begin father data --}}
        @if ($currentStep != 1)
            <div  style="display: none" id="step-1">
        @else
            <div id="step-1">
        @endif
        @if(!empty($errorMsg))
        <div class="alert alert-danger">
            <button type="button" class="close" wire:click="clearMessages">x</button>
            {{ $errorMsg }}
        </div>
    @endif
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title">{{__("Name_ar")}}</label><br>
                @error('name_ar') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_ar" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="title">{{__("Name_en")}}</label><br>
                @error('name_en') <span class="error text-danger">{{ $message }}</span> @enderror
                <input type="text" wire:model="name_en" class="form-control">
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <label for="inputPassword4">{{__('Grade')}}</label><br>
                @error('grade_id')<span class="error text-danger">{{ $message }}</span>@enderror
                <select wire:model="grade_id" class="custom-select" wire:change="change">
                    <option value="" disabled>{{__('Choose Grade')}}</option>
                    @foreach($grades as $grade)
                        <option value="{{$grade->id}}">{{$grade['name_'.app()->getLocale()]}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="title">{{__("Classroom")}}</label><br>
                @error('classroom_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select wire:model="classroom_id" class="custom-select" wire:change="change">
                    @if(isset($classrooms))
                    <option value="" disabled>{{__('Choose Classroom')}}</option>
                    @foreach ($classrooms as $classroom)
                    
                    <option value="{{$classroom->id}}">{{$classroom['name_'.app()->getLocale()]}}</option>
                    @endforeach
                    @endif

                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="title">{{__("Section")}}</label><br>
                @error('section_id') <span class="error text-danger">{{ $message }}</span> @enderror
                <select wire:model="section_id" class="custom-select">

                    @if(isset($sections))
                    <option value="" disabled>{{__('Choose Section')}}</option>
                    @foreach ($sections as $section)
                    <option value="{{$section->id}}">{{$section['name_'.app()->getLocale()]}}</option>
                    @endforeach
                    @endif

                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-4">
                <label for="inputPassword4">{{__('Student Nationality')}}</label><br>
                @error('student_nationality_id')<span class="error text-danger">{{ $message }}</span>@enderror
                <select wire:model="student_nationality_id" class="custom-select">
                    <option value="" selected disabled>{{__('Choose Nationality')}}</option>
                    @foreach($nationalitys as $nationality)
                        <option value="{{$nationality->id}}">{{$nationality['name_'.app()->getLocale()]}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputPassword4">{{__('Student\'s blood type')}}</label><br>
                @error('student_blood_type_id')<span class="error text-danger">{{ $message }}</span>@enderror
                <select wire:model="student_blood_type_id" class="custom-select">
                    <option value="" selected disabled>{{__('Choose Blood type')}}</option>
                    @foreach($bloodtypes as $Blood_type)
                        <option value="{{$Blood_type->id}}">{{$Blood_type->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">{{__('Religion')}}</label><br>
                @error('religion')<span class="error text-danger">{{ $message }}</span>@enderror
                <select wire:model="religion" class="custom-select">
                    <option value="" selected disabled>{{__('Choose Religion')}}</option>
                        <option value="1">{{__('Muslim')}}</option>
                        <option value="0">{{__('Christian')}}</option>
                </select>
            </div>
        </div>

        <div class="form-row">
            <div class="col-md-6">
                <label for="title">{{__('Date of birth')}}</label><br>
                @error('date_of_birth')<span class="error text-danger">{{ $message }}</span>@enderror
                <input class="form-control" type="text" wire:model="date_of_birth">
            </div>

            <div class="col-md-6">
                <label for="title">{{__("Student Address")}}</label><br>
                @error('student_address') <span class="error text-danger">{{ $message }}</span> @enderror
                <textarea wire:model="student_address" class='form-control'></textarea>
            </div>
        </div>


        <div class="form-row col-md-8">
            <div class="col-md-4">
                <label for="title">{{__("Parent's Attachments")}}</label><br>
                @error('photos') <span class="error text-danger">{{ $message }}</span> @enderror
                <div class="form-group">
                    <input type="file" wire:model="photos" accept="image/*" multiple>
                </div>
            </div>
            <div class="col-md-4">
                    <label for="inputState">{{__('Gender')}}</label><br>
                    @error('gender')<span class="error text-danger">{{ $message }}<br></span>@enderror
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio1" value="1">
                        <label class="form-check-label" for="inlineRadio1">{{__('Male')}}</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" wire:model="gender" id="inlineRadio2" value="0">
                        <label class="form-check-label" for="inlineRadio2">{{__('Female')}}</label>
                    </div>
            </div>
            <div class="col-md-4"><br>
                <input type="checkbox" value="1" id="flexCheckChecked" class="form-check-input" wire:model="entry_status">
                <label class="form-check-label" for="flexCheckChecked">{{__('Noob')}}</label>
            </div>
        </div>


        
        {{-- start part 1 --}}

            @if ($addMode)
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="firstStepSubmit" type="button">{{__('Next')}}</button>

            @else
                <button style="background: #72ab2a;color:white" class="btn btn-sm nextBtn btn-lg mt-3" wire:click="firstStepSubmitEdit" type="button">{{__('Next')}}</button>
            @endif
            <button class="btn btn-danger btn-sm nextBtn btn-lg mt-3" wire:click="toParentList" type="button">{{__('Back')}}</button>
        </div>




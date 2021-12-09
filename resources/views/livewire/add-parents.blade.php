

        <div  class="stepwizard mb-4">
            <div class="stepwizard-row setup-panel">
                <div class="multi-wizard-step">
                    <a href="#step-1" type="button" @if($currentStep != 1)class="btn"@else class="btn" style="background: #72ab2a;color:white"@endif>1</a>
                    <p class="h6">{{__('Father\'s data')}}</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-2" type="button"
                    @if($currentStep != 2)class="btn"@else class="btn" style="background: #72ab2a;color:white"@endif>2</a>
                    <p class="h6">{{__('Mother\'s data')}}</p>
                </div>
                <div class="multi-wizard-step">
                    <a href="#step-3" type="button"
                    @if($currentStep != 3)class="btn"@else class="btn" style="background: #72ab2a;color:white"@endif
                        disabled="disabled">3</a>
                        <p class="h6">{{__('confirm')}}</p>
                </div>
            </div>

        </div>

        @include('livewire.formLayout.father_form')
        @include('livewire.formLayout.mother_form')
        @include('livewire.formLayout.end_form')





    </div>
</div>




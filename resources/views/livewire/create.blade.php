<div class="stepwizard mb-4">
    <div class="stepwizard-row setup-panel">
        <div class="multi-wizard-step">
            <a href="#step-1" type="button"
                @if ($currentStep != 1) class="btn"@else class="btn" style="background: #72ab2a;color:white" @endif>1</a>
        </div>
        <div class="multi-wizard-step">
            <a href="#step-2" type="button"
                @if ($currentStep != 2) class="btn"@else class="btn" style="background: #72ab2a;color:white" @endif>2</a>
        </div>
        <div class="multi-wizard-step">
            <a href="#step-3" type="button"
                @if ($currentStep != 3) class="btn"@else class="btn" style="background: #72ab2a;color:white" @endif
                disabled="disabled">3</a>
        </div>
    </div>
</div><br>
@include('livewire.form_layout.step_1')
@include('livewire.form_layout.step_2')
@include('livewire.form_layout.step_3')
</div>
</div>
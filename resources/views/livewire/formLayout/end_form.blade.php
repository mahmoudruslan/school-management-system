@if ($currentStep != 3)
<div style="display: none" class="row setup-content" id="step-3">
@else
<div class="row setup-content" id="step-3">
@endif
<div class="text-center col-md-12">
  <div class="modal-content">

    <div class="modal-body">
        <h3>{{__('parents.Are you sure you want to save the data?')}}</h3>
        </div>
        <div class="modal-footer">
          @if ($addMode)
            <button style="background: #72ab2a;color:white" class="btn btn-lg" wire:click="submitForm" type="button">{{__('parents.finish')}}</button>
          @else
            <button style="background: #72ab2a;color:white" class="btn btn-lg" wire:click="submitFormEdit({{$parent_id}})" type="button">{{__('parents.finish')}}</button>
          @endif
          <button class="btn btn-danger nextBtn btn-lg" type="button" wire:click="back(2)">{{__('parents.back')}}</button>
        </div>
  </div>
</div>
</div>
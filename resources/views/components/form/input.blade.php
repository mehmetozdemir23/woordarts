@props(['type' => 'text', 'label'=>'', 'name', 'value','placeholder'=>'', 'disabled' => false])
<div class="default-form-box mb-20">
    @if ($label)
    <label>{{ $label }}</label>
    @endif
    <div class="position-relative">
        <input type="{{ $type }}" name="{{ $name }}" placeholder="{{$placeholder}}" value="{{ old($name) ?? ($value ?? '') }}"
            {{ $disabled ? 'disabled' : '' }}>
        @if ($disabled)
            <img src="/assets/images/icons/lock.svg" alt="lock-icon"
                style="width:20px;transform:translateY(-50%);right:8px" class="position-absolute top-50">
        @endif
    </div>
    @error($name)
        <div class="d-flex align-items-center p-2">
            <img src="/assets/images/icons/danger.svg" alt="" style="width:20px;margin-right:6px;">
            <span style="font-size:small;" class="text-danger">{{ $message }}</span>
        </div>
    @enderror
</div>

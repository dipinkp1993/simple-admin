@props(['options' => [], 'label' => '', 'placeholder' => '', 'selected' => null])

<label for="{{ $attributes->get('id') }}">{{ $label }}</label>
<select {{ $attributes->merge(['class' => 'form-control']) }}>
    @if ($placeholder)
        <option value="" disabled selected>{{ $placeholder }}</option>
    @endif
    @foreach ($options as $key => $option)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $option }}</option>
    @endforeach
</select>

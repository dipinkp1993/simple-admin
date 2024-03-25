@props(['options' => [], 'label' => '', 'placeholder' => '', 'selected' => null])

<label for="{{ $attributes->get('id') }}">{{ $label }}</label>
<select {{ $attributes->merge(['class' => 'form-control']) }}>
    <option value="" disabled selected>{{ $placeholder }}</option>
    @foreach ($options as $key => $option)
        <option value="{{ $key }}" {{ $selected == $key ? 'selected' : '' }}>{{ $option }}</option>
    @endforeach
</select>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#{{ $attributes->get('id') }}').select2();
            $('#{{ $attributes->get('id') }}').on('change', function (e) {
                @this.set('{{ $attributes->wire('model')->value() }}', $(this).val());
            });
        });
    </script>
@endpush

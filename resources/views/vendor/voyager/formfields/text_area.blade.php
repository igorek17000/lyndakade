<textarea @if ($row->required == 1) required @endif class="form-control"
  @if ($row->field == 'description' || $row->field == 'concepts' ) dir="rtl" @endif
  name="{{ $row->field }}" rows="{{ $options->display->rows ?? 14 }}">{{ old($row->field, $dataTypeContent->{$row->field} ?? '') }}</textarea>
  {{-- {{ old($row->field, $dataTypeContent->{$row->field} ?? ($options->default ?? '')) }} --}}

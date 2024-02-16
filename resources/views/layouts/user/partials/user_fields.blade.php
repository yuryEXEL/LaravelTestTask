@foreach ($fields as $field)
    <input type="text" name="{{$field['name']}}" placeholder="{{$field['placeholder']}}"><br>
@endforeach

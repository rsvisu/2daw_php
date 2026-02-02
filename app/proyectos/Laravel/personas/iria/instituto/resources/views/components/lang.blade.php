<select name="lang">
    <option selected disabled>{{__("Selecciona idioma")}}</option>

    @foreach(config("languages") as $code => $content)
        <option>{{$content['name']}} {{$content['flag']}}</option>
    @endforeach
</select>

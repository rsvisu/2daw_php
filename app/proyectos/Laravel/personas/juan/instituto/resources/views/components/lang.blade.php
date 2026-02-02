<select>
    @foreach (config("languages") as $lang => $data)
        <option value="">{{$data["name"]}}</option>
    @endforeach
</select>

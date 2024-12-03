<h1>create answer</h1><br>
<form action="{{route('subjects.store')}}" method="post">
    @csrf
    <input type="text" name="name" placeholder="subject name" value="{{ old('name') }}"> <br>
    @error('name')
        {{$message}}
    @enderror <br>
    <input type="text" name="college_id" placeholder="college" value="{{ old('college_id') }}"> <br>
    @error('college')
        {{$message}}
    @enderror <br>
    <input type="number" name="year" placeholder="year" value="{{ old('year') }}"> <br>
    @error('year')
        {{$message}}
    @enderror <br>
    <input type="text" name="specialize" placeholder="specialize" value="{{ old('specialize') }}"> <br>
    @error('specialize')
        {{$message}}
    @enderror <br>
    <input type="text" name="semester" placeholder="semester" value="{{ old('semester') }}"> <br>
    @error('semester')
        {{$message}}
    @enderror <br>
    <button type="submit">Submit</button>
</form>
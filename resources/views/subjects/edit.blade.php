<h1>create answer</h1><br>
<form action='{{URL("subjects/$subject->id")}}' method="post">
    @csrf
    @method('put')
    <input type="text" name="name" placeholder="subject name" value="{{ old('name', $subject->name) }}"> <br>
    @error('name')
        {{$message}}
    @enderror <br>
    <input type="text" name="college_id" placeholder="college" value="{{ $subject->college_id }}"> <br>
    @error('college')
        {{$message}}
    @enderror <br>
    <input type="number" name="year" placeholder="year" value="{{ $subject->year }}"> <br>
    @error('year')
        {{$message}}
    @enderror <br>
    <input type="text" name="specialize" placeholder="specialize" value="{{ $subject->specialize }}"> <br>
    @error('specialize')
        {{$message}}
    @enderror <br>
    <input type="text" name="semester" placeholder="semester" value="{{ $subject->semester }}"> <br>
    @error('semester')
        {{$message}}
    @enderror <br>
    <button type="submit">Submit</button>
</form>
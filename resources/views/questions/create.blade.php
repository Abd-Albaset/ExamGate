<h1>create answer</h1><br>
<form action="{{url('http://127.0.0.1:8000/api/questions.store')}}" method="post">
    @csrf
    <input type="number" name="subject_id" placeholder="id"> <br>
    <input type="number" name="number" placeholder="enter question number"> <br>
    <input type="text" name="q-text" placeholder="enter a question"> <br>
    <input type="text" name="session" placeholder="enter a session"> <br>

    <h4>the answers:</h4><br>
        <div>
            <label>A.</label>
            <input type="radio" name="answers[0]['label']" value="A">
            <input type="text" name="answers[0]['a-txt']" placeholder="option A">
            <input type="number" name="answers[0]['IsCorrect']" placeholder="is correct">
            <input type="number" name="answers[0]['hasImg']" placeholder="img">
            <input type="file" name="answers[0]['A-img']" placeholder="img">

        </div>
        <div>
            <label>B.</label>
            <input type="radio" name="answers[1]['label']" value="B">
            <input type="text" name="answers[1]['a-txt']" placeholder="option B">
            <input type="number" name="answers[1]['IsCorrect']" placeholder="is correct">
            <input type="number" name="answers[1]['hasImg']" placeholder="img">
            <input type="file" name="answers[1]['B-img']" placeholder="img">

        </div>
{{--        <div>--}}
{{--            <label>C.</label>--}}
{{--            <input type="radio" name="label" value="C">--}}
{{--            <input type="text" name="op_c_txt" placeholder="option C">--}}

{{--        </div>--}}
{{--        <div>--}}
{{--            <label>D.</label>--}}
{{--            <input type="radio" name="label" value="D">--}}
{{--            <input type="text" name="op_d_txt" placeholder="option D">--}}

{{--        </div>--}}
{{--        <div>--}}
{{--            <label>E.</label>--}}
{{--            <input type="radio" name="label" value="E">--}}
{{--            <input type="text" name="op_e_txt" placeholder="option E">--}}

{{--        </div>--}}


    <button type="submit">Submit</button>
</form>

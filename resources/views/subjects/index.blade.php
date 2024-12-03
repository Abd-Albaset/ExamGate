@foreach($subjects as $subject)
<pre>
    {{$subject}} <br>
    <a href='{{URL("subjects/$subject->id/edit")}}'>edit</a>

</pre>
@endforeach
{{$subjects->links()}}
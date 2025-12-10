<h2>Course: {{ $course->title }}</h2>
<h3>Student: {{ $student->name }}</h3>

<hr>

<h4>Overall Progress</h4>
<p><strong>Videos:</strong> {{ $videoProgress }}%</p>

<hr>

<h4>Videos</h4>
<table border="1" width="100%">
    <tr>
        <th>Lecture Name</th>
        <th>Duration</th>
        <th>Status</th>
    </tr>

    @foreach($course->videos as $video)
    <tr>
        <td>{{ $video->title }}</td>
        <td>{{ $video->duration ?? 'N/A'}}</td>
        <td>
            @if(in_array($video->id, $completedVideos))
                ✔ Completed
            @else
                ❌ Pending
            @endif
        </td>
    </tr>
    @endforeach
</table>

<hr>

<h4>Assignments</h4>

<table border="1" width="100%">
    <tr>
        <th>Assignment Title</th>
        <th>Status</th>
    </tr>

    @foreach($assignments as $assign)
    <tr>
        <td>{{ $assign->title }}</td>
       
        <td>{{ $assign->status }}</td>
    </tr>
    @endforeach
</table>

<hr>

<h4>Student Details</h4>
<p><strong>Name:</strong> {{ $student->name }}</p>
<p><strong>Email:</strong> {{ $student->email }}</p>

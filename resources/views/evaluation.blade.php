<!DOCTYPE html>
<html>
<head>
    <title>Student Evaluation System</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            width: 400px;
            margin: 60px auto;
            background: #ffffff;
            padding: 20px;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        input {
            width: 100%;
            padding: 6px;
            margin-top: 5px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 8px;
            cursor: pointer;
        }

        .result {
            margin-top: 20px;
        }

        .passed {
            color: green;
        }

        .failed {
            color: red;
        }

        hr {
            border: none;
            border-top: 1px solid #ccc;
        }
    </style>
</head>

<body>

<div class="container">

    @if(!request()->filled(['name','prelim','midterm','final']))
        <h3>Student Evaluation System</h3>

        <form method="GET" action="/evaluation">

            <label>Student Name</label>
            <input type="text" name="name">

            <label>Prelim Grade</label>
            <input type="number" name="prelim">

            <label>Midterm Grade</label>
            <input type="number" name="midterm">

            <label>Final Grade</label>
            <input type="number" name="final">

            <button type="submit">Evaluate</button>

        </form>
    @else
        @php
            $name = request('name');
            $prelim = request('prelim');
            $midterm = request('midterm');
            $final = request('final');

            $average = ($prelim + $midterm + $final) / 3;

            if ($average >= 90) {
                $letter = 'A';
            } elseif ($average >= 80) {
                $letter = 'B';
            } elseif ($average >= 70) {
                $letter = 'C';
            } elseif ($average >= 60) {
                $letter = 'D';
            } else {
                $letter = 'F';
            }

            $remarks = $average >= 75 ? 'Passed' : 'Failed';

            if ($average >= 98) {
                $award = 'With Highest Honors';
            } elseif ($average >= 95) {
                $award = 'With High Honors';
            } elseif ($average >= 90) {
                $award = 'With Honors';
            } else {
                $award = 'No Award';
            }
        @endphp

        <h3>Evaluation Result</h3>
        <div class="result">
            <hr>
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Average:</strong> {{ number_format($average, 2) }}</p>
            <p><strong>Letter Grade:</strong> {{ $letter }}</p>
            <p>
                <strong>Remarks:</strong>
                <span class="{{ $remarks == 'Passed' ? 'passed' : 'failed' }}">
                    {{ $remarks }}
                </span>
            </p>
            <p><strong>Award:</strong> {{ $award }}</p>
        </div>

    @endif

</div>

</body>
</html>

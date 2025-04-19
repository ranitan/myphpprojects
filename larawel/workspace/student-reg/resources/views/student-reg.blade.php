<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid">
        <div class="row bg-dark p-2">
            <h3 class="text-white">LARAVEL PROJECT</h3>
        </div>
        <div class="row bg-info py-5">
            <div class="col-6">
                <h2>Registration</h2>
                @if(session('message'))
                <div class="alert alert-success">
                    {{session('message')}}
                </div>
                @endif()
                <form action="/add-student" method="post">
                    <div class="form-group">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="form-label">Phone:</label>
                        <input type="tel" class="form-control" name="phone" required>
                    </div>

                    <div class="form-group">
                        <label for="address" class="form-label">Address:</label>
                        <textarea class="form-control" name="address" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="gender" class="form-label">Gender:</label>
                        <select class="form-control" name="gender" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="department" class="form-label">Department:</label>
                        <input type="text" class="form-control" name="department" required>
                    </div>

                    <div class="mb-3 form-check">
                        <!-- <input type="checkbox" class="form-check-input" name="parttime" value="1">
                        <label class="form-check-label" for="parttime">Part-time Student</label> -->
                        <input type="hidden" name="parttime" value="0">
                        <input type="checkbox" class="form-check-input" name="parttime" value="1">
                        <label class="form-check-label" for="parttime">Part-time Student</label>"
                    </div>

                    <div class="form-group">
                        <label for="joined_date" class="form-label">Joined Date:</label>
                        <input type="date" class="form-control" name="joined_date" required>
                    </div>

                    <button type="submit" class="btn btn-dark">Submit</button>
                    @csrf
                </form>
            </div>
            <div class="col-6">
                <h3>Registered Students</h3>
                @if($students)
                <ul class="list-group">
                    @foreach($students as $student)
                    <li class="list-group-item">{{$student->name}} - {{$student->email}} - {{$student->joined_date}}</li>
                    @endforeach
                </ul>
                @else
                <p>No students registered yet.</p>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
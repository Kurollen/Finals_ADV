<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
  </head>
  <body class="bg-secondary">
    <div class="d-flex flex-row">
    <div class="w-50 m-auto justify-content-center bg-dark p-4 shadow-lg rounded-5 mt-2 border border-1 border-dark-subtle">
        <form action="four.php" method="post">
            <div class="row">
                <h1 class="text-white text-center">Student Form</h1>
            </div>
            <div class="row">
                <div class="col">
                    <label for="name" class="text-white">First Name</label>
                    <input type="text" name="Fname" id="name" class="form-control" placeholder="e.g. Juan" required>
                </div>
                <div class="col">
                    <label for="name" class="text-white">Last Name</label>
                    <input type="text" name="Lname" id="name" class="form-control" placeholder="e.g. Cruz" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="comment" class="text-white">Student #</label>
                    <input type="number" name="studNo" id="" class="form-control" placeholder="e.g. 1234567891011" required>
                </div>
            </div>
            <div class="row mb-2">
                <label for="" class="text-white">Gender</label>
                <div class="col d-flex justify-content-evenly">
                    <label for="maleGender" class="text-white">
                    <input type="radio" name="gender" id="maleGender" value="Male" class="form-check-input" required>
                    Male</label>
                    <label for="maleGender" class="text-white">
                    <input type="radio" name="gender" id="femaleGender" value="Female" class="form-check-input" required>
                    Female</label>
                    <label for="maleGender" class="text-white">
                    <input type="radio" name="gender" id="otherGender" value="Others" class="form-check-input" required>
                    Others</label>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="" class="text-white">Birthday</label>
                    <input type="date" name="bday" id="" class="form-control" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="" class="text-white">Course</label>
                    <select name="course" id="" class="form-select" required>
                        <option value="" disabled selected>Select your course...</option>
                        <option value="Information Technology">Bachelor of Science in Information Technology</option>
                        <option value="Computer Science">Bachelor of Science in Computer Science</option>
                        <option value="Information Systems">Bachelor of Science in Information Systems</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="" class="text-white">Year Level</label>
                    <select name="year" id="" class="form-select" required> 
                        <option value="" disabled selected>Select your year level - (select SWIS if Irregular)</option>
                        <option value="1st Year">First Year</option>
                        <option value="2nd Year">Second Year</option>
                        <option value="3rd Year">Third Year</option>
                        <option value="4th Year">Fourth Year</option>
                        <option value="Irregular Schedule">SWIS</option>
                    </select>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="" class="text-white">Email Address</label>
                    <input type="email" name="email" id="" class="form-control" placeholder="e.g. example@gmail.com" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="" class="text-white">Contact Number</label>
                    <input type="number" name="conNo" id="" class="form-control" placeholder="e.g. 09123456789" required>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <label for="" class="text-white">Additional Information</label>
                    <textarea name="comment" id="" class="form-control" placeholder="Enter your thoughts..."></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col text-center mt-2">
                    <input type="submit" name="sub" class="btn btn-primary w-100">
                </div>
            </div>
        </form>
    </div>

</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
  </body>
</html>


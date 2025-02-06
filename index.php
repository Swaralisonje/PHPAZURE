<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch enrolled courses
$courses = mysqli_query($conn, "SELECT * FROM enrollments WHERE student_id='$user_id'");

// Fetch available courses
$available_courses = mysqli_query($conn, "SELECT * FROM courses");

// Fetch attendance records
$attendance = mysqli_query($conn, "SELECT * FROM attendance WHERE student_id='$user_id'");

?>
<!DOCTYPE html>
<html>
<head>
    <title>Student Portal</title>
</head>
<body>
    <h2>Welcome to Student Portal</h2>
    
    <h3>Your Enrolled Courses</h3>
    <ul>
        <?php while ($course = mysqli_fetch_assoc($courses)) { ?>
            <li><?php echo $course['course_name']; ?></li>
        <?php } ?>
    </ul>

    <h3>Enroll in a Course</h3>
    <form method="POST" action="enroll.php">
        <select name="course_id">
            <?php while ($course = mysqli_fetch_assoc($available_courses)) { ?>
                <option value="<?php echo $course['id']; ?>"> <?php echo $course['course_name']; ?> </option>
            <?php } ?>
        </select>
        <button type="submit">Enroll</button>
    </form>

    <h3>Attendance Records</h3>
    <ul>
        <?php while ($att = mysqli_fetch_assoc($attendance)) { ?>
            <li><?php echo $att['course_name'] . " - " . $att['status']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>

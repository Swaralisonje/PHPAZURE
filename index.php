<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Sample data for courses and attendance
$courses = [
    ['id' => 1, 'course_name' => 'Mathematics'],
    ['id' => 2, 'course_name' => 'Physics'],
    ['id' => 3, 'course_name' => 'Chemistry']
];

$attendance = [
    ['course_name' => 'Mathematics', 'status' => 'Present'],
    ['course_name' => 'Physics', 'status' => 'Absent']
];

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
        <?php foreach ($courses as $course) { ?>
            <li><?php echo $course['course_name']; ?></li>
        <?php } ?>
    </ul>

    <h3>Enroll in a Course</h3>
    <form method="POST" action="enroll.php">
        <select name="course_id">
            <?php foreach ($courses as $course) { ?>
                <option value="<?php echo $course['id']; ?>"> <?php echo $course['course_name']; ?> </option>
            <?php } ?>
        </select>
        <button type="submit">Enroll</button>
    </form>

    <h3>Attendance Records</h3>
    <ul>
        <?php foreach ($attendance as $att) { ?>
            <li><?php echo $att['course_name'] . " - " . $att['status']; ?></li>
        <?php } ?>
    </ul>
</body>
</html>

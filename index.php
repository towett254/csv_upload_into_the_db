<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Upload CSV or TXT</title>
</head>
<body>
    <h1>Upload CSV or TXT File</h1>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="file" accept=".csv, .txt" required>
        <br><br>
        <input type="submit" value="Upload">
    </form>
</body>
</html>

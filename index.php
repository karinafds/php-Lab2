<?php
require 'bookclass.php';
$bookCollection = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bookTitle = $_POST['title'] ?? '';
    $bookAuthor = $_POST['author'] ?? '';
    $publicationYear = $_POST['year'] ?? '';
    try {
        if (empty($bookTitle) || empty($bookAuthor) || empty($publicationYear)) {
            throw new Exception("Please fill in all fields.");
        }
        $newBook = new Book($bookTitle, $bookAuthor, $publicationYear);
        $bookCollection[] = $newBook;
    } catch (Exception $error) {
        echo "<p>Error: " . $error->getMessage() . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            background-color: #f3f0ff;
            margin: 0;
            padding: 20px;
            color: #4a004e;
        }

        h1 {
            text-align: center;
            color: #4a004e;
            font-size: 36px;
            margin-bottom: 30px;
        }

        form {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(74, 0, 78, 0.2);
            border-left: 5px solid #9c27b0;
        }

        label {
            font-weight: bold;
            color: #6a0080;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border: 2px solid #b39ddb;
            border-radius: 6px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #9c27b0;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #7b1fa2;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 30px auto;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
            color: #4a004e;
        }

        th {
            background-color: #e1bee7;
            color: #4a004e;
        }

        tr:nth-child(even) {
            background-color: #f3e5f5;
        }

        p {
            text-align: center;
            color: #6a0080;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <h1>Library Books Management</h1>

    <form method="POST" action="">
        <label for="title">Book Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="author">Author:</label>
        <input type="text" id="author" name="author" required>

        <label for="year">Year of Publication:</label>
        <input type="number" id="year" name="year" required>

        <input type="submit" value="Add Book">
    </form>

    <h2>Current Book Collection</h2>
    <?php if (!empty($bookCollection)) { ?>
        <table>
            <tr>
                <th>Title</th>
                <th>Author</th>
                <th>Year</th>
            </tr>
            <?php foreach ($bookCollection as $singleBook) { ?>
                <tr>
                    <td><?php echo $singleBook->getTitle(); ?></td>
                    <td><?php echo $singleBook->getAuthor(); ?></td>
                    <td><?php echo $singleBook->getYear(); ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <p>There are no Books!</p>
    <?php } ?>
</body>

</html>

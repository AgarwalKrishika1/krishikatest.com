<?php
// Check if the form is submitted and set cookies
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Set cookies for theme and font size preferences
    setcookie('theme', $_POST['theme'], 0, "/"); 
    setcookie('font_size', $_POST['font_size'], 0, "/");
    // Refresh the page to apply the preferences immediately
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Get saved preferences from cookies
$theme = isset($_COOKIE['theme']) ? $_COOKIE['theme'] : 'light';
$font_size = isset($_COOKIE['font_size']) ? $_COOKIE['font_size'] : 'medium';

// Apply theme and font size in styles
$theme_class = ($theme == 'dark') ? 'dark-theme' : 'light-theme';
$font_size_class = ($font_size == 'small') ? 'small-font' : (($font_size == 'large') ? 'large-font' : 'medium-font');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Theme and Font Size Preferences</title>
    <style>
        /* Default styles */
        body {
            font-family: Arial, sans-serif;
            transition: all 0.3s ease;
        }
        /* Theme styles */
        .light-theme {
            background-color: white;
            color: black;
        }
        .dark-theme {
            background-color: #333;
            color: white;
        }
        /* Font size styles */
        .small-font {
            font-size: 12px;
        }
        .medium-font {
            font-size: 16px;
        }
        .large-font {
            font-size: 20px;
        }
    </style>
</head>
<body class="<?php echo $theme_class . ' ' . $font_size_class; ?>">

    <h1>User Preferences</h1>
    <p>Choose your theme and font size preference:</p>

    <!-- Preferences form -->
    <form method="POST">
        <label for="theme">Select Theme:</label>
        <select name="theme" id="theme">
            <option value="light" <?php echo ($theme == 'light') ? 'selected' : ''; ?>>Light</option>
            <option value="dark" <?php echo ($theme == 'dark') ? 'selected' : ''; ?>>Dark</option>
        </select>
        <br><br>

        <label for="font_size">Select Font Size:</label>
        <select name="font_size" id="font_size">
            <option value="small" <?php echo ($font_size == 'small') ? 'selected' : ''; ?>>Small</option>
            <option value="medium" <?php echo ($font_size == 'medium') ? 'selected' : ''; ?>>Medium</option>
            <option value="large" <?php echo ($font_size == 'large') ? 'selected' : ''; ?>>Large</option>
        </select>
        <br><br>

        <button type="submit">Save Preferences</button>
    </form>

</body>
</html>

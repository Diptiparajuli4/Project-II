<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the search query from the form
    $search_query = $_POST["search"];

    // Process the search query (you may want to implement a more complex search logic)
    // For now, let's just display the search query
    echo "You searched for: " . htmlspecialchars($search_query);
} else {
    // Redirect to the home page if accessed directly without a form submission
    header("Location: index.html");
    exit();
}
?>

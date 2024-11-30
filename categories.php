<?php
  require('./includes/nav.inc.php');

?>

<!-- Category List Container -->
<section class="py-1 category-list">
  <div class="container">
    <h2 class="headings">Categories</h2>
    <div class="card-container">
      <?php
        // SQL query to fetch all categories
        $sql = "SELECT * FROM category ORDER BY category_name ASC";

        // Prepare the statement
        $stmt = $con->prepare($sql);

        if ($stmt) {
            // Execute the statement
            $stmt->execute();

            // Get the result
            $result = $stmt->get_result();

            // Check if there are results
            if ($result->num_rows > 0) {
                // Fetch each row as an associative array
                while ($data = $result->fetch_assoc()) {
                    // Storing the category data in variables
                    $category_id = $data['category_id'];
                    $category_name = $data['category_name'];
                    $category_image = $data['category_image'];
                    $category_desc = $data['category_description'];

                    // Calling user-defined function to create a category card
                    createCategoryCard($category_name, $category_image, $category_desc, $category_id);
                }
            } else {
                echo "No categories found.";
            }

            $stmt->close();
        } else {
            // Error handling for statement preparation
            echo "Error preparing statement: " . $con->error;
        }
      ?>
    </div> <!-- End of card-container -->
  </div> <!-- End of container -->
</section>

<?php
  require('./includes/footer.inc.php');
?>

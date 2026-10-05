<?php
$page_title = "Add Book";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Add Book</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>

            <form id="add-form" method="post" action="process_add.php">
                <p>
                    <label for="title">Title</label><br>
                    <input type="text" id="title" name="title" required>
                </p>
                <p>
                    <label for="author">Author</label><br>
                    <input type="text" id="author" name="author" required>
                </p>
                <p>
                    <label for="year">Publication Year</label><br>
                    <input type="number" id="year" name="year" min="1900" max="2026" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label><br>
                    <input type="text" id="isbn" name="isbn">
                </p>
                <p>
                    <label for="stock">Stock</label><br>
                    <input type="number" id="stock" name="stock" min="0" required>
                </p>
                <p>
                    <label for="category">Category</label><br>
                    <select id="category" name="category">
                        <option value="fiction">Fiction</option>
                        <option value="non-fiction">Non-Fiction</option>
                        <option value="reference">Reference</option>
                    </select>
                </p>
                <p>
                    <button type="submit">Save</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>

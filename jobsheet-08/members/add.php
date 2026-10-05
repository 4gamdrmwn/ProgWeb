<?php
$page_title = "Add Member";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Add Member</h2>

            <?php if ($flash): ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['message']; ?></p>
            <?php endif; ?>

            <form id="add-form" method="post" action="process_add.php">
                <p>
                    <label for="name">Name</label><br>
                    <input type="text" id="name" name="name" required>
                </p>
                <p>
                    <label for="member_id">Member ID</label><br>
                    <input type="text" id="member_id" name="member_id" required>
                </p>
                <p>
                    <label for="address">Address</label><br>
                    <input type="text" id="address" name="address">
                </p>
                <p>
                    <label for="phone">Phone</label><br>
                    <input type="text" id="phone" name="phone">
                </p>
                <p>
                    <button type="submit">Save</button>
                </p>
            </form>
        </section>
<?php include __DIR__ . '/../includes/footer.php'; ?>

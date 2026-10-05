<?php
$page_title = "Home";
include __DIR__ . '/includes/header.php';

$totalBooks = count($_SESSION['books'] ?? []);
$totalMembers = count($_SESSION['members'] ?? []);
?>
        <section>
            <h2>Welcome to Mini Library System</h2>
            <p>A simple application to manage book and member data in the library.</p>
        </section>

        <section>
            <h2>Summary</h2>
            <article>
                <h3>Total Books</h3>
                <p><?php echo $totalBooks; ?></p>
            </article>
            <article>
                <h3>Total Members</h3>
                <p><?php echo $totalMembers; ?></p>
            </article>
            <article>
                <h3>Currently Borrowed</h3>
                <p>0</p>
            </article>
        </section>
<?php include __DIR__ . '/includes/footer.php'; ?>

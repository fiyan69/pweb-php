<?php
// Memasukkan file koneksi
require_once 'config.php';

// Mendapatkan ID artikel dari parameter URL
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 1;

// Mengambil data artikel dari database
$sql = "SELECT * FROM posts WHERE id = $post_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $post = $result->fetch_assoc();
} else {
    // Jika artikel tidak ditemukan, redirect ke halaman utama
    header("Location: index.php");
    exit();
}

// Mengambil komentar untuk artikel ini
$sql = "SELECT * FROM comments WHERE post_id = $post_id ORDER BY created_at DESC";
$comments = $conn->query($sql);
$comment_count = $comments->num_rows;

// Mengambil artikel terkait
$sql = "SELECT id, title, image FROM posts WHERE id != $post_id ORDER BY RAND() LIMIT 4";
$related_posts = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Vi & Blog</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Dancing+Script:wght@700&family=Poppins:wght@300;400;500&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header class="py-5 text-center">
        <div class="container">
            <h1 class="blog-title">Vi & Blog</h1>
            <p class="blog-slogan">PERSONAL BLOG HTML THEME</p>
            <div class="social-icons mb-4">
                <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                <a href="#" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white mb-5 py-3">
        <div class="container">
            <button class="navbar-toggler mx-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">HOME</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">FEATURES</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php">BLOG</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">ABOUT US</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">CONTACT</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Article Content -->
    <section class="article-content py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <!-- Article Header -->
                    <div class="article-header text-center mb-5">
                        <p class="post-date"><?php echo date('F d, Y', strtotime($post['created_at'])); ?></p>
                        <h1 class="article-title"><?php echo htmlspecialchars($post['title']); ?></h1>
                        <p class="post-author">POST BY <?php echo htmlspecialchars($post['author']); ?></p>
                    </div>

                    <!-- Featured Image -->
                    <div class="featured-image mb-5">
                        <img src="<?php echo htmlspecialchars($post['image']); ?>" class="img-fluid rounded" alt="Featured Image">
                    </div>

                    <!-- Article Text -->
                    <div class="article-text mb-5">
                        <?php echo $post['content']; ?>
                        
                        <blockquote class="blockquote my-5">
                            <p>"The world is a book and those who do not travel read only one page."</p>
                            <footer class="blockquote-footer">Saint Augustine</footer>
                        </blockquote>
                        
                        <p>Sed porttitor lectus nibh. Curabitur aliquet quam id dui posuere blandit. Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Nulla quis lorem ut libero malesuada feugiat. Donec rutrum congue leo eget malesuada.</p>
                        
                        <div class="row my-5">
                            <div class="col-md-6 mb-4 mb-md-0">
                                <img src="https://picsum.photos/600/400?random=2" class="img-fluid rounded" alt="Article Image">
                            </div>
                            <div class="col-md-6">
                                <img src="https://picsum.photos/600/400?random=3" class="img-fluid rounded" alt="Article Image">
                            </div>
                        </div>
                        
                        <p>Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a. Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.</p>
                    </div>

                    <!-- Share Buttons -->
                    <div class="share-buttons text-center mb-5">
                        <h5 class="mb-3">SHARE THIS POST</h5>
                        <div class="social-share">
                            <a href="#" class="social-share-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" class="social-share-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="social-share-icon"><i class="fab fa-google-plus-g"></i></a>
                            <a href="#" class="social-share-icon"><i class="fab fa-pinterest-p"></i></a>
                            <a href="#" class="social-share-icon"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>

                    <!-- Post Navigation -->
                    <div class="post-navigation d-flex justify-content-between mb-5">
                        <a href="article.php?id=<?php echo max(1, $post_id - 1); ?>" class="prev-post">
                            <i class="fas fa-arrow-left me-2"></i> PREVIOUS POST
                        </a>
                        <a href="article.php?id=<?php echo $post_id + 1; ?>" class="next-post">
                            NEXT POST <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                    </div>

                    <!-- Related Posts -->
                    <div class="related-posts mb-5">
                        <h3 class="section-title text-center mb-4">YOU MAY ALSO LIKE</h3>
                        <div class="row g-4">
                            <?php while ($related = $related_posts->fetch_assoc()): ?>
                            <div class="col-6 col-md-3">
                                <div class="related-post">
                                    <a href="article.php?id=<?php echo $related['id']; ?>">
                                        <img src="<?php echo htmlspecialchars($related['image']); ?>" class="img-fluid rounded mb-2" alt="Related Post">
                                        <h5 class="related-title"><?php echo htmlspecialchars($related['title']); ?></h5>
                                    </a>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>

                    <!-- Comments Section -->
                    <div class="comments-section mb-5">
                        <h3 class="section-title text-center mb-4">COMMENTS (<?php echo $comment_count; ?>)</h3>
                        
                        <?php while ($comment = $comments->fetch_assoc()): ?>
                        <!-- Comment -->
                        <div class="comment mb-4">
                            <div class="row">
                                <div class="col-md-2 col-3">
                                    <img src="https://picsum.photos/100/100?random=<?php echo $comment['id']; ?>" class="img-fluid rounded-circle" alt="Commenter">
                                </div>
                                <div class="col-md-10 col-9">
                                    <div class="comment-content">
                                        <h5 class="commenter-name"><?php echo htmlspecialchars($comment['name']); ?></h5>
                                        <p class="comment-date"><?php echo date('F d, Y \a\t h:i A', strtotime($comment['created_at'])); ?></p>
                                        <p class="comment-text"><?php echo htmlspecialchars($comment['comment']); ?></p>
                                        <a href="#" class="reply-link">REPLY</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endwhile; ?>
                    </div>

                    <!-- Comment Form -->
                    <div class="comment-form">
                        <h3 class="section-title text-center mb-4">LEAVE A COMMENT</h3>
                        <?php if (isset($_GET['success'])): ?>
                            <div class="alert alert-success">
                                Your comment has been submitted successfully!
                            </div>
                        <?php endif; ?>
                        <form action="submit_comment.php" method="post">
                            <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Your Name *" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" name="email" class="form-control" placeholder="Your Email *" required>
                                </div>
                                <div class="col-12">
                                    <textarea name="comment" class="form-control" rows="5" placeholder="Your Comment *" required></textarea>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-primary">POST COMMENT</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-4 text-center">
        <div class="container">
            <p>&copy; 2025 Tada & Blog. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

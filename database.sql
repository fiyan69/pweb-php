-- Membuat database
CREATE DATABASE tada_blog;

-- Menggunakan database
USE tada_blog;

-- Membuat tabel komentar
CREATE TABLE comments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT NOT NULL,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    comment TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Membuat tabel posts (untuk referensi)
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menambahkan beberapa data contoh untuk posts
INSERT INTO posts (title, content, image, author) VALUES
('BEAUTIFUL PLACE TO VISIT', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in odio vitae justo vestibulum bibendum at sit amet libero.', 'https://picsum.photos/1200/600?random=1', 'AD THEME'),
('TRAVEL TIPS AND ADVICE', 'Praesent euismod auctor diam, vitae pulvinar arcu. Nullam at justo sapien. Vivamus finibus risus sit amet risus facilisis.', 'https://picsum.photos/600/400?random=2', 'AD THEME'),
('PHOTOGRAPHY ESSENTIALS', 'Cras ultricies ligula sed magna dictum porta. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus.', 'https://picsum.photos/600/400?random=3', 'AD THEME');

-- Menambahkan beberapa data contoh untuk comments
INSERT INTO comments (post_id, name, email, comment) VALUES
(1, 'John Doe', 'john@example.com', 'Great article! I\'ve been to this place and it\'s truly amazing. The photos don\'t do it justice.'),
(1, 'Jane Smith', 'jane@example.com', 'Thanks for sharing these tips! I\'m planning to visit next month and this is very helpful.'),
(1, 'Mike Johnson', 'mike@example.com', 'I\'ve been following your blog for a while now and I always find your travel guides very informative. Keep up the good work!');

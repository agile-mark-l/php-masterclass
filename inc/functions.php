<?php

include 'inc/post.php';

/**
 * Vzpoostavi povezavo z bazo, podatki so odvisni od okolja.
 *
 * @return \PDO
 */
function databaseConnection() {
    $user = 'root'; //root;
    $password = 'root'; // ""
    $db = 'PHPmasterclass'; //ime baze
    $host = 'db'; //localhost;
    $con = "mysql:host=$host;dbname=$db";

    $pdo = new PDO($con, $user, $password);
    return $pdo;
}

/**
 * Uredi rezultate iz baze tako da struktura postov ista kot je bila pri
 * statičnem arreyju.
 *
 * @param $postsFromDb
 *
 * @return array
 */
function structurePostsArray($postsFromDb) {
    $structuredPosts = [];
    foreach ($postsFromDb as $post) {
        $structuredPosts[$post['ID']] = [
            'title' => $post['title'],
            'content' => $post['content'],
            'image' => [
                'url' => $post['url'],
                'alt' => $post['alt'],
            ],
            'authored by' => $post['name'] . ' ' . $post['surname'],
            'authored on' => $post['created'],
        ];
    }

    return $structuredPosts;
}

/**
 * Pridobi podatke o vseh postih.
 *
 * @return array|false
 */
function allPosts() {
    $pdo = databaseConnection();
    $structuredPosts = FALSE;
    $query = 'SELECT * FROM posts 
  LEFT JOIN users ON users.id = posts.author
  LEFT JOIN image ON image.id = posts.image';
    $statement = $pdo->query($query);
    $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ($posts) {
        $structuredPosts = structurePostsArray($posts);
    }
    return $structuredPosts;
}

/**
 * Get posts.
 *
 * @return array|FALSE
 *   Structured post or FALSE.
 */
function getPost($id) {
    $pdo = databaseConnection();
    $post = FALSE;
    $sql = "SELECT p.id, p.title, p.content, p.created, u.name, u.surname, i.alt, i.url, i.id as fid FROM posts p " .
        "LEFT JOIN users u ON u.id = p.author " .
        "LEFT JOIN image i ON i.id = p.image " .
        "WHERE p.id = :id";

    $query = $pdo->prepare($sql);
    $query->execute(array(':id' => $id));
    $posts = $query->fetchAll(PDO::FETCH_ASSOC);
    // Perform query
    if ($posts) {
        $post = structurePost($posts[0]);
    }
    return $post;
}


///**
// * Structure a single post.
// *
// * @param array $posts
// *   Sql posts result.
// *
// * @return array
// *   Structured post.
// */
//function structurePost(array $posts) {
//    $structuredPost = [];
//    foreach ($posts as $post) {
//        $structuredPost = [
//            'id' => $post['id'],
//            'title' => $post['title'],
//            'content' => $post['content'],
//            'authored by' => $post['name'] . ' ' . $post['surname'],
//            'authored on' => $post['created'],
//            'image' => [],
//        ];
//
//        // V primeru da post ima sliko, spremeni image key, da vsebuje array podakov
//        // o sliki.
//        if ($post['url']) {
//            $structuredPost['image'] = [
//                'url' => $post['url'],
//                'alt' => $post['alt'],
//                'fid' => $post['fid'],
//            ];
//        }
//
//    }
//    return $structuredPost;
//}
/**
 * Structure a single post.
 *
 * @param array $post
 *   Sql posts result.
 *
 * @return Post
 *   Structured post.
 */
function structurePost(array $post) {
    return new Post($post['id'], $post['title'], $post['content'], $post['alt'], $post['url'], $post['created'], $post['name'] . ' ' . $post['surname']);
}
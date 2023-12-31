<?php
	$page_title = "All Books";
    $display_navbar_flag = false;
	require_once($_SERVER["DOCUMENT_ROOT"]."/includes/init.php");
?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Competitive Exam Books    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_competitive_exam_books"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($exam_books = get_competitive_exam_books()): ?>
                            <?php foreach ($exam_books as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/CompetitiveExamBook.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $book["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        Status : 
                                                        <strong>
                                                            Buy  
                                                            <?php if($book["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Novels    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_novels"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($novels = get_novel_books()): ?>
                            <?php foreach ($novels as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/Novel.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $book["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        Status : 
                                                        <strong>
                                                            Buy  
                                                            <?php if($book["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">History    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_history_books"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($histories = get_history_books()): ?>
                            <?php foreach ($histories as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/History.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $book["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        Status : 
                                                        <strong>
                                                            Buy  
                                                            <?php if($book["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">University Books    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_university_books"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($university_books = get_university_books()): ?>
                            <?php foreach ($university_books as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/UniversityBooks.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $book["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        Status : 
                                                        <strong>
                                                            Buy  
                                                            <?php if($book["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card explore_page_card_border my-3">
                <div class="card-body">
                    <h4 class="bold mt-0">Anime Comics    |     <a class="text-decoration-underline link-dark" href="/explore/books/all_anime_comics"><small>See all  <i class="fa-solid fa-arrow-right"></i></a></small></h4>
                    <div class="row mt-4">
                        <?php if ($comics = get_anime_comic_books()): ?>
                            <?php foreach ($comics as $book): ?>
                                <div class="col-lg-3">
                                    <a href="/explore/book_details?q=<?php echo $book["id"]; ?>" target="_blank" class="text-decoration-none link-dark">
                                        <div class="card explore_image_card my-2">
                                            <?php if ($book["cover_url"] > '0'): ?>
                                                <img class="rounded img_height" src="<?php echo substr($book["cover_url"],27); ?>" alt="Image">
                                            <?php else: ?>
                                                <img class="rounded img_height" src="/assets/img/AnimeComic.png" alt="Image">
                                            <?php endif; ?>
                                            <div class="py-3 ps-3">
                                                <div>
                                                    <h5 class="bold"><?php echo $book["title"]; ?></h5>
                                                </div>
                                                <div>
                                                    <p>
                                                        Status : 
                                                        <strong>
                                                            Buy  
                                                            <?php if($book["rent"] === '1'): ?>
                                                                | Rent
                                                            <?php endif; ?>
                                                        </strong>
                                                    </p>
                                                    <p>Condition : <strong>Excellent</strong></p>
                                                    <p>Rs : <strong><?php echo $book["price"]; ?></strong></p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once($_SERVER["DOCUMENT_ROOT"] . "/includes/footer.php");
?>
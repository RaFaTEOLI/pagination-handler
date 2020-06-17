<?php

include_once('../PaginationHandler.php');
include_once('selectExample.php');

$conn = mysqli_connect("127.0.0.1", "root", "", "mysql");

$path = "/pagination-handler/example/example.php";

$select = new SelectExample();

/* Pagination Config */
$pagination = new PaginationHandler();

if (isset($_GET["page"])) {
	$page = $_GET["page"];
	
    $pagination->setPageLimit(10);
    $pageLimit = $pagination->getPageLimit();

    $pagination->setPage($page);
    $pageOffset = $pagination->getPageOffset();
} else {
	$page = 1;
    $pagination->setPageLimit(10);
    $pageLimit = $pagination->getPageLimit();

    $pageOffset = 0;
}

$results = $select->getHelpTopics($conn, $pageLimit, $pageOffset);
$numberOfPages = $pagination->getNumberOfPages($select->getHelpTopicsCount($conn));
$numberOfPagesAux = $numberOfPages;
mysqli_close($conn);

$pagesToList = [];

if ($numberOfPages < 10) {
    for ($i = 1; $i <= $numberOfPages; $i++) {
        array_push($pagesToList, $i);
    }  
} else {
    $pagesToList = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
}

if ($page > 9 && $numberOfPages > 9) {
    $pagesToList = [];
	
    if ($page < $numberOfPages - 10) {
		$numberOfPages = $page + 10;
    }

	for ($i = ($numberOfPages - 10); $i <= $numberOfPages; $i++) {
		array_push($pagesToList, $i);
	}
    
}
/* End of Pagination Config */
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Pagination Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="../paginationHandler.js"></script>
  <style>
	.container {
		display: flex;
		flex-direction: row;
		justify-content: space-around;
		flex-wrap: wrap;
	}
  </style>
</head>
<body>
	<div class="container">
	<?php while ($row = mysqli_fetch_assoc($results)) { ?>
		<div class="card" style="width: 18rem;">
		  <div class="card-body">
			<h5 class="card-title"><?= $row["name"] ?></h5>
			<p class="card-text"><?= substr($row["description"], 0, 100) ?></p>
		  </div>
		</div>
	<?php } ?>
	</div>
    <!-- Pagination Config -->
    <input type="hidden" id="site-url-php" value="localhost/pagination-handler/">
    <input type="hidden" id="page-name" value="example/example.php">
    <input type="hidden" id="current-page" value="<?= ($page) ? $page : 1 ?>">
	<input type="hidden" id="number-of-pages" value="<?= ($numberOfPagesAux) ? $numberOfPagesAux : 1 ?>">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" id="previousPage" href="">Anterior</a></li>
            <?php foreach ($pagesToList as $onePage) { ?>
                <li class="page-item"><a class="page-link" href="<?= $path . "?page=" . $onePage ?>"><?= $onePage ?></a></li>
            <?php } ?>
            <li class="page-item"><a class="page-link" id="nextPage" href="">Próxima</a></li>
        </ul>
    </nav>
    <!-- End Pagination Config -->
</body>

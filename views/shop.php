<?php
require_once __DIR__ . "/../model/Product.php";

$productModel = new Product();

function productImagePath($image)
{
    $image = trim((string) $image);

    if ($image === '') {
        return '../assetviews/img/product-1.jpg';
    }

    if (preg_match('/^(https?:)?\/\//i', $image)) {
        return $image;
    }

    if (strpos($image, 'uploads/') === 0 || strpos($image, '../') === 0 || strpos($image, './') === 0) {
        return '../' . ltrim($image, './');
    }

    if (strpos($image, '/') !== false) {
        return '../' . ltrim($image, '/');
    }

    return '../uploads/' . $image;
}

$categoryId = isset($_GET['category_id']) ? (int) $_GET['category_id'] : 0;
$productId = isset($_GET['product_id']) ? (int) $_GET['product_id'] : 0;
$allCategories = $productModel->get_all_categories();

if ($productId > 0) {
    $selectedProduct = $productModel->get_product($productId);
    if ($selectedProduct) {
        $categoryId = (int) $selectedProduct['category_id'];
        $products = $productModel->get_products_by_category($categoryId);
        $pageTitle = $selectedProduct['title'];
    } else {
        $selectedProduct = null;
        $products = $categoryId > 0 ? $productModel->get_products_by_category($categoryId) : $productModel->get_all_products();
        $pageTitle = $categoryId > 0 ? $productModel->get_category_name($categoryId) : 'Shop';
    }
} elseif ($categoryId > 0) {
    $products = $productModel->get_products_by_category($categoryId);
    $pageTitle = $productModel->get_category_name($categoryId);
    $selectedProduct = null;
} else {
    $products = $productModel->get_all_products();
    $pageTitle = 'Shop';
    $selectedProduct = null;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= htmlspecialchars($pageTitle) ?> | Boutique</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link rel="stylesheet" href="../assetviews/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assetviews/vendor/lightbox2/css/lightbox.min.css">
    <link rel="stylesheet" href="../assetviews/vendor/nouislider/nouislider.min.css">
    <link rel="stylesheet" href="../assetviews/vendor/bootstrap-select/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="../assetviews/vendor/owl.carousel2/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="../assetviews/vendor/owl.carousel2/assets/owl.theme.default.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <link rel="stylesheet" href="../assetviews/css/style.default.css" id="theme-stylesheet">
    <link rel="stylesheet" href="../assetviews/css/custom.css">
    <link rel="shortcut icon" href="../assetviews/img/favicon.png">
</head>

<body>
    <div class="page-holder">
        <?php
        $headerActivePage = 'shop';
        require_once __DIR__ . "/compenents/site/header.php";
        ?>

        <div class="container">
            <section class="py-5 bg-light">
                <div class="container">
                    <div class="row px-4 px-lg-5 py-lg-4 align-items-center">
                        <div class="col-lg-6">
                            <h1 class="h2 text-uppercase mb-0"><?= htmlspecialchars($pageTitle) ?></h1>
                        </div>
                        <div class="col-lg-6 text-lg-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-lg-end mb-0 px-0">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?= htmlspecialchars($pageTitle) ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </section>

            <?php if ($selectedProduct): ?>
                <section class="py-5">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <img src="<?= productImagePath($selectedProduct['image']) ?>" alt="<?= htmlspecialchars($selectedProduct['title']) ?>" class="img-fluid w-100 rounded shadow-sm">
                        </div>
                        <div class="col-lg-6">
                            <p class="text-muted text-uppercase small mb-2"><?= htmlspecialchars($productModel->get_category_name((int) $selectedProduct['category_id'])) ?></p>
                            <h2 class="h3 text-uppercase mb-3"><?= htmlspecialchars($selectedProduct['title']) ?></h2>
                            <p class="text-muted h4">$<?= number_format((float) $selectedProduct['price'], 2) ?></p>
                            <p class="text-small mb-4"><?= nl2br(htmlspecialchars($selectedProduct['description'])) ?></p>
                            <a class="btn btn-dark" href="shop.php?category_id=<?= (int) $selectedProduct['category_id'] ?>">Back to category</a>
                        </div>
                    </div>
                </section>
            <?php endif; ?>

            <section class="py-5">
                <div class="container p-0">
                    <div class="row">
                        <div class="col-lg-3 order-2 order-lg-1">
                            <h5 class="text-uppercase mb-4">Categories</h5>
                            <?php foreach ($allCategories as $category): ?>
                                <div class="py-2 px-4 <?= ($categoryId == $category['id']) ? 'bg-dark text-white' : 'bg-light' ?> mb-3">
                                    <strong class="small text-uppercase font-weight-bold">
                                        <a href="shop.php?category_id=<?= (int) $category['id'] ?>" class="reset-anchor <?= ($categoryId == $category['id']) ? 'text-white' : 'text-dark' ?>">
                                            <?= htmlspecialchars($category['category']) ?>
                                        </a>
                                    </strong>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="col-lg-9 order-1 order-lg-2 mb-5 mb-lg-0">
                            <div class="row mb-3 align-items-center">
                                <div class="col-lg-6 mb-2 mb-lg-0">
                                    <p class="text-small text-muted mb-0">
                                        Showing <?= count($products) ?> result<?= count($products) != 1 ? 's' : '' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <?php if (!empty($products)): ?>
                                    <?php foreach ($products as $product): ?>
                                        <div class="col-lg-4 col-sm-6">
                                            <div class="product text-center">
                                                <div class="mb-3 position-relative">
                                                    <a class="d-block" href="shop.php?category_id=<?= (int) $product['category_id'] ?>&product_id=<?= (int) $product['id'] ?>">
                                                        <img class="img-fluid w-100" src="<?= productImagePath($product['image']) ?>" alt="<?= htmlspecialchars($product['title']) ?>">
                                                    </a>
                                                    <div class="product-overlay">
                                                        <ul class="mb-0 list-inline">
                                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark" href="#"><i class="far fa-heart"></i></a></li>
                                                            <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-dark" href="cart.html">Add to cart</a></li>
                                                            <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark" href="shop.php?category_id=<?= (int) $product['category_id'] ?>&product_id=<?= (int) $product['id'] ?>"><i class="fas fa-expand"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <h6><a class="reset-anchor" href="shop.php?category_id=<?= (int) $product['category_id'] ?>&product_id=<?= (int) $product['id'] ?>"><?= htmlspecialchars($product['title']) ?></a></h6>
                                                <p class="small text-muted">$<?= number_format((float) $product['price'], 2) ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <div class="col-12">
                                        <div class="alert alert-light border">No products available in this category.</div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php require_once __DIR__ . "/compenents/site/footer.php"; ?>

        <script src="../assetviews/vendor/jquery/jquery.min.js"></script>
        <script src="../assetviews/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="../assetviews/vendor/lightbox2/js/lightbox.min.js"></script>
        <script src="../assetviews/vendor/nouislider/nouislider.min.js"></script>
        <script src="../assetviews/vendor/bootstrap-select/js/bootstrap-select.min.js"></script>
        <script src="../assetviews/vendor/owl.carousel2/owl.carousel.min.js"></script>
        <script src="../assetviews/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js"></script>
        <script src="../asset/js/front.js"></script>
    </div>
</body>

</html>
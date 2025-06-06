<?php include '../db/conector.php'; ?>
<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Market Product</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
     <h1 class="mb-4 text-center">Market Product</h1>

     <form method="GET" class="mb-4 container" action="<?= $_SERVER['PHP_SELF']?>">
          <div class="row g-2">
               <div class="col-md-6 col-12">
                    <input type="text" name="search" class="form-control" placeholder="Search by name...">
               </div>
               <!-- <div class="col-md-4 col-8">
                         <?php 
                         // Assuming you have a function to fetch catalogs from the database
                         function getCatalogs(PDO $pdo): array {
                              $stmt = $pdo->query("SELECT id, name FROM products");
                              return $stmt->fetchAll(PDO::FETCH_ASSOC);
                         }
                         ?>
               </div> -->
               <div class="col-md-2 col-4">
                    <button class="btn btn-outline-primary blue w-100">Filter</button>
               </div>
          </div>
     </form>

     <div class="row">
<?php 
     // Assuming $produtos is an array of products fetched from the database
     // Conection with db (ajuste os dados conforme necessário)
     $pdo = new PDO("mysql:host=localhost;dbname=catalog;charset=utf8", "root", '');
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // Test if exists table products
     
     // Func for Search product active with filters opctional
     function getActiveProducts(PDO $pdo, array $filters = []): array {
          $sql = "SELECT * FROM products WHERE price >= 1";
          $params = [];

          if (!empty($filters['search'])) {
               $sql .= " AND name LIKE ?";
               $params[] = '%' . $filters['search'] . '%';
          }

          if (!empty($filters['catalog'])) {
               $sql .= " AND catalog = ?";
               $params[] = $filters['catalog'];
          }

          $stmt = $pdo->prepare($sql);
          if (!$stmt) {
               die("Erro ao preparar a consulta: " . implode(' | ', $pdo->errorInfo()));
          }

          $stmt->execute($params);
          return $stmt->fetchAll();
     }

     // Capture Filters
     $filters = [
     'search' => $_GET['search'] ?? '',
     'catalog' => $_GET['catalog'] ?? ''
     ];

     // Search products
     $produtos = getActiveProducts($pdo, $filters);
?>
          <?php if (empty($produtos)): ?>
               <p class="text-center">No products found.</p>
          <?php else: ?>
               <?php foreach ($produtos as $produto): ?>
                    <div class="col-md-4 col-sm-6 mb-3">
                         <div class="card h-100 shadow-sm">
                         <div class="card-body">
                              <h5 class="card-title"><?= htmlspecialchars($produto['name']) ?></h5>
                              <p class="card-text"><?= htmlspecialchars($produto['descr']) ?></p>
                              <a href="produto.php?id=<?= $produto['id'] ?>" class="btn btn-outline-primary">Details</a>
                         </div>
                         </div>
                    </div>
               <?php endforeach; ?>
          <?php endif; ?>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
<?php include "../includes/footer.php" ?>
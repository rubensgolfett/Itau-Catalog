<?php include '../db/conector.php'; ?>
<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Product Financial</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
</head>
<body>
     <h1 class="mb-4 text-center">Product Financial</h1>

     <form method="GET" class="mb-4 container">
          <div class="row g-2">
               <div class="col-md-6 col-12">
                    <input type="text" name="search" class="form-control" placeholder="Search by name...">
               </div>
               <div class="col-md-4 col-8">
                    <select name="catalog" class="form-select">
                    <?php
                         $options = ['Account', 'Cart', 'Credit', 'Investment'];
                         foreach ($options as $option) {
                         $selected = $filters['catalog'] === $option ? 'selected' : '';
                         echo "<option value=\"$option\" $selected>$option</option>";
                         }
                    ?>
                    </select>
               </div>
               <div class="col-md-2 col-4">
                    <br>
                    <button class="btn btn-primary w-100">Filter</button>
               </div>
          </div>
     </form>

     <div class="row">
<?php 
// Assuming $produtos is an array of products fetched from the database// Conexão com o banco (ajuste os dados conforme necessário)
     $pdo = new PDO("mysql:host=localhost;dbname=catalog;charset=utf8", "root", '');
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     // Testar se a tabela existe
     
     // Função para buscar produtos ativos com filtros opcionais
     function getActiveProducts(PDO $pdo, array $filters = []): array {
          $sql = "SELECT * FROM products WHERE status = 1";
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

     // Captura filtros
     $filters = [
     'search' => $_GET['search'] ?? '',
     'catalog' => $_GET['catalog'] ?? ''
     ];

     // Busca os produtos
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
                              <p class="card-text"><?= htmlspecialchars($produto['description']) ?></p>
                              <a href="produto.php?id=<?= $produto['id'] ?>" class="btn btn-outline-primary">Details</a>
                         </div>
                         </div>
                    </div>
               <?php endforeach; ?>
          <?php endif; ?>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>

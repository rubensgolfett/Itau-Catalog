<?php include '../db/conector.php'; ?>
<?php include '../includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
     <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
     <h1 class="mb-4">Product Financial</h1>
     <form method="GET" class="mb-4">
          <div class="row g-2">
               <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Search by name...">
               </div>
               <div class="col-md-4">
                    <select name="catalog" class="form-select">
                         <option value="Account">Account</option>
                         <option value="Cart">Cart</option>
                         <option value="Crdit">Credit</option>
                         <option value="Investment">Investment</option>
                    </select>
               </div>
               <div class="col-md-2">
                    <button class="btn btn-primary w-100">Filtrar</button>
               </div>
          </div>
     </form>

     <div class="row">

     Lorem ipsum dolor sit amet consectetur adipisicing elit. Quo nesciunt blanditiis veniam rerum asperiores et esse suscipit nemo culpa praesentium fugiat inventore odio corporis eligendi, vitae ipsam, commodi iste quis!
     Lorem ipsum dolor sit amet consectetur adipisicing elit. Maiores consectetur labore provident blanditiis velit quaerat necessitatibus iste explicabo rem iusto, nobis corrupti soluta corporis sed nisi suscipit, quis, recusandae possimus.
     Lorem ipsum dolor sit amet consectetur adipisicing elit. Ad aut repellat, velit placeat facere magnam libero aspernatur minus, neque aliquid exercitationem laboriosam laudantium perspiciatis, ratione molestias itaque doloribus quo incidunt.
</body>
</html>

<?php
     $sql = "SELECT * FROM produtos WHERE status = 'ativo'";
     $params = [];

     if (!empty($_GET['buscar'])) {
          $sql .= " AND nome LIKE ?";
          $params[] = '%' . $_GET['buscar'] . '%';
     }

     if (!empty($_GET['categoria'])) {
          $sql .= " AND categoria = ?";
          $params[] = $_GET['categoria'];
     }

     $stmt = $pdo->prepare($sql) ?? '';

     if ($stmt === null) {
          die("Erro ao preparar a consulta: " . $pdo->errorInfo()[2]);
     }

     $stmt->execute($params);
     $produtos = $stmt->fetchAll();

     foreach ($produtos as $produto): ?>
          <div class="col-md-4">
               <div class="card mb-3">
                    <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($produto['nome']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($produto['descricao_curta']) ?></p>
                    <a href="produto.php?id=<?= $produto['id'] ?>" class="btn btn-outline-primary">Detalhes</a>
                    </div>
               </div>
          </div>
<?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
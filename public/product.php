<?php include '../db/conector.php'; ?>
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
     <header class="d-flex justify-content-between align-items-center p-3 mb-4 orange">
          <h1>Catalog</h1>
          <nav class="navbar navbar-expand-sm navbar-light orange">
               <div class="container-fluid orange fixed-start">
                    <div class="orange">
                         <ul class="navbar-nav bg-white px-4 radius">
                              <li class="nav-item">
                                   <a class="nav-link " aria-current="page" href="../public/index.php">Home</a>
                              </li>
                              <li class="nav-item">
                                   <a class="nav-link active" href="../public/product.php">Products</a>
                              </li>
                         </ul>
                    </div>
               </div>
          </nav>
     </header>

     <!-- Really Code to Now :) -->
     <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="mb-4 container">
          <div>
               <label for="name">Name of Product:</label>
               <input type="text" name="name" class="form-control mb-2" placeholder="Product Name" required id="createName"> 
          </div>
          <div>
               <label for="description">Description:</label>
               <textarea name="description" class="form-control" placeholder="Product Description" required id="createDesc"></textarea>
          </div>
          <div>
               <label for="price">Price:</label>
               <input type="number" name="price" id="createPrice" class="form-control mb-2" placeholder="Product Price" required>
          </div>
          <div>
               <input type="submit" value="Create Product" class="btn btn-outline-primary blue w-100">
          </div>
     </form>
     <section class="container">
          <?php 
               // Conection with db (ajuste os dados conforme necessário)
               if(isset($_POST['name']) && isset($_POST['description']) && isset($_POST['price'])) {
                    $name = $_POST['name'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];

                    // Prepare and execute the insert statement
                    $stmt = $pdo->prepare("INSERT INTO products (name, descr, price) VALUES (:name, :description, :price)");
                    $stmt->bindParam(':name', $name);
                    $stmt->bindParam(':description', $description);
                    $stmt->bindParam(':price', $price);
                    
                    if ($stmt->execute()) {
                         echo "<div class='alert alert-info'>Product created successfully!</div>";
                         echo "<div class='alert alert-success'>Name: " . htmlspecialchars($name) . "</div>";
                         echo "<div class='alert alert-success'>Description: " . htmlspecialchars($description) . "</div>";
                         echo "<div class='alert alert-success'>Price: " . htmlspecialchars($price) . "</div>";
                    } else {
                         echo "<div class='alert alert-danger'>Error creating product.</div>";
                    }
               }
          ?>
     </section>
     
     <?php include "../includes/footer.php"?>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
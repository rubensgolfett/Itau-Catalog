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
     <form action="<?= $_SERVER['PHP_SELF']?>" method="post" class="mb-4 container">
          <div>
               <label for="createName">Create Product</label>
               <input type="text" name="name" class="form-control" placeholder="Product Name" required class="mb-2">
          </div>
          <div>
               <label for="createDesc">Description</label>
               <textarea name="description" class="form-control" placeholder="Product Description" required></textarea>
          </div>
     </form>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>
</html>
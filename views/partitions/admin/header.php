<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/frontend/css/grid.css">
    <link rel="stylesheet" href="../public/admin/css/base.css">
    <link rel="stylesheet" href="../public/admin/css/style.css">
</head>

<body>
    <header>
    </header>
    <main>
        <div class="grid">
            <div class="row container">
                <div class="col l-2">
                    <?php $this->view('partitions.admin.sidebar', ['roles' => $roles]); ?>
                </div>
                <div class="col l-10">
                    <div class="nav">
                        <?php $this->view('partitions.admin.navigation'); ?>
                    </div>
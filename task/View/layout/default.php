<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Creative Web Form Solution</title>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous" />
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="./js/form_validation.js" type="text/javascript"></script>
</head>
<body>

    <nav class="navbar sticky-top navbar-expand-md navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">Creative Web Form Solution</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/form">Form</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav ml-auto">
                    <?php if ($user['username']) { ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" 
                                href="javascript://" 
                                id="navbarDropdown" 
                                role="button" 
                                data-toggle="dropdown" 
                                aria-haspopup="true" 
                                aria-expanded="false">
                                <?php echo $user['username']; ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/admin/user/list">Users</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/admin/logout">Logout</a>
                            </div>
                        </li>
                    <?php } else { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/admin/">Admin</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    
    <div class="container-fluid my-3">
        
        <?php if (isset($messages)) { ?>
            <div class="row">
                <div class="col">
                    <div class="messages">
                        <?php foreach ($messages as $type => $messagesOfType) { ?>
                            <?php foreach ($messagesOfType as $message) { ?>
                                <div class="alert alert-<?php echo $type; ?>" role="alert"><?php echo $message; ?></div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <div class="row">
            <div class="col">
                <?php echo $content; ?>
                
            </div>
        </div>
        
    </div>
    
</body>
</html>
